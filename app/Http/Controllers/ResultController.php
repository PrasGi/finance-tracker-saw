<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Bobot;
use App\Models\History;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        if ($request->reset) {
            Result::truncate();
        }

        $datas = Result::paginate(50);
        $alternatifs = Alternatif::all();
        $bobots = Bobot::all();

        return view('pages.result-v2', compact(['datas', 'alternatifs', 'bobots']));
    }

    public function store(Request $request)
    {

        foreach ($request->value as $index => $value) {
            Result::create([
                'alternatif_id' => $index + 1,
                'bobot_id' => $request->bobot_id,
                'value' => $value,
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Result::destroy($id);
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
