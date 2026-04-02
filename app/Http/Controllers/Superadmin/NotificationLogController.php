<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use Illuminate\Http\Request;

class NotificationLogController extends Controller
{
    public function __construct(protected ApiService $api) {}

    /**
     * GET /superadmin/notification-log
     */
    public function index(Request $request)
    {
        $token    = session('api_token');
        $response = $this->api->getNotificationLogs($token);

        $logs = $response->successful() ? $response->json('data') : [];

        // Kelompokkan per order, pisah channel email & whatsapp
        $grouped = collect($logs)->groupBy('order_id')->map(function ($items) {
            $email    = collect($items)->firstWhere('channel', 'email');
            $whatsapp = collect($items)->firstWhere('channel', 'whatsapp');

            return [
                'order'     => $items->first()['order'],
                'email'     => $email,
                'whatsapp'  => $whatsapp,
            ];
        })->values()->all();

        return view('superadmin.pages.notification-log.index', compact('grouped'));
    }

    /**
     * POST /superadmin/notification-log/{id}/retry
     */
    public function retry(int $id)
    {
        $token    = session('api_token');
        $response = $this->api->retryNotification($token, $id);

        if ($response->successful()) {
            return back()->with('success', 'Notifikasi berhasil dikirim ulang.');
        }

        $message = $response->json('message') ?? 'Gagal mengirim ulang notifikasi.';

        return back()->with('error', $message);
    }
}
