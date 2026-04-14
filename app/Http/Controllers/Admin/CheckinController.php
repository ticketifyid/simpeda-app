<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function __construct(protected ApiService $api) {}

    public function index()
    {
        return view('admin.pages.checkin.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_bill' => 'required|string',
            'note'    => 'nullable|string|max:500',
        ]);

        $token   = session('api_token');
        $payload = ['no_bill' => $request->no_bill];

        if ($request->filled('note')) {
            $payload['note'] = $request->note;
        }

        $response = $this->api->checkin($token, $payload);
        $body     = $response->json();

        if ($response->successful() && ($body['success'] ?? false)) {
            return redirect()->route('admin.checkin')
                ->with('checkin_success', true)
                ->with('checkin_result', $body['data']);
        }

        return redirect()->route('admin.checkin')
            ->with('checkin_error', $body['message'] ?? 'Terjadi kesalahan.')
            ->with('checkin_result', $body['data'] ?? null);
    }

    public function myCheckins()
    {
        $token    = session('api_token');
        $response = $this->api->getMyCheckins($token);
        $checkins = [];

        if ($response->successful()) {
            $checkins = $response->json('data') ?? [];
        }

        return view('admin.pages.checkin.my', compact('checkins'));
    }
}
