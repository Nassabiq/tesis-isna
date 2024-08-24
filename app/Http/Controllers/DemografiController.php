<?php

namespace App\Http\Controllers;

use App\Models\Demografi;
use App\Models\Responden;
use App\Models\UserDemografi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemografiController extends Controller
{
    //
    public function index()
    {
        $demografi = Demografi::get();
        return view('dashboard',  ['demografi' => $demografi]);
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $request->validate([
            'nama_mahasiswa' => 'required',
            'nim' => 'required',
            'jenis_kelamin' => 'required',
            'prodi' => 'required',
            'demografi_answers.*' => 'required',
        ]);

        Responden::create([
            'user_id' => $user_id,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'nim' => $request->nim,
            'jenis_kelamin' => $request->jenis_kelamin,
            'prodi' => $request->prodi,
        ]);

        foreach ($request->demografi_answers as $key => $answer) {
            UserDemografi::create([
                'user_id' => $user_id,
                'demografi_id' => $key,
                'value_answer' => is_array($answer) ? json_encode($answer) : $answer,
            ]);
        }

        dd("success");
        return "success";
    }
}
