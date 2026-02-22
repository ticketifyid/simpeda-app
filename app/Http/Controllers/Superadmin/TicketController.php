<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(protected ApiService $api) {}

    public function index()
    {
        $response = $this->api->getAdminTickets(session('api_token'));

        $tickets = $response->successful()
            ? $response->json('data')
            : [];

        return view('superadmin.pages.tickets.index', compact('tickets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'qty'    => 'required|integer|min:1',
            'price'  => 'required|numeric|min:0',
            'status' => 'sometimes|in:published,inactive',
        ]);

        $response = $this->api->createTicket(
            session('api_token'),
            $request->only(['name', 'qty', 'price', 'status'])
        );

        if (!$response->successful()) {
            return back()->withErrors(['error' => 'Gagal membuat tiket.']);
        }

        return back()->with('success', 'Tiket berhasil dibuat.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'   => 'sometimes|string|max:255',
            'qty'    => 'sometimes|integer|min:1',
            'price'  => 'sometimes|numeric|min:0',
            'status' => 'sometimes|in:published,inactive',
        ]);

        $response = $this->api->updateTicket(
            session('api_token'),
            $id,
            $request->only(['name', 'qty', 'price', 'status'])
        );

        if (!$response->successful()) {
            return back()->withErrors(['error' => 'Gagal mengupdate tiket.']);
        }

        return back()->with('success', 'Tiket berhasil diupdate.');
    }

    public function destroy($id)
    {
        $response = $this->api->deleteTicket(session('api_token'), $id);

        if (!$response->successful()) {
            $message = $response->json('message') ?? 'Gagal menghapus tiket.';
            return back()->withErrors(['error' => $message]);
        }

        return back()->with('success', 'Tiket berhasil dihapus.');
    }
}
