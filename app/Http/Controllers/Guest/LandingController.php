<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    protected ApiService $api;

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    /**
     * GET /
     * Landing page — tampilkan event + list tiket published
     */
    public function index()
    {
        $response = $this->api->getPublishedTickets();

        $tickets = $response->successful() ? $response->json('data') : [];

        return view('guest.pages.landing.index', compact('tickets'));
    }

    /**
     * GET /order/{ticketId}
     * Halaman form order — tampilkan detail tiket + list diskon aktif milik tiket tersebut
     */
    public function orderForm(int $ticketId)
    {
        $response = $this->api->getPublishedTickets();
        $tickets  = $response->successful() ? $response->json('data') : [];

        // Cari tiket yang dipilih
        $ticket = collect($tickets)->firstWhere('id', $ticketId);

        if (!$ticket) {
            return redirect()->route('landing')->with('error', 'Tiket tidak ditemukan.');
        }

        // Ambil diskon aktif milik tiket ini
        // Note: endpoint public belum ada, jadi kita filter dari data tiket
        // atau bisa tambah endpoint public discounts nanti.
        // Untuk sekarang ambil via admin dengan token null (sesuaikan jika perlu).
        $discounts = [];
        // Jika nanti ada endpoint public discounts, uncomment ini:
        // $discountResponse = $this->api->getPublicDiscounts($ticketId);
        // $discounts = $discountResponse->successful() ? $discountResponse->json('data') : [];

        return view('guest.pages.landing.order', compact('ticket', 'discounts'));
    }

    /**
     * POST /order
     * Proses submit order dari guest
     */
    public function orderStore(Request $request)
    {
        $request->validate([
            'ticket_id'   => 'required|integer',
            'nama'        => 'required|string|max:255',
            'no_hp'       => 'required|string|max:20',
            'email'       => 'required|email',
            'qty'         => 'required|integer|min:1',
            'discount_id' => 'nullable|integer',
        ]);

        $data = [
            'ticket_id'   => $request->ticket_id,
            'nama'        => $request->nama,
            'no_hp'       => $request->no_hp,
            'email'       => $request->email,
            'qty'         => $request->qty,
            'jatuh_tempo' => 1, // hardcode 1 hari, bisa diubah nanti
        ];

        if ($request->filled('discount_id')) {
            $data['discount_id'] = $request->discount_id;
        }

        $response = $this->api->createOrder($data);

        if (!$response->successful()) {
            $message = $response->json('message') ?? 'Gagal membuat order. Silakan coba lagi.';
            return back()->withInput()->with('error', $message);
        }

        $order = $response->json('data');

        return view('guest.pages.landing.thankyou', compact('order'));
    }
}
