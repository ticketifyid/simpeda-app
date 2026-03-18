<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected ApiService $api;

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    public function index()
    {
        $token    = session('api_token');
        $response = $this->api->getOrders($token);

        if (!$response->successful()) {
            return back()->with('error', 'Gagal mengambil data order.');
        }

        return view('superadmin.pages.orders.index', [
            'orders' => $response->json('data'),
        ]);
    }

    public function updateStatus(Request $request, int $id)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,failed,expired',
        ]);

        $response = $this->api->updateOrderStatus(
            session('api_token'),
            $id,
            $request->status
        );

        if (!$response->successful()) {
            $message = $response->json('message') ?? 'Gagal mengupdate status order.';
            return back()->with('error', $message);
        }

        return redirect()->route('superadmin.order')
            ->with('success', 'Status order berhasil diupdate.');
    }

    public function destroy(int $id)
    {
        $response = $this->api->deleteOrder(session('api_token'), $id);

        if (!$response->successful()) {
            $message = $response->json('message') ?? 'Gagal menghapus order.';
            return back()->with('error', $message);
        }

        return redirect()->route('superadmin.order')
            ->with('success', 'Order berhasil dihapus.');
    }
    public function export(Request $request)
    {
        $request->validate([
            'status' => 'nullable|in:pending,paid,failed,expired',
        ]);

        $filters  = array_filter($request->only(['status']));
        $response = $this->api->exportOrders(session('api_token'), $filters);

        if (!$response->successful()) {
            return back()->with('error', 'Gagal mengexport data order.');
        }

        $filename = 'orders-' . now()->format('Ymd-His') . '.xlsx';

        return response($response->body(), 200, [
            'Content-Type'        => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
