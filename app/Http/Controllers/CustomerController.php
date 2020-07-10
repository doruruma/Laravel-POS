<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    
    public function index()
    {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
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
