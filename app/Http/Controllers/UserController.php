<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.user.index', compact('users'));
    }
    public function index_api()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function delete($id)
    {

        User::where('id', $id)->delete();
        return redirect()->back()->with('delete', '1 Data Berhasil Dihapus.');
    }
}
