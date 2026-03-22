<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected ApiService $api;

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    public function index(Request $request)
    {
        $token   = session('token');
        $summary = [];
        $error   = null;

        try {
            $response = $this->api->getOrderSummary($token);

            if ($response->successful()) {
                $summary = $response->json('data', []);
            } else {
                $error = 'Gagal mengambil data ringkasan order.';
            }
        } catch (\Throwable $e) {
            $error = 'Terjadi kesalahan: ' . $e->getMessage();
        }

        return view('superadmin.pages.dashboard.index', compact('summary', 'error'));
    }
}
