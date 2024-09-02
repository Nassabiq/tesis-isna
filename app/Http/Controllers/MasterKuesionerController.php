<?php

namespace App\Http\Controllers;

use App\Models\PernyataanKuesioner;
use App\Models\VariableKuesioner;
use Illuminate\Http\Request;

class MasterKuesionerController extends Controller
{
    public function index()
    {
        $kuesioner = PernyataanKuesioner::with('variable')->get();
        $variable = $this->findVariable();

        return view('master-kuesioner', compact('kuesioner', 'variable'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'isi_kuesioner' => 'required',
            'variable' => 'required',
            'indikator' => 'required',
            'kode_indikator' => 'required',
            'is_positive' => 'required'
        ]);

        PernyataanKuesioner::create([
            'isi_kuesioner' => $request->isi_kuesioner,
            'variable_id' => $request->variable,
            'indikator' => $request->indikator,
            'kode_indikator' => $request->kode_indikator,
            'is_positive' => $request->is_positive,
        ]);

        return redirect()->route('master-kuesioner')->with([
            'success' => "Data Kuesioner Berhasil disimpan!"
        ]);
    }

    protected function findById($id)
    {
        $kuesioner = PernyataanKuesioner::with('variable')->findOrFail($id);
        return $kuesioner;
    }

    protected function findVariable()
    {
        $variable = VariableKuesioner::select(['id', 'variable_nama'])->get();
        return $variable;
    }

    public function edit($id)
    {
        $kuesioner = $this->findById($id);
        $variable = $this->findVariable();
        return view('edit-master-kuesioner', compact('kuesioner', 'id', 'variable'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'isi_kuesioner' => 'required',
            'variable' => 'required',
            'indikator' => 'required',
            'kode_indikator' => 'required',
            'is_positive' => 'required'
        ]);

        $kuesioner = $this->findById($id);
        $kuesioner->isi_kuesioner = $request->isi_kuesioner;
        $kuesioner->variable_id = $request->variable;
        $kuesioner->indikator = $request->indikator;
        $kuesioner->kode_indikator = $request->kode_indikator;
        $kuesioner->is_positive = $request->is_positive;
        $kuesioner->save();

        return redirect()->route('master-kuesioner')->with([
            'success' => "Data Kuesioner Berhasil diupdate!"
        ]);
    }

    public function delete(Request $request)
    {
        $kuesioner = $this->findById($request->item_id);
        $kuesioner->delete();

        return redirect()->route('master-kuesioner')->with([
            'success' => "Data Kuesioner Berhasil dihapus!"
        ]);
    }
}
