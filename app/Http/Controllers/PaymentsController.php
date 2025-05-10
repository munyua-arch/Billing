<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payments;

class PaymentsController extends Controller
{
    //
     //
     public function index()
     {
         $payments = Payments::all();
 
         return view('payments.index', compact('payments'));
     }
 
     public function create()
     {
         
     }
 
 
     public function store(Request $request)
     {
 
        
       
     }
 
     public function edit($id)
     {
 
     }
 
     public function delete($id)
     {
         
     }
}
