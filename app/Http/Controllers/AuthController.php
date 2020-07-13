<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;
use JWTAuth;
use JWTAuthException;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','registerUser']]);
    }

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
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){


    	$validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|string|min:6',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json('Wrong credentials, Try again!');

        }
        $JWT_Info = $this->createNewToken($token);
        $user = auth()->user();

        Session::put(['user'=>$user,'token_info'=>$JWT_Info]);
        return response()->json(route('calendar'));
       }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {


            $ses =Session::forget('user');
        return response()->json(url('/'));
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
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
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


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

            Session::put(['user'=>$user,'token'=>$token]);
            return redirect()->route('calendar');
        }

    }

    protected function createNewToken($token){

        $data =([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);

        return $data;
    }

}



