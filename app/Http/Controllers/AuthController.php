<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Requests\ForgetRequest;
use App\Http\Requests\ResetRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function auth(Request $request) {
        $validator = Validator::make($request->all(),[
            'email' => ['required','email', 'string'],
            'password' => ['required']
            ], 
            [
                'email.required' => "Заполните email адресс",
                'email.email' => "Введенный вами email не является валидным",
                'email.string' => "Email адресс должен быть строковым",
                'password.required' => "Заполните пароль",
        ]);

        $user = auth()->attempt($request->only('email', 'password'));
        if ($validator->passes() && $user) {
            return response()->json(["resultCode"=> 0,'user' => auth()->user()]);
        }

        $errors = $validator->errors()->all();
        if(!$user) $errors[] = "Неправельный email или пароль";

        return response()->json(["resultCode"=> 1,'errors'=>$errors]);
    }

    public function logout() {
        auth('web')->logout();
        return redirect()->back();
    }

    public function register(Request $request, AuthService $authService) {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'min:4', 'max:16', 'unique:users,name'],
            'email' => ['required','email', 'string', 'unique:users,email'],
            'password' => ['required','min:7', 'max:18','confirmed']
            ], 
            [
                'name.required' => "Заполните имя",
                'name.string' => "Имя пользователя должно быть в виде строки",
                'name.min' => "Имя должно содержаться не менее 4 и не более 12 символов",
                'name.max' => "Имя должно содержаться не менее 4 и не более 16 символов",
                'name.unique' => "Пользователь с таким именем уже существует",
                'email.required' => "Заполните email адресс",
                'email.email' => "Введенный вами email не является валидным",
                'email.string' => "Email адресс должен быть строковым",
                'email.unique' => "Пользователь с таким email адресом уже существует",
                'password.required' => "Заполните пароль",
                'password.min' => "Пароль должно содержаться не менее 7 и не более 18 символов",
                'password.max' => "Пароль должно содержаться не менее 7 и не более 18 символов",
                'password.confirmed' => "Пароли должны быть идентичны"
        ]);

        if (!$validator->passes()) {
            return response()->json(["resultCode"=> 1,'errors'=> $validator->errors()->all()]);
        }
        $user = $authService->login($request);
        
        return response()->json(["resultCode"=> 0,'user' => $user]);
    }

    public function forgetShow() {
        return view("auth.forget");
    }

    public function forget(ForgetRequest $request, AuthService $authService) {
        $token = $authService->changeForgotToken($request->email);

        return redirect()->back()->with('success', 'Письмо отправленно на почту');
    }

    public function resetPasswordShow($token) {
        $user = User:: where("token", $token)->first();
        
        if(!$user) {
            return abort(404);
        }
        return view("auth.change_password",[
            "token" => $token
        ]);
    }

    public function resetPassword(ResetRequest $request, AuthService $authService) {
        $authService->reset($request->token, $request->password);
        
        return redirect()->route('index');
    }
}
