<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $datas = Kriteria::paginate(50);
        return view('pages.kriteria', compact('datas'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
        ]);

        Kriteria::create($validate);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }
}