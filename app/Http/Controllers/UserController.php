<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
session_start();

class UserController extends Controller
{
    public function index()
    {
        return 'a';
    }

    public function getList()
    {
        return 'a';
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]
//            , [
//            'required' => 'Vui lòng điền vào :attribute.',
//            'password.min' => 'Password phải ít nhất :min kí tự.',
//        ]
        );

        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember');

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember))
            return redirect()->route('home');
        else
            return redirect()->back()->withErrors(array('warning' => 'Username hoặc mật khẩu không đúng!'));
    }

    public function loginAjax()
    {
        if(empty($_POST['email']))
            $data['errorEmail'] = 'The Email field is required.';
        elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            $data['errorEmail'] = 'The Email must be a valid email address.';

        if(empty($_POST['password'])) {
            $data['errorPassword'] = 'The Password field is required.';
        }

        if(empty($data)) {
            if (Auth::attempt(['email' => $_POST['email'], 'password' => $_POST['password']], $_POST['remember']))
                return 'success';
            else
                return 'error';

        } else
            return $data;
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function registerAjax()
    {
        $countUser = User::where('email', $_POST['email'])->count();

        if (empty($_POST['email'])) {
            $data['errorEmail'] = 'The Email field is required.';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $data['errorEmail'] = 'The Email must be a valid email address.';
        } elseif ($countUser > 0) {
            $data['errorEmail'] = 'The Email has already been taken.';
        }

        if (empty($_POST['password'])) {
            $data['errorPassword'] = 'The Password field is required.';
        } elseif (strlen($_POST['password']) < 5) {
            $data['errorPassword'] = 'The Password must be at least 5 characters.';
        }

        if (empty($_POST['re_password'])) {
            $data['errorPasswordConfirm'] = 'The Password Confirm is required.';
        } elseif ($_POST['re_password'] != $_POST['password']) {
            $data['errorPasswordConfirm'] = 'The Password Confirm and Password must match.';
        }

        if (empty($data)) {
            $user = User::create([
                'email' => $_POST['email'],
                'password' => bcrypt($_POST['password'])
            ]);

            Auth::login($user);

            return 'success';
        } else {
            return $data;
        }
    }

    public function registerCheckout()
    {
        $countUser = User::where('email', $_POST['email'])->count();

        if ($countUser > 0)
            return 'email is exist';

        if (empty($_POST['first_name']))
            $data['errorFirstName'] = 'The First name field is required';

        if (empty($_POST['last_name']))
            $data['errorLastName'] = 'The Last name field is required';

        if (empty($_POST['email'])) {
            $data['errorEmail'] = 'The Email field is required.';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $data['errorEmail'] = 'The Email must be a valid email address.';
        }

        if (empty($_POST['phone']))
            $data['phone'] = 'The Phone field is required';

        if (empty($_POST['address']))
            $data['address'] = 'The Address field is required';

        if (empty($_POST['password'])) {
            $data['errorPassword'] = 'The Password field is required.';
        } elseif (strlen($_POST['password']) < 5) {
            $data['errorPassword'] = 'The Password must be at least 5 characters.';
        }

        if (empty($data)) {
            $user = User::create([
                'email' => $_POST['email'],
                'password' => bcrypt($_POST['password']),
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address']
            ]);

            Auth::login($user);

            return 'success';
        } else {
            return $data;
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
