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

        return view('pages.result', compact(['datas', 'alternatifs', 'bobots']));
    }

    public function store(Request $request)
    {

        foreach ($request->bobot_id as $bobot_id) {
            Result::create([
                'alternatif_id' => $request->alternatif_id,
                'bobot_id' => $bobot_id,
                'value' => $request->value[$bobot_id],
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
