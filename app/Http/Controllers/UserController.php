<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function LoginPage()
    {
        return view('pages.auth.login-page');
    }

    public function RegistrationPage()
    {
        return view('pages.auth.registration-page');
    }

    public function DashboardPage()
    {
        return view('pages.dashboard.dashboard-page');
    }

    public function ProfilePage()
    {
        return view('pages.dashboard.profile-page');
    }

    public function UserRegistration(Request $request)
    {
        try {
            $img = $request->file('image');

            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$t}-{$file_name}";
            $img_url = "uploads/{$img_name}";

            $img->move(public_path('uploads'), $img_name);

            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'address' => $request->input('address'),
                'password' => $request->input('password'),
                'image' => $img_url,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'User Registration Failed',
            ]);
        }
    }

    public function UserLogin(Request $request)
    {
        $count = User::where('email', $request->input('email'))
            ->where('password', $request->input('password'))
            ->select('id', 'name', 'image')->first();
        if ($count !== null) {
            $token = JWTToken::CreateToken($request->input('email'), $count->id);
            return response()->json([
                'status' => 'success',
                'message' => 'User login successfully',
                'user' => $count,
            ])->cookie('token', $token, 3600);
        } else {
            return response()->json([
                'status' => 'faild',
                'message' => 'User login failed',
            ]);

        }
    }

    public function UserProfile(Request $request)
    {
        $email = $request->header('email');
        $user = User::where('email', '=', $email)->first();
        return response()->json([
            'status' => 'success',
            'message' => 'Request Successful',
            'data' => $user,
        ]);
    }

    public function UpdateUserProfile(Request $request)
    {
        
    }

    public function UserLogout(Request $request)
    {
        return redirect('/')->cookie('token', '', -1);
    }
}
