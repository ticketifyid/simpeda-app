<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckOperationalHours
{
    protected int $openHour  = 14;
    protected int $closeHour = 2;

    public function handle(Request $request, Closure $next)
    {
        $now  = now()->timezone('Asia/Jakarta');
        $hour = (int) $now->format('G');

        if ($this->openHour > $this->closeHour) {
            $isOpen = $hour >= $this->openHour || $hour < $this->closeHour;
        } else {
            $isOpen = $hour >= $this->openHour && $hour < $this->closeHour;
        }

        // ✅ Kalau akses /maintenance tapi sudah jam buka → redirect ke landing
        if ($request->routeIs('maintenance') && $isOpen) {
            return redirect()->route('landing');
        }

        // ✅ Kalau bukan /maintenance tapi jam tutup → redirect ke maintenance
        if (!$request->routeIs('maintenance') && !$isOpen) {
            return redirect()->route('maintenance');
        }

        return $next($request);
    }
}
