<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    
    public function index()
    {
        if (request()->ajax()) {
            $users = User::all()->except(Auth::user()->id);
            return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('role', function ($users) {
                return $users->role->role;
            })
            ->addColumn('Action', function ($users) {
                return view('user.datatable_column', compact('users'));
            })
            ->removeColumn('id')
            ->rawColumns(['Action', 'role'])
            ->make(true);
        }
        $roles = Role::all();
        return view('user.index', compact('roles'));
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
        User::where('id', $id)->update([
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
