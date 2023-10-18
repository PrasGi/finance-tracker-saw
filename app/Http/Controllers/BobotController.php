<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class BobotController extends Controller
{
    public function index()
    {
        $datas = Bobot::paginate(50);
        $kriterias = Kriteria::all();
        return view('pages.bobot', compact(['datas', 'kriterias']));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'kriteria_id' => 'required',
            'value' => 'required',
        ]);

        Bobot::create($validate);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }
}