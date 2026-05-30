<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'token_name' => 'nullable|string|max:255',
        ]);

        /** @var User|null $user */
        $user = Auth::user();

        if (! $user) {
            abort(403);
        }

        $tokenName = $request->input('token_name', 'api-token');
        $plainTextToken = $user->createToken($tokenName)->plainTextToken;

        return back()->with('apiToken', $plainTextToken);
    }
}
