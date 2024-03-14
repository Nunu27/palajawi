<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        // TODO: fetch category and products

        return view('home');
    }

    public function category()
    {
        // TODO: fetch product by category

        return view('home');
    }

    public function detail(string $id)
    {
        return view('detail', ['barang' => Barang::find($id)]);
    }

    public function filter()
    {
        // TODO: Filter product

        return view('filter');
    }
}
