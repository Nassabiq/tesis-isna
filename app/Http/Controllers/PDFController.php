<?php

namespace App\Http\Controllers;

use App\Models\Kuesioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $chartImage1 = $request->input('chartImage1');
        $chartImage2 = $request->input('chartImage2');
        $chartImage3 = $request->input('chartImage3');
        $chartImage4 = $request->input('chartImage4');
        $chartImage5 = $request->input('chartImage5');

        // Dekode gambar base64 dan simpan
        $imagePath1 = $this->saveBase64Image($chartImage1, 'chart1.png');
        $imagePath2 = $this->saveBase64Image($chartImage2, 'chart2.png');
        $imagePath3 = $this->saveBase64Image($chartImage3, 'chart3.png');
        $imagePath4 = $this->saveBase64Image($chartImage4, 'chart4.png');
        $imagePath5 = $this->saveBase64Image($chartImage5, 'chart5.png');

        $imagePaths = [
            $imagePath1,
            $imagePath2,
            $imagePath3,
            $imagePath4,
            $imagePath5,
        ];

        return $imagePaths;
        // return view('generate-base64-chart', ['chartImagePaths' => $imagePaths]);
    }

    private function saveBase64Image($base64Image, $fileName)
    {
        $image = str_replace('data:image/png;base64,', '', $base64Image);
        $image = str_replace(' ', '+', $image);
        $filePath = 'public/chart_images/' . $fileName;
        Storage::put($filePath, base64_decode($image));
        return Storage::url($filePath);
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
