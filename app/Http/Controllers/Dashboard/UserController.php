<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

// TODO: Finish up controller

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input("per_page", 10);
        $query = $request->input("query");
        $route = 'user';
        $headers = ['ID', 'Email', 'Nama', 'Admin'];
        $columns = ['id', 'email', 'username', 'admin'];
        $actions = ['view'];
        $data = User::orderBy('id');
        if ($query)
            $data->whereFullText(['email', 'username'], $query);
        $list = $data->paginate($perPage, $columns)->appends($request->except('page'));

        return view('dashboard.user.list', compact('route', 'headers', 'columns', 'actions', 'list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.user.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::castAndCreate($request->all());
        return to_route('user.index')->with('success', '');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.user.detail', ['user' => User::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        User::find($id)->castAndUpdate($request->all());
        return to_route('barang.show', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return to_route('barang.index');
    }
}
