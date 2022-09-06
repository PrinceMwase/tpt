<?php
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Login
 */


/**
 * get Token by logging in
 */
Route::post('/sanctum/token', function (Request $request) {
     $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);
 
    $credentials = Array("email" => $request->email, "password" => $request->password);

    $user = User::where('email', $request->email)->first();
    
    if ($user ) {
        Auth::attempt($credentials);
    }
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
 
    return $user->createToken($request->device_name)->plainTextToken;
});

// register new user
Route::post("/sanctum/register", function(Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'device_name' => 'required',
    ]);

    $credentials = Array("email" => $request->email, "password" => $request->password);
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    if ($user ) {
        Auth::attempt($credentials);
    }

    return $user->createToken($request->device_name)->plainTextToken;
} );

// get currrent User
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});