<?php
// app/Http/Middleware/CheckOperationalHours.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckOperationalHours
{
    // Atur jam operasional di sini
    protected int $openHour  = 8;  // buka jam 08:00
    protected int $closeHour = 17; // tutup jam 17:00

    public function handle(Request $request, Closure $next)
    {
        $now = now()->timezone('Asia/Jakarta');
        $hour = (int) $now->format('G'); // format 'G' = jam tanpa leading zero

        $isOpen = $hour >= $this->openHour && $hour < $this->closeHour;

        if (!$isOpen) {
            // Kalau sudah punya route maintenance
            return redirect()->route('maintenance');

            // Atau kalau mau pakai view langsung tanpa route:
            // return response()->view('maintenance', [], 503);
        }

        return $next($request);
    }
}
