<?php

namespace App\Http\Controllers;

use Validator;
use Redirect;
use Auth;
use Input;
use App\User;
use App\Role;
use DB;

class RolesController extends Controller
{
    public function showRoles() {
      $roles = DB::table('roles')->get();
      return view('roles')->with('roles', $roles);
    }

    public function showAddRole() {
      return view('add_role');
    }

    public function addRole()
    {
      $rules = array(
          'name'    => 'required|alphaNum',
          'description' => 'required'
      );
      $validator = Validator::make(Input::all(), $rules);
      if ($validator->fails()) {
        return Redirect::to('roles/add')
            ->withErrors($validator);
      } else {
        $role = new Role();
        $role->name = Input::get('name');
        $role->description = Input::get('description');;
        $role->save();
        return Redirect::to('roles');
      }
    }
}
