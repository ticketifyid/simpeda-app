<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\ApiService;

class TicketController extends Controller
{
    public function __construct(protected ApiService $api) {}

    public function index()
    {
        $response = $this->api->getPublishedTickets();

        $tickets = $response->successful()
            ? $response->json('data')
            : [];

        return view('guest.pages.orders.index', compact('tickets'));
    }
}
