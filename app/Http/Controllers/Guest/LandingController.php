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

        $event = [
            'name'     => 'Saveduit',
            'city'     => 'Sinergi Nusantara',
            'date'     => '17 April 2026',
            'location' => 'Grand Ballroom Alila, Solo',
            'poster'   => asset('assets/media/poster/poster-1.jpeg'), // ← ini
        ];

        return view('guest.pages.landing.index', compact('tickets', 'event')); // ← tambah 'event'
    }
    /**
     * GET /order/{ticketId}
     * Halaman form order — tampilkan detail tiket + list diskon aktif milik tiket tersebut
     */
    public function orderForm(int $ticketId)
    {
        $response = $this->api->getPublishedTickets();
        $tickets  = $response->successful() ? $response->json('data') : [];

        $ticket = collect($tickets)->firstWhere('id', $ticketId);

        if (!$ticket) {
            return redirect()->route('landing')->with('error', 'Tiket tidak ditemukan.');
        }

        // Ambil diskon aktif milik tiket ini
        $discountResponse = $this->api->getPublicDiscounts($ticketId);
        $discounts = $discountResponse->successful() ? $discountResponse->json('data') : [];

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
            'jatuh_tempo' => 1,
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

        // Redirect ke halaman thank you dengan order ID
        return redirect()->route('landing.thankyou', ['orderId' => $order['id']]);
    }

    public function thankYou(int $orderId)
    {
        $response = $this->api->getOrderById($orderId);

        if (!$response->successful()) {
            return redirect()->route('landing')->with('error', 'Order tidak ditemukan.');
        }

        $order  = $response->json('data');
        $ticket = $order['ticket'] ?? null;

        return view('guest.pages.landing.thankyou', compact('order', 'ticket'));
    }
}
