<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    protected string $baseUrl;
    protected string $internalKey;

    public function __construct()
    {
        $this->baseUrl     = config('services.api.base_url');
        $this->internalKey = config('services.api.internal_key');
    }

    /**
     * Base HTTP client — selalu bawa X-Internal-App-Key
     */
    private function client(?string $token = null)
    {
        $headers = [
            'X-Internal-App-Key' => $this->internalKey,
            'Accept'             => 'application/json',
        ];

        if ($token) {
            $headers['Authorization'] = 'Bearer ' . $token;
        }

        return Http::withHeaders($headers)->baseUrl($this->baseUrl);
    }

    public function login(string $email, string $password)
    {
        return $this->client()->post('/auth/login', [
            'email'    => $email,
            'password' => $password,
        ]);
    }

    public function logout(string $token)
    {
        return $this->client($token)->post('/auth/logout');
    }

    public function me(string $token)
    {
        return $this->client($token)->get('/auth/me');
    }
    // Ticket - Public
    public function getPublishedTickets()
    {
        return $this->client()->get('/tickets');
    }

    // Ticket - Admin
    public function getAdminTickets(string $token)
    {
        return $this->client($token)->get('/admin/tickets');
    }

    public function getAdminTicket(string $token, int $id)
    {
        return $this->client($token)->get("/admin/tickets/{$id}");
    }

    public function createTicket(string $token, array $data)
    {
        return $this->client($token)->post('/admin/tickets', $data);
    }

    public function updateTicket(string $token, int $id, array $data)
    {
        return $this->client($token)->put("/admin/tickets/{$id}", $data);
    }

    public function deleteTicket(string $token, int $id)
    {
        return $this->client($token)->delete("/admin/tickets/{$id}");
    }
    // Discount - Admin
    public function getDiscounts(string $token)
    {
        return $this->client($token)->get('/admin/discounts');
    }

    public function getDiscount(string $token, int $id)
    {
        return $this->client($token)->get("/admin/discounts/{$id}");
    }

    public function createDiscount(string $token, array $data)
    {
        return $this->client($token)->post('/admin/discounts', $data);
    }

    public function updateDiscount(string $token, int $id, array $data)
    {
        return $this->client($token)->put("/admin/discounts/{$id}", $data);
    }

    public function deleteDiscount(string $token, int $id)
    {
        return $this->client($token)->delete("/admin/discounts/{$id}");
    }

    // Order - Admin
    public function getOrders(string $token)
    {
        return $this->client($token)->get('/admin/orders');
    }

    public function getOrder(string $token, int $id)
    {
        return $this->client($token)->get("/admin/orders/{$id}");
    }

    public function updateOrderStatus(string $token, int $id, string $status)
    {
        return $this->client($token)->put("/admin/orders/{$id}/status", [
            'status' => $status,
        ]);
    }

    public function deleteOrder(string $token, int $id)
    {
        return $this->client($token)->delete("/admin/orders/{$id}");
    }
    // Order - Public (Guest)
    public function createOrder(array $data)
    {
        return $this->client()->post('/orders', $data);
    }
    // Discount - Public
    public function getPublicDiscounts(int $ticketId)
    {
        return $this->client()->get("/tickets/{$ticketId}/discounts");
    }
}
