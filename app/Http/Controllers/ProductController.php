<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    function __construct() {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit',['only' => ['edit','update']]);
        $this->middleware('permission:product-delete',['only' => ['destroy']]);
    }



    
}
