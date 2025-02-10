<?php



namespace App\Http\Controllers\API;



use App\Http\Controllers\Controller;

use App\Models\Master\MasterUser;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;



class APILoginController extends Controller

{

    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Retrieve user by username
        $user = MasterUser::where('username', $request->username)->first();

        // Check if user exists and MD5 password matches
        if ($user && md5($request->password) === $user->password) {
            // Log the user in using session
            // Auth::login($user);

            // Return success response with user information
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'user' => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role,
                ],
            ], 200);
        }

        // Return error response for invalid credentials
        throw ValidationException::withMessages([
            'username' => ['The provided credentials are incorrect.'],
        ]);
    }

    // Optionally, add a logout method
    public function logout(Request $request)
    {
        // Log the user out of the session
        // Auth::logout();

        return response()->json([
            'success' => true,
            'message' => 'Logout successful',
        ], 200);
    }
}

