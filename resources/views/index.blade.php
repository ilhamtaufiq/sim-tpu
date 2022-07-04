@extends('layouts.master')

@section('title')
    Dashboard
@endsection
@section('css')
    <!-- tui charts Css -->
    <style>
        /* Style the buttons */
        .btns {
            border: none;
            outline: none;
            padding: 10px 16px;
            background-color: #f1f1f1;
            cursor: pointer;
            font-size: 18px;
        }

        /* Style the active class, and buttons on mouse-over */
        .active,
        .btns:hover {
            /* background-color: #1a73e8; */
            color: white;
        }
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboards
        @endslot
        @slot('title')
            SIM-TPU
        @endslot
    @endcomponent
    @role('user')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <img src="assets/images/pemda.png" alt=""
                                        class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div class="flex-grow-1 align-self-center">
                                    <div class="text-muted">
                                        <p class="mb-2">SIM TPU</p>
                                        <h5 class="mb-1">Disperkim Kab. Cianjur</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-condensed">
                        <thead class="thead-light">
                            <th scope="col">Nomor Pembayaran</th>
                            <th>Ahli Waris</th>
                            <th scope="col">Nominal</th>
                            <th scope="col">Status Pembayaran</th>
                            <th scope="col">Tahun Herregistrasi</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>#{{ $order->number }}</td>
                                    @foreach ($order->registrasi as $item)
                                    <th>{{$item->ahliwaris->nama}}</th>
                                    @endforeach
                                    <td>{{ number_format($order->total_price, 2, ',', '.') }}</td>
                                    <td>
                                        @if ($order->payment_status == 1)
                                            Menunggu Pembayaran / Belum Jatuh Tempo
                                        @elseif ($order->payment_status == 2)
                                            Sudah Dibayar
                                        @else
                                            Kadaluarsa
                                        @endif
                                    </td>
                                    @foreach ($order->registrasi as $item)
                                    <th>{{$tahun = \Carbon\Carbon::parse($item->tanggal_meninggal)->addYear(2)->format('Y')}}</th>
                                    @endforeach
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-success">
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endrole
    <!-- end row -->
    @role('admin')
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                        <i class="bx bx-copy-alt"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-14 mb-0">Registrasi</h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>Rp{{ number_format($tahun, 2, ',', '.') }} <i
                                        class="mdi {{ $persentase > 0 ? 'mdi-chevron-up ms-1 text-success' : 'mdi-chevron-down ms-1 text-danger' }}"></i>
                                </h4>
                                <div class="d-flex">
                                    <span
                                        class="badge {{ $persentase > 0 ? 'badge-soft-success' : 'badge-soft-danger' }} font-size-12">{{ $persentase > 0 ? '+' : '' }}{{ number_format($persentase) }}%
                                    </span> <span class="ms-2 text-truncate">Dari tahun sebelumnya</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                        <i class="bx bx-archive-in"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-14 mb-0">Herregistrasi</h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>Rp <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                <div class="d-flex">
                                    <span class="badge badge-soft-success font-size-12"> + 0.2% </span> <span
                                        class="ms-2 text-truncate">Dari tahun sebelumnya</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                        <i class="bx bx-purchase-tag-alt"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-14 mb-0">Target</h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>Rp <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>

                                <div class="d-flex">
                                    <span class="badge badge-soft-warning font-size-12"> 0% </span> <span
                                        class="ms-2 text-truncate">Dari tahun sebelumnya</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix">
                        <h4 class="card-title mb-4">Pendapatan</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id=myDIV>
                                <button class="btns btn active" onclick="changeData(0)">2022</button>
                                <button class="btns btn" onclick="changeData(1)">2021</button>
                                <button class="btns btn" onclick="changeData(2)">2020</button>
                                <canvas id="chart-0"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
    <!-- end row -->
    <!-- end row -->
    {{-- var sites = @json($bulan->toArray()); --}}
@endsection
@section('script')
    <!-- Saas dashboard init -->
    @role('admin')
    <script src="https://www.chartjs.org/dist/2.6.0/Chart.bundle.js"></script>
    <script src="https://www.chartjs.org/samples/2.6.0/utils.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>

    <script>
        var dataObjects = [{
                label: "2022",
                data: @json($bulan)
            },
            {
                label: "2021",
                data: [3, 5, 7]
            },
            {
                label: "2020",
                data: [11, 8, 12]
            }
        ]
        /* data */
        var data = {
            labels: @json($label_bulan),
            datasets: [{
                label: dataObjects[0].label,
                data: dataObjects[0].data,
                /* global setting */
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        };

        var options = {
            legend: {
                display: true,
                fillStyle: "red",

                labels: {
                    boxWidth: 0,
                    fontSize: 24,
                    fontColor: "black",
                }
            },
            scales: {
                xAxes: [{
                    stacked: false,
                    scaleLabel: {
                        display: true,
                        labelString: 'Bulan'
                    },
                }],
                yAxes: [{
                    stacked: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Juta'
                    },
                    ticks: {
                        // Shorthand the millions
                        callback: function(value, index, values) {
                            return value / 1e6 + ' Jt';
                        }
                    }
                }]
            },
            /*end scales */
            plugins: {
                datalabels: {
                    formatter: Math.round,
                    color: 'black',
                    font: {
                        size: 10
                    }
                }
            }
        };

        var chart = new Chart('chart-0', {
            plugins: [ChartDataLabels],
            /*https://chartjs-plugin-datalabels.netlify.com*/
            type: 'bar',
            data: data,
            options: options
        });

        function changeData(index) {
            chart.data.datasets.forEach(function(dataset) {
                dataset.label = dataObjects[index].label;
                dataset.data = dataObjects[index].data;
                //dataset.backgroundColor = dataObjects[index].backgroundColor;
            });
            chart.update();
        }

        /* add active class on click */
        // Add active class to the current button (highlight it)
        var header = document.getElementById("myDIV");
        var btns = header.getElementsByClassName("btns");
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            });
        }
    </script>
    @endrole
    {{-- <script>
        function tahun(tahun) { 
        
        var jsonData = $.ajax({
            url: '/registrasi/chart?tahun='+tahun,
            dataType: 'json',
        }).done(function(results) {
            var labels = [];
            var values = [];
            results.forEach(function(el, key) {
                labels.push(el.bulan);
                values.push(el.total);
            })
            console.log(results);
            const el = document.getElementById('chart1');
            const data = {
                categories: labels,
                series: [{
                    name: 'Budget',
                    data: values,
                }, ],
            };
            const options = {
                chart: {
                    title: 'Monthly Revenue',
                    width: 900,
                    height: 400
                },
            };

            const chart = toastui.Chart.columnChart({
                el,
                data,
                options
            });

        })
        }
    </script> --}}
    <script></script>
@endsection
