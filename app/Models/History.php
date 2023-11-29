<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class History extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function setHistory()
    {
        $datasResult = Result::all();
        $dataRangking = DB::table('view_vrangking')->get();

        $dataRangkingSort = $dataRangking->sortByDesc('rangking')->values()->first();

        $dataHistory = $this->query()->create([
            'result_value' => $dataRangkingSort->alternatif_name
        ]);

        foreach ($datasResult as $data) {
            HistoryDetail::create([
                'history_id' => $dataHistory->id,
                'alternatif_id' => $data->alternatif_id,
                'kriteria_id' => $data->kriteria->id,
                'bobot_id' => $data->bobot_id,
            ]);
        }
    }

    public function historyDetails()
    {
        return $this->hasMany(HistoryDetail::class);
    }
}
