<?php

namespace App\Exports;

use App\Models\Activity;
use App\Models\Mutabaah;
use App\Models\Santri;
use App\Models\SantriMutabaahRecord;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Symfony\Component\Console\Input\Input;

class SantriMutabaahDailyReport implements FromView
{
    use Exportable;

    protected $santriID,$mutabaahID;

    public function __construct(String $santriID, String $mutabaahID) {

        $this->santriID = $santriID;
        $this->mutabaahID = $mutabaahID;
    }



    public function view(): View
    {

        $santriID = $this->santriID;
        $santri = Santri::find($santriID);
        $mutabaahID = $this->mutabaahID;
        $mutabaah = Mutabaah::findOrFail($mutabaahID);


        $recordMutabaah = array();

        $recordMutabaahR = SantriMutabaahRecord::where('santri_id', '=', $santriID)
            ->where('mutabaah_id', '=', $mutabaahID)->get();

        foreach ($recordMutabaahR as $key) {
            $act = Activity::findOrFail($key['activity_id']);
            $recordMutabaah[] = [
                "id" => $key['id'],
                "mutabaah_id" => $key['mutabaah_id'],
                "poin" => $act['poin'],
                "status" => $key['status'],
                "activityName" => $act->nama_kegiatan,
            ];
        }

        $widget = [
            "santri" => $santri,
            "mutabaah" => $mutabaah,
            "recordMutabaah" => $recordMutabaah
        ];

        return view('santri.mutabaah.excel.daily')
            ->with(compact('widget'));
    }
}
