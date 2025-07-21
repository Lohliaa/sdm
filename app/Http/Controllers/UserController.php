<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $profile = User::orderBy('id', 'asc')->paginate(10000);
        $count = $profile->count();
        $data = $profile->all();
        return view('profile.index', compact('profile', 'count', 'data'));
    }

    public function cari(Request $request)
    {
        $keyword = $request->cari;
        $profile = User::where(function ($query) use ($keyword) {
            $query->where('name', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%")
                ->orWhere('password', 'like', "%{$keyword}%")
                ->orWhere('chain', 'like', "%{$keyword}%")
                ->orWhere('role', 'like', "%{$keyword}%");
        })->get();
        return view('profile.index', compact('profile'));
    }

    public function searchProfile(Request $request)
    {
        $searchTerm = $request->input('profile');

        $query = User::query();

        if ($searchTerm) {
            $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('email', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('password', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('chain', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('role', 'LIKE', '%' . $searchTerm . '%');
        }

        $profile = $query->paginate(100);

        return view('profile.partial.profile', ['profile' => $profile]);
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'chain' => 'required',
            'role' => 'required',
        ]);

        $profile = User::find($id);

        $profile->name = $request->input('name');
        $profile->email = $request->input('email');
        $profile->chain = $request->input('chain');
        // Set the password to be the same as the chain
        $profile->password = bcrypt($request->input('chain'));

        $profile->role = $request->input('role');

        if ($profile->save()) {
            return redirect()->route('profile.index')->with(['success' => 'Data Berhasil Diperbarui!']);
        } else {
            return redirect()->route('profile.index')->with(['error' => 'Data Gagal Diperbarui!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    public function reset_profile()
    {
        User::truncate();
        return response()->json(['success' => "Deleted successfully."]);
    }
}
