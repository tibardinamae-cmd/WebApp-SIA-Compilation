<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function admin(Request $request): View
    {
        $loggedInUser = Auth::user();

        if ($loggedInUser->role !== 'admin') {
            abort(403);
        }

        $search = $request->query('search');
        $filterRole = $request->query('role');

        $usersQuery = User::select(['id', 'name', 'email', 'role']);

        if ($search) {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if (in_array($filterRole, ['admin', 'user'], true)) {
            $usersQuery->where('role', $filterRole);
        }

        $ownUsers = $usersQuery->get()->toArray();

        $externalPosts = Cache::remember('external_posts', now()->addMinutes(10), function () {
            $response = Http::timeout(5)->get('https://jsonplaceholder.typicode.com/posts');

            if (! $response->successful()) {
                Log::warning('JSONPlaceholder posts request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return [];
            }

            return $response->json();
        });

        $weatherForecast = Cache::remember('weather_forecast', now()->addMinutes(10), function () {
            $response = Http::timeout(5)->get('https://api.open-meteo.com/v1/forecast', [
                'latitude' => 35.6895,
                'longitude' => 139.6917,
                'current_weather' => 'true',
                'hourly' => 'temperature_2m',
            ]);

            if (! $response->successful()) {
                Log::warning('Weather API request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return [];
            }

            return $response->json();
        });

        return view('dashboard', [
            'dashboardType' => 'admin',
            'loggedInUser' => $loggedInUser,
            'ownUsers' => $ownUsers,
            'externalPosts' => $externalPosts,
            'weatherForecast' => $weatherForecast,
            'search' => $search,
            'filterRole' => $filterRole,
        ]);
    }

    public function user(Request $request): View
    {
        $loggedInUser = Auth::user();

        if ($loggedInUser->role !== 'user') {
            abort(403);
        }

        $weatherForecast = Cache::remember('weather_forecast_user', now()->addMinutes(10), function () {
            $response = Http::timeout(5)->get('https://api.open-meteo.com/v1/forecast', [
                'latitude' => 35.6895,
                'longitude' => 139.6917,
                'current_weather' => 'true',
            ]);

            if (! $response->successful()) {
                Log::warning('Weather API request failed for user dashboard', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return [];
            }

            return $response->json();
        });

        return view('dashboard', [
            'dashboardType' => 'user',
            'loggedInUser' => $loggedInUser,
            'ownUsers' => [],
            'externalPosts' => [],
            'weatherForecast' => $weatherForecast,
            'search' => null,
            'filterRole' => null,
        ]);
    }

    public function weather(Request $request): View
    {
        $loggedInUser = Auth::user();

        $weatherForecast = Cache::remember('weather_forecast_page', now()->addMinutes(10), function () {
            $response = Http::timeout(5)->get('https://api.open-meteo.com/v1/forecast', [
                'latitude' => 40.7128,
                'longitude' => -74.0060,
                'current_weather' => 'true',
            ]);

            if (! $response->successful()) {
                Log::warning('Weather API request failed for weather page', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return [];
            }

            return $response->json();
        });

        return view('weather', [
            'loggedInUser' => $loggedInUser,
            'weatherForecast' => $weatherForecast,
        ]);
    }
}
