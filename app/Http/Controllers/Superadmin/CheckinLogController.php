<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Services\ApiService;

class CheckinLogController extends Controller
{
    public function __construct(protected ApiService $api) {}

    public function index()
    {
        $token    = session('api_token');
        $response = $this->api->getAllCheckinLogs($token);

        $logs     = [];
        $summary  = [
            'total_paid_orders'        => 0,
            'total_paid_tickets'       => 0,
            'total_checked_in_orders'  => 0,
            'total_checked_in_tickets' => 0,
            'total_remaining_orders'   => 0,
            'total_remaining_tickets'  => 0,
        ];
        $byTicket = [];

        if ($response->successful()) {
            $data     = $response->json('data') ?? [];
            $logs     = $data['logs']['data'] ?? [];  // paginated response
            $summary  = $data['summary']   ?? $summary;
            $byTicket = $data['by_ticket'] ?? [];
        } else {
            session()->flash('error', 'Gagal memuat data check-in logs.');
        }

        return view('superadmin.pages.checkin-log.index', compact('logs', 'summary', 'byTicket'));
    }
}
