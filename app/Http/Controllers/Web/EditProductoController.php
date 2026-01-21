<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditProductoController extends Controller
{
    public function edit(){
        return view('productos.edit');
    }
}
