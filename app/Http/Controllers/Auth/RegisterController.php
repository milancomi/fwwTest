<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use JWTAuth;
use JWTAuthException;
use Session;


class RegisterController extends Controller
{
    private function getToken($name, $password)
    {
        $token = null;
        //$credentials = $request->only('name', 'password');
        try {
            if (!$token = JWTAuth::attempt( ['name'=>$name, 'password'=>$password])) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'Password or name is invalid',
                    'token'=>$token
                ]);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'Token creation failed',
            ]);
        }
        return $token;
    }


    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }



    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255','unique:users'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8','regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}/'],
        ]);
    }

// 2.'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'
    //REGEX
  // SPECIAL CHAR       (?=.*?[#?!@$%^&*-])
// ONE NUMBER           (?=.*?[0-9])
// One letter           (^[A-Za-z]\\d+$)


    public function registerUser(Request $request)
    {

       $validate_data = $this->validator($request->all())->validate();

        $payload = [
            'password'=>\Hash::make($validate_data['password']),
            'name'=>$validate_data['name'],
            'auth_token'=> ''
        ];

        $user = new \App\User($payload);
        if ($user->save())
        {


            $token = self::getToken($validate_data['name'], $validate_data['password']); // generate user token

            if (!is_string($token))  return response()->json(['success'=>false,'data'=>'Token generation failed'], 201);

            $user = \App\User::where('name', $validate_data['name'])->get()->first();

            $user->auth_token = $token; // update user token

            $user->save();

            Session::put(['user'=>$user]);
            return redirect()->route('calendar');
        }

    }
}
