<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $userRepository = (new UserRepository());

        if($userRepository->userIsVerified($request->request->get('email'), $request->request->get('password'))) {

            $user = $userRepository->getModel('email', $request->request->get('email'));

            $user->tokens()->delete();

            if ($userRepository->isAdmin($user->id)) {
                $token = $user->createToken('user_token', ['role:admin']);
            } else {
                $token = $user->createToken('user_token', ['role:user']);
            }

            return redirect()
                ->route('login')
                ->with([
                    'success' => 'OK',
                    'token' => $token->plainTextToken
                ]);
        } else {
            return redirect()
                ->route('login');
        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
