<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class WelcomeWidget extends Widget
{
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.widgets.welcome-widget';

    // ইভেন্ট এবং অ্যাটেন্ডি কাউন্ট
    public function getStats()
    {
        return [
            'events' => \Modules\Events\App\Models\Event::count(),
            'attendees' => \Modules\Events\App\Models\Attendee::count(),
        ];
    }

    public function getSystemInfo()
    {
        return [
            'php_version' => phpversion(),
            'laravel_version' => app()->version(),
            'db_status' => $this->checkDatabase(),
            'memory_usage' => $this->getMemoryUsage(),
        ];
    }

    private function checkDatabase()
    {
        try { DB::connection()->getPdo(); return 'Connected'; } catch (\Exception $e) { return 'Disconnected'; }
    }

    private function getMemoryUsage()
    {
        $size = memory_get_usage(true);
        $unit = array('b','kb','mb','gb');
        return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }

    public function getSmsBalance()
    {
        return Cache::remember('bulksms_balance', 600, function () {
            try {
                $response = Http::get("http://bulksmsbd.net/api/getBalanceApi", ['api_key' => '9IZJykFs334eDVVBqu81']);
                return $response->successful() ? ($response->json()['balance'] ?? '0.00') : '0.00';
            } catch (\Exception $e) { return 'Error'; }
        });
    }

    public function getWeatherData()
    {
        // ক্যাশ ক্লিয়ার করার জন্য সাময়িকভাবে সময় কমিয়ে ১ মিনিট করতে পারেন চেক করার সময়
        return Cache::remember('dashboard_weather', 1800, function () {
            try {
                $apiKey = '2911a5c09dde82c468cd88ffe5a470ef'; 
                $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                    'q' => 'Dhaka',
                    'units' => 'metric',
                    'appid' => $apiKey, // নিশ্চিত করুন এখানে কোনো কোটেশন নেই
                ]);

                if ($response->successful()) {
                    return $response->json();
                }
                
                // যদি এরর আসে তবে আপনি চাইলে \Log::info($response->body()); দিয়ে চেক করতে পারেন
                return null;
            } catch (\Exception $e) { return null; }
        });
    }

    public function getUser() { return Auth::user(); }
    public function getRole() { return $this->getUser()?->role ?? 'Admin'; }
}