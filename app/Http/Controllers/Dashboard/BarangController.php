<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Barang::orderBy('id')->cursorPaginate($perPage = 15, $columns = ['id', 'cover', 'nama', 'harga']);
        return view('dashboard.barang.list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.barang.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // TODO: upload cover to S3
        Barang::castAndCreate($request->all());
        return to_route('barang.index')->with('success', '');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.barang.detail', ['barang', Barang::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('dashboard.barang.edit', ['barang', Barang::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // TODO: update cover if differ
        Barang::find($id)->castAndUpdate($request->all());
        return to_route('barang.show', compact(['id']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // TODO: Delete cover from S3
        Barang::find($id)->delete();
        return to_route('barang.index');
    }
}
