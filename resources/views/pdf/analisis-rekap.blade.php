<!DOCTYPE html>
<html>

<head>
    <title>Hasil Analisis Kuesioner</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-4">
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
                    {{-- @foreach (json_decode($result, true) as $key => $res)
                        <th scope="col" class="px-6 py-3">
                            {{ json_encode($res) }}
                        </th>
                        @endforeach --}}
                    {{-- @foreach ($res as $key => $item)
                        @endforeach --}}

                    <th scope="col" class="px-3 py-1">
                        Nama
                    </th>
                    <th scope="col" class="px-3 py-1">
                        Username
                    </th>
                    <th scope="col" class="px-3 py-1">
                        OPT1
                    </th>
                    <th scope="col" class="px-3 py-1">
                        OPT2
                    </th>
                    <th scope="col" class="px-3 py-1">
                        OPT3
                    </th>
                    <th scope="col" class="px-3 py-1">
                        OPT4
                    </th>
                    <th scope="col" class="px-3 py-1">
                        OPT5
                    </th>
                    <th scope="col" class="px-3 py-1">
                        INV1
                    </th>
                    <th scope="col" class="px-3 py-1">
                        INV2
                    </th>
                    <th scope="col" class="px-3 py-1">
                        INV3
                    </th>
                    <th scope="col" class="px-3 py-1">
                        INV4
                    </th>
                    <th scope="col" class="px-3 py-1">
                        INV5
                    </th>
                    <th scope="col" class="px-3 py-1">
                        DCS1
                    </th>
                    <th scope="col" class="px-3 py-1">
                        DCS2
                    </th>
                    <th scope="col" class="px-3 py-1">
                        DCS3
                    </th>
                    <th scope="col" class="px-3 py-1">
                        DCS4
                    </th>
                    <th scope="col" class="px-3 py-1">
                        DCS5
                    </th>
                    <th scope="col" class="px-3 py-1">
                        INS1
                    </th>
                    <th scope="col" class="px-3 py-1">
                        INS2
                    </th>
                    <th scope="col" class="px-3 py-1">
                        INS3
                    </th>
                    <th scope="col" class="px-3 py-1">
                        INS4
                    </th>
                    <th scope="col" class="px-3 py-1">
                        INS5
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- @php
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
                @endforeach --}}
            </tbody>
        </table>
    </div>
</body>

</html>
