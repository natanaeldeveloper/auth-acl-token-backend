<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $this->validated($request->all());

        if (Auth::attempt($credentials)) {
            //...
        }
    }

    /**
     * @param array $data
     *
     * @return array
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validated($data)
    {
        $validator = Validator::make($data, [
            'email' => 'required|email|max:255',
            'password' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }

    public function logout(Request $request)
    {
    }
}
