<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    public function viewMatrixKeputusan()
    {
        $datas = DB::table('view_vmatrixkeputusan')->get();
        return view('pages.matrix-keputusan', compact(['datas']));
    }

    public function maximumValue()
    {
        $datas = DB::table('view_vmax')->get();
        return view('pages.value-max', compact('datas'));
    }

    public function viewNormalisasi()
    {
        $datas = DB::table('view_vnormalisasi')->get();

        return view('pages.normalisasi', compact(['datas']));
    }

    public function viewPraRangking()
    {
        $datas = DB::table('view_vprarangking')->get();

        return view('pages.prarangking', compact(['datas']));
    }

    public function viewRangking()
    {
        $datas = DB::table('view_vrangking')->get();

        return view('pages.rangking', compact(['datas']));
    }
}
