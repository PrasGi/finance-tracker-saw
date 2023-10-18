<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        $datas = Alternatif::paginate(50);
        return view('pages.alternatif', compact('datas'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
        ]);

        Alternatif::create($validate);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }
}