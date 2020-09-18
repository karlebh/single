<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $data = request()->validate([
                    'name' => 'required|string|min:4|max:12',
                    'password' => 'required|string|min:6',
        ]);

        // $credentials = $request->only('name', 'password');

        if ($token = $this->guard()->attempt($data)) {
            return $this->respondWithToken($token);
        }
        return response()->json(['error' => 'Login credentials do not match our data'], 401);
    }

    /**
     * Register a user
     *
     * @return \Illuminate\Http\JsonResponse
     */

    
    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'name' => 'required|min:4|max:20',
            'password' => 'required|min:6|confirmed',
            // 'password_confirmation' => 'min:6|same:password',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);
        // $user = User::first();
        $token = \JWTAuth::fromUser($user);
        
        return \Response::json(compact('token'), 200);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}