
// Persiapkan Data untuk Grafik Batang
var barChartData = {
    labels: guruData.map(function(guru) { return guru.guru; }),
    datasets: [{
        label: 'Rata-rata Nilai',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1,
        data: guruData.map(function(guru) { return guru.average; }),
    }]
};

// Inisialisasi Grafik Batang
var ctx = document.getElementById('barChart').getContext('2d');
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: barChartData,
    options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 100,
                ticks: {
                    stepSize: 10
                }
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top',
            }
        }
    }
});
