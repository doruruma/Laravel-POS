<?php

namespace App\Http\Controllers;

use App\Access;
use App\Menu;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::without('accesses')->paginate(4);
        return view('role.index', compact('roles'));
    }

    public function permission($role_id)
    {
        $menus = Menu::all()->except(1);
        $role = Role::findOrFail($role_id);
        return view('role.permission', compact('menus', 'role'));
    }

    public function updatePermission(Request $req, $id)
    {
        foreach ($req->except(['_token']) as $access) {
            if (strpos($access, 'deny') !== false) {
                $menu_id = substr($access, strpos($access, '.') + 1);
                Access::where(['menu_id' => $menu_id, 'role_id' => $id])->delete();
            } else {
                Access::updateOrCreate(['role_id' => $id, 'menu_id' => $access]);
            }
        }
        return redirect(route('role'))->with([
            'type' => 'success',
            'message' => 'Berhasil Mengubah Permission'
        ]);
    }

    public function get($role)
    {
        return response()->json(Role::findOrFail($role));
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'role' => 'required|min:3'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        Role::create($req->all());
    }

    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'role' => 'required|min:3'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        Role::where('id', $id)->update($req->except(['_token']));
    }

    public function delete(Role $role)
    {
        $role->delete();
        return redirect(route('role'))->with([
            'type' => 'success',
            'message' => 'Berhasil Menghapus Data'
        ]);
    }
}
