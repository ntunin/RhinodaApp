<?php

namespace App\Http\Controllers;

use Validator;
use Redirect;
use Auth;
use Input;
use App\User;
use App\SkypeAccount;
use DB;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function showUsers() {
      $users = DB::table('users')->get();
      return view('users')->with('users', $users);
    }

    public function showEditUser($id) {
      $roles = DB::table('roles')->get();
      return view('edit_user', ['user' => User::findOrFail($id), 'roles'=>$roles]);
    }

    public function editUser($id) {
      $roles = DB::table('roles')->get();
      $user = User::findOrFail($id);
      foreach ($roles as $role) {
        if($this->isRoleSelected($role)) {
          $user->roles()->attach($role->id);
        } else {
          $user->roles()->detach($role->id);
        }
      }
      return Redirect::to('users');
    }

    private function isRoleSelected($role) {
      $inputRoles = Input::get('roles');
      if(!$inputRoles) {
        return false;
      }
      foreach ($inputRoles as $inputRole) {
        if($inputRole == $role->id) {
          return true;
        }
      }
      return false;
    }

    public function linkSkypeAccount(Request $request) {
      $rules = [
          'skype_id' => 'required',
          'name' => 'required'
      ];
      $response = array('data' => '', 'success'=>false);
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $response['data'] = $validator->messages();
      }else{
        $response['success'] = true;
        $user = $request->user();
        $account = new SkypeAccount();
        $account->skype_id = $request->input('skype_id');
        $account->name = $request->input('name');
        $account->save();
        $user->skypeAccounts()->attach($account->id);
      }
      return $response;
    }

    public function logout(){
      Auth::logout();
      return Redirect::to('');
    }
}
