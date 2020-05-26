<?php

namespace App\Http\Controllers;

use App\Role;
use App\Access;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::without('role')->get()->except(Auth::user()->id);
        $roles = Role::all();
        return view('user.index', compact('users', 'roles'));
    }

    public function get($user)
    {
        return response()->json(User::findOrFail($user), 200);
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:4',
            'role_id' => 'required',
            'image' => 'required'
        ], [], [
            'role_id' => 'role',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt($req->password);
        $user->role_id = $req->role_id;
        $user->image = $req->image;
        $user->save();
    }

    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'role_id' => 'required'
        ], [], [
            'role_id' => 'Role'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user = User::where('id', $id)->update([
            'role_id' => $req->role_id
        ]);
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect(route('user'))->with([
            'type' =>  'success',
            'message' => 'Berhasil Hapus Data'
        ]);
    }

}
