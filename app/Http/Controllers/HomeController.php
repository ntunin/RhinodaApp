<?php

namespace App\Http\Controllers;

use Validator;
use Redirect;
use Auth;
use Input;
use App\User;

class HomeController extends Controller
{
    public function showLogin()
    {
        // show the form
        return view('login');
    }

    public function doLogin()
    {
      $rules = array(
          'email'    => 'required|email', // make sure the email is an actual email
          'password' => 'required|alphaNum|min:6' // password can only be alphanumeric and has to be greater than 3 characters
      );
      $validator = Validator::make(Input::all(), $rules);
      if ($validator->fails()) {
          return Redirect::to('login')
              ->withErrors($validator) // send back all errors to the login form
              ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
      } else {
          $userdata = array(
              'email'     => Input::get('email'),
              'password'  => Input::get('password')
          );
          if (Auth::attempt($userdata)) {
              return Redirect::to('');
          } else {
              return Redirect::to('login')->withErrors(array('auth' => 'Invalid username or password'));

          }
      }
    }

    public function showRegister()
    {
        // show the form
        return view('register');
    }

    public function doRegister()
    {
      $rules = array(
          'email'    => 'required|email', // make sure the email is an actual email
          'password' => 'required|alphaNum|confirmed|min:6', // password can only be alphanumeric and has to be greater than 3 characters
      );
      $validator = Validator::make(Input::all(), $rules);
      if ($validator->fails()) {
          return Redirect::to('register')
              ->withErrors($validator) // send back all errors to the login form
              ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
      } else {
          User::create([
              'email' => Input::get('email'),
              'password' => bcrypt(Input::get('password')),
          ]);
          return Redirect::to('');
      }
    }
}
