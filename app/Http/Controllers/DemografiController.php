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

        $user_result = [];
        $user = UserDemografi::where('user_id', Auth::user()->id)->get();
        foreach ($user as $value) {
            $user_result[$value->user_id][] = $value;
        }

        return view('dashboard',  [
            'demografi' => $demografi,
            'user' => $user_result,
        ]);
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $request->validate([
            'nama_mahasiswa' => 'required',
            'nim' => 'required',
            'jenis_kelamin' => 'required',
            'prodi' => 'required',
            'demografi_answers' => 'required|array',
            'demografi_answers.*.pengalaman-menggunakan-artificial-intelligence-ai' => 'required',
            'demografi_answers.*.lama-penggunaan-teknologi-kecerdasan-buatan' => 'required',
            'demografi_answers.*.intensitas-penggunaan-teknologi-kecerdasan-buatan' => 'required',
            'demografi_answers.*.kendala-penggunaan-teknologi-kecerdasan-buatan' => 'required',
            'demografi_answers.*.teknologi-ai-yang-sering-digunakan' => 'required',
        ]);
        dd($request->all());

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

        return redirect()->route('dashboard')->with([
            'success' => "Data Kuesioner Berhasil disimpan!"
        ]);
    }
}
