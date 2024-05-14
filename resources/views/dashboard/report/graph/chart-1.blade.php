<head>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
    <script src="{{ asset('dashboard_src/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
</head>

<body>
    <div id="chart">
    </div>
    <script>
        options = {
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    borderRadiusApplication: 'end',
                    horizontal: false
                }
            },
            series: [{
                label: 'Doanh số bán hàng',
                data: {!! json_encode($giatien) !!}
            }],
            xaxis: {
                categories: {!! json_encode($thang) !!},
            }
        };

        // var options = {
        //     series: [{
        //         data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
        //     }],
        //     chart: {
        //         type: 'bar',
        //         height: 350
        //     },
        //     plotOptions: {
        //         bar: {
        //             borderRadius: 4,
        //             borderRadiusApplication: 'end',
        //             horizontal: true,
        //         }
        //     },
        //     dataLabels: {
        //         enabled: false
        //     },
        //     xaxis: {
        //         categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan',
        //             'United States', 'Chi-na', 'Germany'
        //         ],
        //     }
        // };

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>


</body>
