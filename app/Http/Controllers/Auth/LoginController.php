<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $validator = $this->validator($request->all());

        if (!Auth::attempt($validator->validated())) {

            $validator->errors()
                ->add('email', __('auth.failed'))
                ->add('password', __('auth.failed'));

            throw new ValidationException($validator);
        }

        $token = $this->generateToken(Auth::user()->id);

        return response()->json([
            'status'    => 'success',
            'message'   => __('auth.successful_login'),
            'token'     => $token->plainTextToken,
        ]);
    }

    /**
     * @param array $data
     *
     * @return \Illuminate\Validation\Validator
     *
     */
    public function validator($data)
    {
        $validator = Validator::make($data, [
            'email'     => 'required|email|max:255',
            'password'  => 'required|max:255'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator;
    }

    /**
     *  @param int $userId
     *  @return \Laravel\Sanctum\NewAccessToken
     */
    public function generateToken($userId)
    {
        $user = User::find($userId);

        $tokenName = formatUserAgent(request()->header('User-Agent'));
        $token = $user->createToken($tokenName, []);

        return $token;
    }

    public function logout(Request $request)
    {
    }
}
