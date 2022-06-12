<?php

namespace App\Exports;

use App\Models\Activity;
use App\Models\Mutabaah;
use App\Models\SantriMutabaahRecord;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class SantriAllExport  implements FromView
{
    use Exportable;

    protected $santriID, $mutabaahID, $start, $end;

    public function __construct(String $santriID, String $start,String $end)
    {
        $this->santriID = $santriID;
    }



    public function view(): View
    {

        $start = null;
        $end = null;

        $santriID = $this->santriID;
        $mutabaah = Mutabaah::all();
        $recordMutabaah = SantriMutabaahRecord::where('santri_id', '=', $santriID);
        $activityDetail = array();
        $activity = Activity::where('mutabaah_id', '=', $recordMutabaah->first()->id)->get();

        if ($this->start != null  && $this->end !=null) {

            $mutabaah = Mutabaah::whereBetween('tanggal', [$start, $end])->get();


            if ($mutabaah->count() < 1) {
                $activity = Activity::where('mutabaah_id', '=', 0)->get();
                return redirect('santri/mutabaah/report/all')->with(["error"=>"Tidak Ada Mutabaah Pada Tanggal Tersebut"]);
            }
        }

        foreach ($mutabaah as $key) {
            $record = SantriMutabaahRecord::where('santri_id', '=', $santriID);
            $activityDetail[$key->id] =
                $record->where('mutabaah_id', '=', $key->id)->get();
        }


        $widget = [
            "activity" => $activity,
            "activityScore" => $activityDetail,
            "mutabaah" => $mutabaah,
            "recordMutabaah" => $recordMutabaah->get(),
            "start" => $start,
            "end" => $end,
        ];

        return view('santri.mutabaah.excel.all')
            ->with(compact('widget'));
    }
}
