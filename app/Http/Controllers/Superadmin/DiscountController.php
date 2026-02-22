<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    protected ApiService $api;

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    /**
     * GET /superadmin/discount
     * Tampilkan halaman utama + list semua diskon
     */
    public function index(Request $request)
    {
        $token    = session('api_token');
        $response = $this->api->getDiscounts($token);

        if (!$response->successful()) {
            return back()->with('error', 'Gagal mengambil data diskon.');
        }

        // Ambil juga list tiket untuk opsi dropdown di form create/edit
        $ticketResponse = $this->api->getAdminTickets($token);
        $tickets        = $ticketResponse->successful()
            ? $ticketResponse->json('data')
            : [];

        return view('superadmin.pages.discount.index', [
            'discounts' => $response->json('data'),
            'tickets'   => $tickets,
        ]);
    }

    /**
     * POST /superadmin/discount
     * Buat diskon baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|integer',
            'name'      => 'required|string|max:255',
            'type'      => 'required|in:percentage,fixed',
            'qty'       => 'required|integer|min:1',
            'price'     => 'required|numeric|min:0',
            'status'    => 'sometimes|in:active,inactive',
        ]);

        $response = $this->api->createDiscount(session('api_token'), $request->only([
            'ticket_id',
            'name',
            'type',
            'qty',
            'price',
            'status',
        ]));

        if (!$response->successful()) {
            $message = $response->json('message') ?? 'Gagal membuat diskon.';
            return back()->withInput()->with('error', $message);
        }

        return redirect()->route('superadmin.discount')
            ->with('success', 'Diskon berhasil dibuat.');
    }

    /**
     * PUT /superadmin/discount/{id}
     * Update diskon
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'ticket_id' => 'sometimes|integer',
            'name'      => 'sometimes|string|max:255',
            'type'      => 'sometimes|in:percentage,fixed',
            'qty'       => 'sometimes|integer|min:1',
            'price'     => 'sometimes|numeric|min:0',
            'status'    => 'sometimes|in:active,inactive',
        ]);

        $response = $this->api->updateDiscount(session('api_token'), $id, $request->only([
            'ticket_id',
            'name',
            'type',
            'qty',
            'price',
            'status',
        ]));

        if (!$response->successful()) {
            $message = $response->json('message') ?? 'Gagal mengupdate diskon.';
            return back()->withInput()->with('error', $message);
        }

        return redirect()->route('superadmin.discount')
            ->with('success', 'Diskon berhasil diupdate.');
    }

    /**
     * DELETE /superadmin/discount/{id}
     * Hapus diskon
     */
    public function destroy(int $id)
    {
        $response = $this->api->deleteDiscount(session('api_token'), $id);

        if (!$response->successful()) {
            $message = $response->json('message') ?? 'Gagal menghapus diskon.';
            return back()->with('error', $message);
        }

        return redirect()->route('superadmin.discount')
            ->with('success', 'Diskon berhasil dihapus.');
    }
}
