<?php

namespace App\Http\Controllers;

use App\Models\Kuesioner;
use App\Models\PernyataanKuesioner;
use App\Models\Response;
use App\Models\VariableKuesioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KuesionerController extends Controller
{
    public function index()
    {
        $forms = VariableKuesioner::with('pernyataan')->get();
        return view('kuesioner.isi-kuesioner', [
            'forms' => $forms
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
        return view('kuesioner.hasil-kuesioner');
    }
    //
}
