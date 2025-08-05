<?php

namespace App\Http\Controllers;

use App\Imports\UserImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        set_time_limit(0);
        $user = User::orderBy('id', 'asc')->paginate(10000);
        $count = $user->count();
        $data = $user->all();
        return view('user.index', compact('user', 'count', 'data'));
    }

    public function cari(Request $request)
    {
        $keyword = $request->cari;
        $user = User::where(function ($query) use ($keyword) {
            $query->where('name', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%")
                ->orWhere('password', 'like', "%{$keyword}%")
                ->orWhere('chain', 'like', "%{$keyword}%")
                ->orWhere('role', 'like', "%{$keyword}%");
        })->get();
        return view('user.index', compact('user'));
    }

    public function searchUser(Request $request)
    {
        $searchTerm = $request->input('user');

        $query = User::query();

        if ($searchTerm) {
            $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('email', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('password', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('chain', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('role', 'LIKE', '%' . $searchTerm . '%');
        }

        $user = $query->paginate(100);

        return view('user.partial.user', ['user' => $user]);
    }

    public function upload()
    {
        return view('user.index'); // Buat view ini nanti
    }

    public function uploadProcess(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv', // Sesuaikan dengan kebutuhan
        ]);

        // Contoh: menyimpan file upload ke storage
        $path = $request->file('file')->store('uploads');

        // Jika menggunakan Laravel Excel (opsional)
        Excel::import(new UserImport, $request->file('file'));

        return redirect()->route('user.index')->with('success', 'Data berhasil diupload.');
    }

    public function create()
    {
        return view('user.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'chain' => 'required',
            'role' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'chain' => $request->chain,
            'role' => $request->role,
        ]);
        return redirect()->route('user.index')->with('success', 'Data berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'nullable|min:6',
            'chain' => 'same:password', // bandingkan chain dengan password
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->chain = $request->password;
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        //
    }

    public function deleteItems(Request $request)
    {
        $selectedIds = $request->input('ids');

        User::whereIn('id', $selectedIds)->delete();

        return response()->json(['message' => 'Data berhasil dihapus.']);
    }

    public function reset_user()
    {
        User::truncate();
        return response()->json(['success' => "Deleted successfully."]);
    }
}
