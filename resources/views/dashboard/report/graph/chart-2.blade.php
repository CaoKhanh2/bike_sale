<head>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
    <script src="{{ asset('dashboard_src/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
</head>

<body>
    <div id="chart"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var nam = <?php echo json_encode($nam); ?>;
            var quy = <?php echo json_encode($quy); ?>;
            var tongxe = <?php echo json_encode($tongxe); ?>;

            var uniqueNam = nam.filter(function(value, index, self) {
                return self.indexOf(value) === index;
            });

            var options = {
                chart: {
                    height: 350,
                    type: 'bar',
                    stacked: false
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560'], // Chọn màu cho từng cột
                series: [{
                        name: 'Quý 1',
                        data: tongxe.filter((value, index) => quy[index] === 1)
                    },
                    {
                        name: 'Quý 2',
                        data: tongxe.filter((value, index) => quy[index] === 2)
                    },
                    {
                        name: 'Quý 3',
                        data: tongxe.filter((value, index) => quy[index] === 3)
                    },
                    {
                        name: 'Quý 4',
                        data: tongxe.filter((value, index) => quy[index] === 4)
                    }
                ],
                plotOptions: {
                    bar: {
                        columnWidth: '50%',
                        endingShape: 'flat'
                    }
                },
                xaxis: {
                    categories: uniqueNam, // Sử dụng mảng năm không trùng lặp để hiển thị trên trục x
                    title: {
                        text: 'Năm và Quý'
                    },
                    forceNiceScale: true
                },
                yaxis: {
                    title: {
                        text: 'Số lượng xe'
                    },
                    
                    labels: {
                        formatter: function(val) {
                            return Math.floor(val); // Làm tròn
                        }
                    }
                },
                tooltip: {
                    shared: false,
                    intersect: true,
                    x: {
                        show: true
                    }
                },
                legend: {
                    horizontalAlign: 'left',
                    offsetX: 40
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script>

</body>
