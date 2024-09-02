<?php

namespace App\Http\Controllers;

use App\Models\Demografi;
use Illuminate\Http\Request;

use function Pest\Laravel\delete;

class MasterDemografiController extends Controller
{

    public function index()
    {
        $demografi = Demografi::get();
        return view('master-demografi', [
            'demografi' => $demografi
        ]);
    }

    protected function findById($id)
    {
        $demografi = Demografi::findOrFail($id);
        return $demografi;
    }

    public function edit($id)
    {
        $demografi = $this->findById($id);
        return view('edit-master-demografi', compact('demografi', 'id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'type_form' => 'required',
        ]);

        Demografi::create([
            'question' => $request->pertanyaan,
            'slug_question' => \Str::slug($request->pertanyaan),
            'form_type' => $request->type_form,
            'answer' => json_encode($request->jawaban),
            'is_positive' => true,
        ]);

        return redirect()->route('master-demografi')->with([
            'success' => "Data Demografi Berhasil disimpan!"
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'type_form' => 'required',
        ]);

        $demografi = $this->findById($id);

        $demografi->question = $request->pertanyaan;
        $demografi->slug_question = \Str::slug($request->pertanyaan);
        $demografi->form_type = $request->type_form;
        $demografi->answer = json_encode($request->jawaban);
        $demografi->is_positive = true;
        $demografi->save();

        return redirect()->route('master-demografi')->with([
            'success' => "Data Demografi Berhasil diupdate!"
        ]);
    }

    public function delete(Request $request)
    {
        $demografi = $this->findById($request->item_id);
        $demografi->delete();
        return redirect()->route('master-demografi')->with([
            'success' => "Data Demografi Berhasil dihapus!"
        ]);
    }
    //
}
