<?php

namespace App\Http\Controllers;

use App\Models\Demografi;
use App\Models\Kuesioner;
use App\Models\PernyataanKuesioner;
use App\Models\Response;
use App\Models\UserDemografi;
use App\Models\VariableKuesioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KuesionerController extends Controller
{
    public function index()
    {
        $title = 'Isi Kuesioner';
        $forms = VariableKuesioner::with('pernyataan')->get();
        return view('kuesioner.isi-kuesioner', [
            'forms' => $forms,
            'title' => $title
        ]);
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $request->validate([
            'kuesioner_answers' => 'required',
        ]);

        $kuesioner = Kuesioner::create([
            'user_id' => $user_id,
            'created_by' => $user_id,
        ]);

        foreach ($request->kuesioner_answers as $key => $value) {
            Response::create([
                'kuesioner_id' => $kuesioner->id,
                'pernyataan_kuesioner_id' => $key,
                'value_kuesioner' => $value,
            ]);
        }

        dd($request->all());
    }
    public function results()
    {
        $title = 'Isi Kuesioner';
        $demografi = $this->hasilDemografi();
        return view('kuesioner.hasil-kuesioner', compact('demografi', 'title'));
    }


    public function hasilDemografi()
    {

        $demografi = DB::select(
            " SELECT 
                demografi.id, 
                demografi.question, 
                user_demografi.value_answer, 
                COUNT(user_demografi.value_answer) as jumlah 
            FROM demografi
            JOIN user_demografi ON user_demografi.demografi_id = demografi.id
            GROUP BY user_demografi.value_answer, demografi.question, demografi.id
            ORDER BY demografi.id ASC; "
        );
        // dd($demografi);
        return $demografi;
    }
    //
}
