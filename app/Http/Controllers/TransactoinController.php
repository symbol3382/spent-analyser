<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactoinController extends Controller {
    public function createTransaction(Request $request) {
        dd($request->all());
    }
}
