<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowProductoController extends Controller
{
    //
    public function show(){
        return view('productos.show');
    }
}
