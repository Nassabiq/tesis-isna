<?php

namespace App\Http\Controllers;

use App\Models\Kuesioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelPdf\Facades\Pdf;

class PDFController extends Controller
{
    //

    protected $kuesionerController;
    public function __construct(KuesionerController $kuesionerController)
    {
        $this->kuesionerController = $kuesionerController;
    }

    public function generatePDFAnalisis()
    {
        // Kuesioner
        $kuesioner = $this->kuesionerController->hasilKuesioner();
        $hasilkuesioner = [];

        foreach ($kuesioner as $item) {
            $var = $item->variable_nama;
            if (!isset($hasilkuesioner[$var])) $hasilkuesioner[$var] = [];
            $hasilkuesioner[$var][] = $item;
        }

        // Median
        $median = $this->kuesionerController->medianKuesioner();
        $medianAll = $this->kuesionerController->medianAll();
        // $median = $this->medianKuesioner();
        // $medianAll = $this->medianAll();

        $data_demografi = $this->kuesionerController->hasilDemografi();
        $demografi = $data_demografi['result'];
        $text = $data_demografi['text'];

        $chartDemografi = $this->kuesionerController->chartDemografi();

        $pdf = Pdf::view('pdf.analisis-kuesioner', [
            'kuesioner' => $hasilkuesioner,
            'median' => $median,
            'medianAll' => $medianAll,
            'text' => $text,
            'demografi' => $demografi,
            'chartDemografi' => $chartDemografi
        ])->format('a4');

        return $pdf->save('analisis-kuesioner.pdf');
    }


    public function generateBase64Chart(Request $request)
    {
        $chartImages = $request->all();
        $no = 1;
        foreach ($chartImages as $chartName => $imageData) {
            Log::info($imageData);
            $imageData = explode(',', $imageData)[1];  // Hapus bagian awal base64 (prefix)
            $image = base64_decode($imageData);

            if ($image === false) {
                return response()->json(['error' => 'Gagal mendekode base64'], 400);
            }

            // Simpan di storage/public/charts dengan nama unik
            $imagePath = storage_path('app/public/chart_images/' . 'chart' . $no . '.png');
            $no++;

            file_put_contents($imagePath, $image);
        }

        return response()->json(['success' => true]);
    }

    public function generatePDFRekap()
    {
        $data = DB::select(
            "SELECT users.name, users.username, responses.value_kuesioner, pernyataan_kuesioner.kode_indikator FROM responses
            LEFT JOIN kuesioner ON kuesioner.id = responses.kuesioner_id
            LEFT JOIN users ON users.id = kuesioner.user_id
            LEFT JOIN pernyataan_kuesioner ON pernyataan_kuesioner.id = responses.pernyataan_kuesioner_id;"
        );

        $result = [];

        foreach ($data as $key => $value) {
            // if (!isset($result[$value->name])) $result[$value->name] = [];
            $result[$value->username][] = $value;
        }

        $formatted_data = [];

        $keys = array_keys($result);
        foreach ($result as $name => $kuesioner) {
            $index = array_search($name, $keys);
            // Mengisi nama dan username
            $formatted_data[$index]['name'] = $kuesioner[0]->name;
            $formatted_data[$index]['username'] = (string)$name;

            foreach ($kuesioner as $item) {
                // Menetapkan kode_indikator sebagai key, value_kuesioner sebagai value
                $formatted_data[$index][$item->kode_indikator] = (int)$item->value_kuesioner;
            }
        }
        // print_r(json_encode($formatted_data));
        // die();

        $pdf = Pdf::view('pdf.analisis-rekap', [
            'result' => json_encode($formatted_data)
        ])->format('a4')->landscape();

        return $pdf->save('analisis-rekap.pdf');
    }
}
