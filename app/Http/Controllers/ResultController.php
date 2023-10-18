<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Bobot;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $datas = Result::paginate(50);
        $alternatifs = Alternatif::all();
        $bobots = Bobot::all();
        return view('pages.result', compact(['datas', 'alternatifs', 'bobots']));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'alternatif_id' => 'required',
            'bobot_id' => 'required',
            'value' => 'required',
        ]);

        Result::create($validate);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }
}