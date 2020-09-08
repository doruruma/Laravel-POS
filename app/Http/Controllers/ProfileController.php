<?php

namespace App\Http\Controllers;

use App\User;
use App\Rules\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public function index()
    {
        $created_at = date_create(Auth::user()->created_at);
        $date_now = date_create(date('Y-m-d H:i:s'));
        $interval_created = date_diff($created_at, $date_now);

        $updated_at = date_create(Auth::user()->updated_at);
        $date_now = date_create(date('Y-m-d H:i:s'));
        $interval_updated = date_diff($updated_at, $date_now);

        $role = User::find(Auth::user()->id)->role->role;
        return view('profile.index', ['created' => $interval_created, 'updated' => $interval_updated, 'role' => $role]);
    }

    public function profile()
    {
        return view('profile.profile');
    }

    public function password()
    {
        return view('profile.password');
    }

    public function updatePassword(Request $req)
    {
        $req->validate([
            'old' => ['required', new Password],
            'new' => 'required|min:4|different:old|confirmed',
        ], [], [
            'old' => 'Old Password',
            'new' => 'New Password',
        ]);
        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($req->new);
        $user->save();
        return redirect(route('profile'))->with([
            'type' => 'success',
            'message' => 'Berhasil Ubah Password'
        ]);
    }

    public function updateProfile(Request $req)
    {
        $req->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'image' => 'nullable|mimes:jpeg,jpg,png'
        ]);
        $user = User::find(Auth::user()->id);
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $imageName = Str::slug($req->name) . '.' . $image->getClientOriginalExtension();
            if (Auth::user()->image !== 'default_profile.png') {
                unlink(public_path('dist/img/profile/' . Auth::user()->image));
            }
            $image->move(public_path('dist/img/profile'), $imageName);
            $user->image = $imageName;
        }
        $user->name = $req->name;
        $user->email = $req->email;
        $user->save();
        return redirect(route('profile'))->with([
            'type' => 'success',
            'message' => 'Berhasil Perbarui Profile'
        ]);
    }
}
