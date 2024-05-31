<head>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
    <script src="{{ asset('dashboard_src/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
</head>

<body>
    <div id="chart">
    </div>
    <script>
        var options = {
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
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toLocaleString() + ' đ'; // Định dạng số cho trục Y
                    }
                }
            },
            series: [{
                name: 'Doanh số bán hàng',
                data: {!! json_encode($giatien) !!}
            }],
            xaxis: {
                categories: {!! json_encode($thang) !!}
            },
            tooltip: {
                intersect: true,
                y: {
                    formatter: function(value) {
                        return value.toLocaleString(); // Định dạng số trong tooltip
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>


</body>
