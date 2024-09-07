<html>

<head>
    <title>Generate Charts</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- Tempat untuk menyimpan canvas chart -->
    <div style="display:none;">
        <canvas id="chart1"></canvas>
        <canvas id="chart2"></canvas>
        <canvas id="chart3"></canvas>
        <canvas id="chart4"></canvas>
        <canvas id="chart5"></canvas>
    </div>

    <!-- Form untuk mengirim gambar base64 ke server -->
    <form id="chartForm" action="{{ route('generatePDF') }}" method="POST">
        @csrf
        <input type="hidden" id="chartImageInput1" name="chartImage1">
        <input type="hidden" id="chartImageInput2" name="chartImage2">
        <input type="hidden" id="chartImageInput3" name="chartImage3">
        <input type="hidden" id="chartImageInput4" name="chartImage4">
        <input type="hidden" id="chartImageInput5" name="chartImage5">
    </form>

    <script>
        // Data chart dari Laravel
        const chartDemografi = @json($chartDemografi);

        // Function untuk membuat chart dan mengubahnya ke base64
        function createChart(ctx, type, data, options) {
            const chartInstance = new Chart(ctx, {
                type: type,
                data: data,
                options: options
            });
            return chartInstance.toBase64Image(); // Kembalikan gambar base64
        }

        // Function untuk menampilkan dan mengonversi chart ke base64
        function generateCharts() {
            const labels = chartDemografi.labels;
            const data = chartDemografi.data;

            // Chart pertama
            const ctx1 = document.getElementById('chart1').getContext('2d');
            const chartImage1 = createChart(ctx1, 'doughnut', {
                labels: data["Pengalaman menggunakan Artificial Intelligence (AI)"].map(item => item[0]),
                datasets: [{
                    data: data["Pengalaman menggunakan Artificial Intelligence (AI)"].map(item => item[1]),
                    backgroundColor: ['#36A2EB']
                }]
            }, {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: labels[0]
                    }
                }
            });
            document.getElementById('chartImageInput1').value = chartImage1;

            // Chart kedua
            const ctx2 = document.getElementById('chart2').getContext('2d');
            const chartImage2 = createChart(ctx2, 'doughnut', {
                labels: data["Lama Penggunaan Teknologi Kecerdasan Buatan"].map(item => item[0]),
                datasets: [{
                    data: data["Lama Penggunaan Teknologi Kecerdasan Buatan"].map(item => item[1]),
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                }]
            }, {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: labels[1]
                    }
                }
            });
            document.getElementById('chartImageInput2').value = chartImage2;

            // Chart ketiga
            const ctx3 = document.getElementById('chart3').getContext('2d');
            const chartImage3 = createChart(ctx3, 'doughnut', {
                labels: data["Intensitas Penggunaan Teknologi Kecerdasan Buatan"].map(item => item[0]),
                datasets: [{
                    data: data["Intensitas Penggunaan Teknologi Kecerdasan Buatan"].map(item => item[1]),
                    backgroundColor: ['#4BC0C0', '#FFCE56', '#E7E9ED', '#FF6384', '#36A2EB']
                }]
            }, {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: labels[2]
                    }
                }
            });
            document.getElementById('chartImageInput3').value = chartImage3;

            // Chart keempat
            const ctx4 = document.getElementById('chart4').getContext('2d');
            const chartImage4 = createChart(ctx4, 'doughnut', {
                labels: data["Kendala Penggunaan Teknologi Kecerdasan Buatan"].map(item => item[0]),
                datasets: [{
                    data: data["Kendala Penggunaan Teknologi Kecerdasan Buatan"].map(item => item[1]),
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#E7E9ED']
                }]
            }, {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: labels[3]
                    }
                }
            });
            document.getElementById('chartImageInput4').value = chartImage4;

            // Chart kelima
            const ctx5 = document.getElementById('chart5').getContext('2d');
            const chartImage5 = createChart(ctx5, 'doughnut', {
                labels: ["Teknologi AI yang sering digunakan"],
                datasets: [{
                    data: data["Teknologi AI yang sering digunakan"].map(item => item[1]),
                    backgroundColor: ['#36A2EB']
                }]
            }, {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: labels[4]
                    }
                }
            });
            document.getElementById('chartImageInput5').value = chartImage5;

            // Submit form setelah chart dikonversi ke base64
            document.getElementById('chartForm').submit();
        }

        // Eksekusi saat halaman selesai dimuat
        window.onload = generateCharts;
    </script>
</body>

</html>
