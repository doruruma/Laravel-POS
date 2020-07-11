<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'address' => 'required|min:4',
            'phone' => 'required|numeric|min:11'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $customer = new Customer;
        $customer->name = $req->name;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone = $req->phone;
        $customer->save();
    }

    public function delete(Customer $customer)
    {
        $customer->delete();
        return redirect(route('customer'))->with([
            'type' => 'success',
            'message' => 'Berhasil Hapus Data'
        ]);
    }
}
