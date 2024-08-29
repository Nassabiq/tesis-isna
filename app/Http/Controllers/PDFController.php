<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelPdf\Facades\Pdf;

class PDFController extends Controller
{
    //
    public function generatePDFAnalisis()
    {
        $kuesioner = DB::select("SELECT 
                pernyataan_kuesioner.isi_kuesioner, 
                pernyataan_kuesioner.indikator, 
                pernyataan_kuesioner.kode_indikator, 
                variable_kuesioner.variable_nama,
                SUM(responses.value_kuesioner) as value_kuesioner,
                COUNT(responses.value_kuesioner) * 5 as highest_value
            FROM responses 
            JOIN pernyataan_kuesioner on pernyataan_kuesioner.id = responses.pernyataan_kuesioner_id
            JOIN variable_kuesioner on variable_kuesioner.id = pernyataan_kuesioner.variable_id
            GROUP BY responses.pernyataan_kuesioner_id;");

        $hasilkuesioner = [];

        foreach ($kuesioner as $item) {
            $var = $item->variable_nama;
            if (!isset($hasilkuesioner[$var])) $hasilkuesioner[$var] = [];
            $hasilkuesioner[$var][] = $item;
        }

        $median = $this->medianKuesioner();

        $pdf = Pdf::view('pdf.analisis-kuesioner', [
            'kuesioner' => $hasilkuesioner,
            'median' => $median,
        ])->format('a4');

        return $pdf->save('analisis-kuesioner.pdf');
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

    public function generatePDFResult() {}

    public function hasilKuesioner()
    {
        $kuesioner = DB::select("SELECT 
                pernyataan_kuesioner.isi_kuesioner, 
                pernyataan_kuesioner.indikator, 
                pernyataan_kuesioner.kode_indikator, 
                variable_kuesioner.variable_nama,
                SUM(responses.value_kuesioner) as value_kuesioner,
                COUNT(responses.value_kuesioner) * 5 as highest_value
            FROM responses 
            JOIN pernyataan_kuesioner on pernyataan_kuesioner.id = responses.pernyataan_kuesioner_id
            JOIN variable_kuesioner on variable_kuesioner.id = pernyataan_kuesioner.variable_id
            GROUP BY responses.pernyataan_kuesioner_id;");

        return $kuesioner;
    }

    public function medianKuesioner()
    {
        $data = $this->hasilKuesioner();
        $kuesioner = [];

        foreach ($data as $item) {
            $var = $item->variable_nama;
            if (!isset($kuesioner[$var])) $kuesioner[$var] = [];
            $kuesioner[$var][] = $item;
        }

        $res = $this->calculateMediansForData($kuesioner);
        return $res;
    }

    // Function to process data and calculate medians
    public function calculateMediansForData($data)
    {
        $medians = [];
        foreach ($data as $category => $items) {
            $values = [];

            foreach ($items as $item) {
                $values[] = $item->value_kuesioner / $item->highest_value * 100;
            }

            $medians[$category] = $this->calculateMedian($values);
        }

        return $medians;
    }


    // Function to calculate median
    public function calculateMedian($array)
    {
        // Sort the array
        sort($array);
        $count = count($array);
        $middle = floor($count / 2);

        if ($count % 2) {
            // If odd, return the middle element
            return $array[$middle];
        } else {
            // If even, return the average of the two middle elements
            return ($array[$middle - 1] + $array[$middle]) / 2;
        }
    }
}
