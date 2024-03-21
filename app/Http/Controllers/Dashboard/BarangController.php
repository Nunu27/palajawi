<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input("per_page", 10);
        $query = $request->input("query");
        $route = 'barang';
        $headers = ['ID', 'Cover', 'Nama', 'Harga'];
        $columns = ['id', 'cover', 'nama', 'harga'];
        $actions = ['view', 'edit', 'delete'];
        $data = Barang::orderBy('id');
        if ($query)
            $data->whereFullText(['nama', 'deskripsi'], $query);
        $list = $data->paginate($perPage, $columns)->appends($request->except('page'));

        return view('dashboard.barang.list', compact('route', 'headers', 'columns', 'actions', 'list'));
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
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
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
        $barang = Barang::find($id);
        $ext = substr($barang->cover, strrpos($barang->cover, '.'));
        Storage::disk('s3')->delete($id . $ext);
        $barang->delete();
        return to_route('barang.index');
    }
}
