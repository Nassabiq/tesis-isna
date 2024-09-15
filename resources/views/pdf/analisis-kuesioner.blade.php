<!DOCTYPE html>
<html>

<head>
    <title>Hasil Analisis Kuesioner</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="flex justify-between">
        <p class="pl-4 text-xs">{{ now() }}</p>
        <p class="pr-4 text-xs">Aplikasi Analisis Kesiapan Teknologi Artificial Intelligence</p>
    </div>

    <div class="flex flex-col items-center justify-center px-12 mt-8">
        <img src="data:image/png; base64, {{ base64_encode(file_get_contents(public_path('storage/logo-univ.png'))) }}"
            class="w-48 h-32 text-center">
        {{-- <img class="block w-auto h-16 text-gray-800 fill-current" src="{{ asset('storage/logo-univ.png') }}"
            alt="logo"> --}}
        <p class="text-3xl font-semibold text-center">
            Laporan Hasil Analisis Kesiapan Adopsi Teknologi Artificial Intelligence Mahasiswa Komputer
        </p>
        <p class="text-2xl font-semibold text-center">
            Universitas Putra Indonesia "YPTK" Padang
        </p>
        <p class="text-xl text-center">
            Tahun 2024
        </p>
    </div>
    <div class="p-4">
        <div class="flex items-center justify-between">
            <p class="mb-2 text-2xl font-semibold text-gray-900">
                Hasil Analisis Kuesioner
            </p>
        </div>
        <hr class="py-2">

        <p class="py-2 mb-2 text-sm font-semibold">
            Rekapitulasi Hasil Perhitungan Indeks Masing-Masing Pernyataan
        </p>

        <div class="relative mb-5 overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pernyataan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nilai Indeks
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Keandalan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($kuesioner as $key => $item)
                        <tr>
                            <th colspan="4" class="w-full py-2 text-lg text-center">{{ $key }}
                            </th>
                        </tr>
                        @foreach ($item as $value)
                            @php
                                $nilai_indeks = round(($value->value_kuesioner / $value->highest_value) * 100, 3);
                            @endphp
                            <tr>
                                <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ $no++ }}
                                </th>
                                <th scope="row" class="px-6 py-2 font-medium text-gray-900">
                                    {{-- @dump($value) --}}
                                    {{ $value->isi_kuesioner }} -
                                    <span class="font-semibold">{{ $value->indikator }}</span>
                                </th>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    {{ $nilai_indeks }} %
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    @switch($nilai_indeks)
                                        @case($nilai_indeks >= 0 && $nilai_indeks < 20)
                                            Sangat Tidak Siap
                                        @break

                                        @case($nilai_indeks >= 20 && $nilai_indeks < 40)
                                            Tidak Siap
                                        @break

                                        @case($nilai_indeks >= 40 && $nilai_indeks < 60)
                                            Netral
                                        @break

                                        @case($nilai_indeks >= 60 && $nilai_indeks < 80)
                                            Siap
                                        @break

                                        @case($nilai_indeks >= 80 && $nilai_indeks < 100)
                                            Sangat Siap
                                        @break

                                        @default
                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <p class="py-4 mb-2 text-sm font-semibold">
            Hasil Median Indeks Masing-Masing Variabel
        </p>
        <div class="relative mb-5 overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Variable
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Median Indeks (%)
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Hasil
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomed = 1;
                    @endphp
                    @foreach ($median as $key => $item)
                        <tr>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $nomed++ }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $key }}
                            </th>
                            <td class="px-6 py-4">
                                {{ round($item, 2) }} %
                            </td>
                            <td class="px-6 py-4">
                                @switch(round($item, 2))
                                    @case(round($item, 2) >= 0 && round($item, 2) < 20)
                                        Sangat Tidak Siap
                                    @break

                                    @case(round($item, 2) >= 20 && round($item, 2) < 40)
                                        Tidak Siap
                                    @break

                                    @case(round($item, 2) >= 40 && round($item, 2) < 60)
                                        Netral
                                    @break

                                    @case(round($item, 2) >= 60 && round($item, 2) < 80)
                                        Siap
                                    @break

                                    @case(round($item, 2) >= 80 && round($item, 2) < 100)
                                        Sangat Siap
                                    @break

                                    @default
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @pageBreak
        <div class="flex items-center justify-between">
            <p class="mb-2 text-2xl font-semibold text-gray-900">
                Hasil Analisis Demografi
            </p>
        </div>
        <hr class="py-2">

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-900 ">
                <thead class="text-xs text-gray-700 uppercase bg-orange-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Karakteristik
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Item
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jumlah
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Persentase
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nodemog = 1;
                    @endphp
                    @foreach ($demografi as $key => $items)
                        @foreach ($items as $item)
                            <tr>
                                <td class="px-6 py-4">{{ $nodemog++ }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->question }}</td>
                                <td class="px-6 py-4">{{ $item->value_answer }}</td>
                                <td class="px-6 py-4">{{ $item->jumlah }}</td>
                                <td class="px-6 py-4">
                                    @if ($item->form_type !== 'text')
                                        {{ round(($item->jumlah / intval($item->total)) * 100, 2) }} %
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        @pageBreak
        <div class="flex items-center justify-between">
            <p class="mb-2 text-2xl font-semibold text-gray-900">
                Chart Hasil Analisis Demografi
            </p>
        </div>
        <hr class="py-2">

        <div class="grid grid-cols-2 gap-4 space-y-4">
            {{-- <canvas id="chart1" width="400" height="400"></canvas> --}}
            <img src="data:image/png; base64, {{ base64_encode(file_get_contents(public_path('storage/chart_images/chart1.png'))) }}"
                width="500" height="250">
            <img src="data:image/png; base64, {{ base64_encode(file_get_contents(public_path('storage/chart_images/chart2.png'))) }}"
                width="500" height="250">
            <img src="data:image/png; base64, {{ base64_encode(file_get_contents(public_path('storage/chart_images/chart3.png'))) }}"
                width="500" height="250">
            <img src="data:image/png; base64, {{ base64_encode(file_get_contents(public_path('storage/chart_images/chart4.png'))) }}"
                width="500" height="250">
            {{-- <img id="chartImage1" alt="Chart Image" /> --}}
            {{-- <canvas id="chart2" width="500" height="250"></canvas>
            <canvas id="chart3" width="500" height="250"></canvas>
            <canvas id="chart4" width="500" height="250"></canvas>
            <canvas id="chart5" width="400" height="200"></canvas> --}}
        </div>

        @pageBreak
        <div class="p-4 mt-8 border-2 border-orange-400 rounded-lg">
            <p class="px-4 mb-2 text-2xl font-bold text-gray-900">
                Kesimpulan
            </p>
            <p class="px-4 py-2">
                Berdasarkan hasil analisis kesiapan adopsi teknologi kecerdasan buatan, menunjukkan bahwa
                Mahasiswa Komputer Universitas Putra Indonesia "YPTK" Padang
                <span class="font-bold">
                    @switch(round($medianAll, 2))
                        @case(round($medianAll, 2) >= 0 && round($medianAll, 2) < 20)
                            Sangat Tidak Siap
                        @break

                        @case(round($medianAll, 2) >= 20 && round($medianAll, 2) < 40)
                            Tidak Siap
                        @break

                        @case(round($medianAll, 2) >= 40 && round($medianAll, 2) < 60)
                            Netral
                        @break

                        @case(round($medianAll, 2) >= 60 && round($medianAll, 2) < 80)
                            Siap
                        @break

                        @case(round($medianAll, 2) >= 80 && round($medianAll, 2) < 100)
                            Sangat Siap
                        @break

                        @default
                    @endswitch
                </span> dengan Hasil Indeks:
                <span class="font-semibold">
                    {{ round($medianAll, 2) }}%
                </span>
                untuk
                mengadopsi teknologi
                kecerdasan buatan.
            </p>
            <p class="px-4">
                Tools AI yang sering digunakan oleh Mahasiswa yaitu :
                <span class="font-semibold">{{ $text }}</span>
            </p>
        </div>
        <div class="grid grid-cols-2">
            <div class="col-span-1"></div>
            <div class="col-span-1 p-8 text-center">
                <p class="text-sm">Padang, 31 Agustus 2024</p>
                <p class="mb-32 text-sm">Ka. Program Studi Teknik Informatika (S2)</p>
                <p class="text-sm font-semibold">Dr. Ir. Gunadi Widi Nurcahyo, S.Kom, M.Kom</p>
            </div>
        </div>
    </div>
    <script></script>
</body>

</html>
