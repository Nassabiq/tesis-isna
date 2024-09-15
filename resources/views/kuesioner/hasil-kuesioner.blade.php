<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Hasil Kuesioner') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between ">
                        <p class="mb-2 text-2xl font-semibold text-gray-900">
                            Hasil Analisis Kuesioner
                        </p>
                        <div class="flex items-center gap-4 p-4">
                            <a href="{{ route('generate-pdf-analisis') }}" target="_blank"
                                class="text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Cetak Pdf Analisis
                            </a>
                            {{-- <a href="{{ route('generate-pdf-rekap') }}" target="_blank"
                                class="text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Cetak Pdf Rekap
                            </a> --}}
                        </div>
                    </div>
                    <hr class="py-2">

                    <p class="py-4 mb-2 text-sm font-semibold">
                        Rekapitulasi Hasil Perhitungan Indeks Masing-Masing Pernyataan
                    </p>

                    <div class="relative mb-5 overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-orange-200">
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
                                    <tr class="bg-orange-100">
                                        <th colspan="4" class="w-full py-2 text-lg text-center">{{ $key }}
                                        </th>
                                    </tr>
                                    @foreach ($item as $value)
                                        @php
                                            $nilai_indeks = round(
                                                ($value->value_kuesioner / $value->highest_value) * 100,
                                                2,
                                            );
                                        @endphp
                                        <tr>
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                {{ $no++ }}
                                            </th>
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                                                {{-- @dump($value) --}}
                                                {{ $value->isi_kuesioner }} -
                                                <span class="font-semibold">{{ $value->indikator }}</span>
                                            </th>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $nilai_indeks }} %
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
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
                            <thead class="text-xs text-gray-700 uppercase bg-orange-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Variabel
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
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ $nomed++ }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
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

                    <div class="flex flex-wrap items-center justify-between gap-4 space-y-4">
                        <canvas id="chart1" width="500" height="250"></canvas>
                        <canvas id="chart2" width="500" height="250"></canvas>
                        <canvas id="chart3" width="500" height="250"></canvas>
                        <canvas id="chart4" width="500" height="250"></canvas>
                        {{-- <canvas id="chart5" width="400" height="200"></canvas> --}}
                    </div>

                    <div style="display:none;">
                        <canvas id="chartimage1"></canvas>
                        <canvas id="chartimage2"></canvas>
                        <canvas id="chartimage3"></canvas>
                        <canvas id="chartimage4"></canvas>
                        <canvas id="chartimage5"></canvas>
                    </div>

                    <!-- Form untuk mengirim gambar base64 ke server -->
                    {{-- <form id="chartForm" action="{{ route('generate-base64-chart') }}" method="POST">
                        @csrf
                        <input type="hidden" id="chartImageInput1" name="chartImage1">
                        <input type="hidden" id="chartImageInput2" name="chartImage2">
                        <input type="hidden" id="chartImageInput3" name="chartImage3">
                        <input type="hidden" id="chartImageInput4" name="chartImage4">
                        <input type="hidden" id="chartImageInput5" name="chartImage5">
                    </form> --}}
                    <div class="p-4 mt-20 border-2 border-orange-400 rounded-lg">
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

                </div>


            </div>
        </div>

    </div>

    <script>
        const data = @json($chartDemografi);
        let chartImages = {};

        // Helper function to generate chart
        function createChart(ctx, chartType, chartData, chartOptions) {
            new Chart(ctx, {
                type: chartType,
                data: chartData,
                options: chartOptions
            });
        }

        // Function to generate random colors
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Function to generate colors for each value
        function generateColors(dataArray) {
            return dataArray.map(() => getRandomColor());
        }

        // Data preparation
        function prepareData(dataArray) {
            return {
                labels: dataArray.map(item => item[0]),
                datasets: [{
                    label: 'Data',
                    data: dataArray.map(item => item[1]),
                    backgroundColor: generateColors(dataArray), // Generate different colors
                    borderColor: generateColors(dataArray),
                    borderWidth: 1
                }]
            };
        }

        // Create all doughnut charts with titles
        const chartOptions = (title) => ({
            responsive: false,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: title,
                    font: {
                        size: 14
                    },
                    padding: {
                        top: 5,
                        bottom: 5
                    }
                }
            }
        });

        // Chart 1: Pengalaman menggunakan Artificial Intelligence (AI)
        createChart(
            document.getElementById('chart1').getContext('2d'),
            'doughnut',
            prepareData(data.data["Pengalaman menggunakan Artificial Intelligence (AI)"]),
            chartOptions('Pengalaman menggunakan Artificial Intelligence (AI)')
        );

        // Chart 2: Lama Penggunaan Teknologi Kecerdasan Buatan
        createChart(
            document.getElementById('chart2').getContext('2d'),
            'doughnut',
            prepareData(data.data["Lama Penggunaan Teknologi Kecerdasan Buatan"]),
            chartOptions('Lama Penggunaan Teknologi Kecerdasan Buatan')
        );

        // Chart 3: Intensitas Penggunaan Teknologi Kecerdasan Buatan
        createChart(
            document.getElementById('chart3').getContext('2d'),
            'doughnut',
            prepareData(data.data["Intensitas Penggunaan Teknologi Kecerdasan Buatan"]),
            chartOptions('Intensitas Penggunaan Teknologi Kecerdasan Buatan')
        );

        // Chart 4: Kendala Penggunaan Teknologi Kecerdasan Buatan
        createChart(
            document.getElementById('chart4').getContext('2d'),
            'doughnut',
            prepareData(data.data["Kendala Penggunaan Teknologi Kecerdasan Buatan"]),
            chartOptions('Kendala Penggunaan Teknologi Kecerdasan Buatan')
        );


        // Helper function to generate chart and return base64 image
        async function createChartImage(ctx, chartType, chartData, chartOptions) {
            const chart = new Chart(ctx, {
                type: chartType,
                data: chartData,
                options: chartOptions
            });

            // Return base64 image string
            // return await chart.toBase64Image();
            return new Promise((resolve) => {
                chart.options.animation.onComplete = function() {
                    const chartImage = chart.toBase64Image();
                    resolve(chartImage); // Return the base64 image when chart rendering is complete
                };
            });
        }

        function sendChartsToServer(chartImages) {
            fetch('/generate-base64-chart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content') // Laravel CSRF token
                    },
                    body: JSON.stringify(chartImages) // Send chart images as JSON
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('All chart images saved successfully!');
                    } else {
                        console.error('Error saving chart images.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Async function to prepare and create all charts, then send to the server
        async function generateAndSendCharts() {
            const chartImages = {};

            // Generate chart images asynchronously and store them in chartImages object
            chartImages['PengalamanAI'] = await createChartImage(
                document.getElementById('chartimage1').getContext('2d'),
                'doughnut',
                prepareData(data.data["Pengalaman menggunakan Artificial Intelligence (AI)"]),
                chartOptions('Pengalaman menggunakan Artificial Intelligence (AI)')
            );

            chartImages['LamaPenggunaanAI'] = await createChartImage(
                document.getElementById('chartimage2').getContext('2d'),
                'doughnut',
                prepareData(data.data["Lama Penggunaan Teknologi Kecerdasan Buatan"]),
                chartOptions('Lama Penggunaan Teknologi Kecerdasan Buatan')
            );

            chartImages['IntensitasPenggunaanAI'] = await createChartImage(
                document.getElementById('chartimage3').getContext('2d'),
                'doughnut',
                prepareData(data.data["Intensitas Penggunaan Teknologi Kecerdasan Buatan"]),
                chartOptions('Intensitas Penggunaan Teknologi Kecerdasan Buatan')
            );

            chartImages['KendalaPenggunaanAI'] = await createChartImage(
                document.getElementById('chartimage4').getContext('2d'),
                'doughnut',
                prepareData(data.data["Kendala Penggunaan Teknologi Kecerdasan Buatan"]),
                chartOptions('Kendala Penggunaan Teknologi Kecerdasan Buatan')
            );

            // Send all charts as base64 images to the server
            console.log(chartImages);
            sendChartsToServer(chartImages);
        }

        // Call the async function to generate and send charts
        generateAndSendCharts();

        // window.onload = generateChartImages(data);


        // Chart 5: Teknologi AI yang sering digunakan
        // createChart(document.getElementById('chart5').getContext('2d'), 'radar', prepareData(data.data[
        //     "Teknologi AI yang sering digunakan"]), {
        //     responsive: true
        // });
    </script>
</x-app-layout>
