@extends('layout.main')

@section('dashboard', 'nav-item active')

@section('content')

<style>
    .tombol {
        font-family: sans-serif;
        font-size: 14px;
        background: #22a4cf;
        color: white;
        border: white 1px solid;
        border-radius: 4px;
        padding: 3px 6px;
    }

    button:hover,
    input[type=submit]:hover {
        opacity: 0.9;
    }

</style>

@if (auth()->user()->username == 'superviser')
<form action="" method="GET">
    @csrf
    <div class="row mb-3">
        <div class="col-md-4 pl-0 pr-2">
            <select data-placeholder="Filter Wilker..." class="standardSelect" name="nama_wilker" tabindex="1">
                @if (request('nama_wilker'))
                <option value="{{ request('nama_wilker') }}" label="default">{{ request('nama_wilker') }}</option>
                @else
                <option value="Semua Wilker" label="default">Semua Wilker</option>
                @endif
                <option value="Semua Wilker" label="default">Semua Wilker</option>
                @foreach ($nama_wilker as $item)
                <option value="{{ $item->lokasi }}">{{ $item->lokasi }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 pl-0 pr-2">
            <select data-placeholder="Filter Tahun..." class="standardSelect" name="tahun" tabindex="1">
                @if (request('tahun'))
                <option value="{{ request('tahun') }}" label="default">Tahun {{ request('tahun') }}</option>
                @else
                <option value="{{ $thn_skr = date('Y'); }}" label="default">Tahun {{ $thn_skr = date('Y'); }}</option>
                @endif
                {{ $thn_skr = date('Y'); }}
                @for ($x = $thn_skr; $x >= 2000; $x--) {
                <option value="{{ $x }}">Tahun {{ $x }}</option>
                }
                @endfor
            </select>
        </div>
        <div class="col-md-1 pl-0">
            <button type="submit" class="btn btn-sm btn-info text-center tombol"><i class="fa fa-filter"></i>
                Filter</button>
        </div>
    </div>
</form>
@else
<form action="" method="GET">
    @csrf
    <div class="row mb-3">
        <div class="col-md-2 pl-0 pr-2">
            <select data-placeholder="Filter Tahun..." class="standardSelect" name="tahun" tabindex="1">
                @if (request('tahun'))
                <option value="{{ request('tahun') }}" label="default">Tahun {{ request('tahun') }}</option>
                @else
                <option value="{{ $thn_skr = date('Y'); }}" label="default">Tahun {{ $thn_skr = date('Y'); }}</option>
                @endif
                {{ $thn_skr = date('Y'); }}
                @for ($x = $thn_skr; $x >= 2000; $x--) {
                <option value="{{ $x }}">Tahun {{ $x }}</option>
                }
                @endfor
            </select>
        </div>
        <div class="col-md-1 pl-0">
            <button type="submit" class="btn btn-sm btn-info text-center tombol"><i class="fa fa-filter"></i>
                Filter</button>
        </div>
    </div>
</form>
@endif

{{-- Domas & Dokel --}}
<div class="row">
    {{-- Domas --}}
    <div class="col-lg pl-0">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Domestik Masuk</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <p align="center"><b>Frekuensi</b></p>
                        <canvas id="frekuensiChart"></canvas>
                    </div>
                    <div class="col-lg-4">
                        <p align="center"><b>Komoditas</b></p>
                        <canvas id="ragamChart"></canvas>
                    </div>
                    <div class="col-lg-4 p-0">
                        <p align="center"><b>Total PNBP</b></p>
                        <canvas id="pnbpChart"></canvas>
                    </div>
                    <div class="col-lg-12">
                        <hr>
                        <p align="center"><b>Kegiatan Lalu Lintas</b></p>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /# column -->

    {{-- Dokel --}}
    <div class="col-lg p-0">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Domestik Keluar</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <p align="center"><b>Frekuensi</b></p>
                        <canvas id="frekuensiChartDokel"></canvas>
                    </div>
                    <div class="col-lg-4">
                        <p align="center"><b>Komoditas</b></p>
                        <canvas id="ragamChartDokel"></canvas>
                    </div>
                    <div class="col-lg-4 p-0">
                        <p align="center"><b>Total PNBP</b></p>
                        <canvas id="pnbpChartDokel"></canvas>
                    </div>
                    <div class="col-lg-12">
                        <hr>
                        <p align="center"><b>Kegiatan Lalu Lintas</b></p>
                        <canvas id="lineChartDokel"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Impor & Ekspor --}}
<div class="row">
    {{-- Impor --}}
    <div class="col-lg pl-0">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Impor</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <p align="center"><b>Frekuensi</b></p>
                        <canvas id="frekuensiChartImpor"></canvas>
                    </div>
                    <div class="col-lg-4">
                        <p align="center"><b>Komoditas</b></p>
                        <canvas id="ragamChartImpor"></canvas>
                    </div>
                    <div class="col-lg-4 p-0">
                        <p align="center"><b>Total PNBP</b></p>
                        <canvas id="pnbpChartImpor"></canvas>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <hr>
                        <p align="center"><b>Kegiatan Lalu Lintas</b></p>
                        <canvas id="lineChartImpor"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Ekspor --}}
    <div class="col-lg p-0">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Ekspor</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <p align="center"><b>Frekuensi</b></p>
                        <canvas id="frekuensiChartEkspor"></canvas>
                    </div>
                    <div class="col-lg-4">
                        <p align="center"><b>Komoditas</b></p>
                        <canvas id="ragamChartEkspor"></canvas>
                    </div>
                    <div class="col-lg-4 p-0">
                        <p align="center"><b>Total PNBP</b></p>
                        <canvas id="pnbpChartEkspor"></canvas>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <hr>
                        <p align="center"><b>Kegiatan Lalu Lintas</b></p>
                        <canvas id="lineChartEkspor"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>

@endsection

@section('chart')

<script>
    // Domas
    // line Chart
    var ctx = document.getElementById("lineChart");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Agu", "Sep", "Okt",
                "Nov", "Des"
            ],
            datasets: [{
                    label: "Hewan",
                    borderColor: "rgba(0,0,0,.09)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0,0,0,.07)",
                    data: JSON.parse('{!! json_encode($data_domas_hewan) !!}')
                },
                {
                    label: "Tumbuhan",
                    borderColor: "rgba(0, 194, 146, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0, 194, 146, 0.5)",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: JSON.parse('{!! json_encode($data_domas_tumbuhan) !!}')
                }
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }

        }
    });

    //frekuensi chart
    var ctx = document.getElementById("frekuensiChart");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: ['{{ $f_hewan_domas }}', '{{ $f_tumbuhan_domas  }}'],
                backgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ],
                hoverBackgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ]

            }],
            labels: [
                "Hewan",
                "Tumbuhan",
            ]
        },
        options: {
            responsive: true
        }
    });

    //ragam chart
    var ctx = document.getElementById("ragamChart");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: ['{{ $r_hewan_domas }}', '{{ $r_tumbuhan_domas  }}'],
                backgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ],
                hoverBackgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ]

            }],
            labels: [
                "Hewan",
                "Tumbuhan",
            ]
        },
        options: {
            responsive: true
        }
    });

    //ragam chart
    var ctx = document.getElementById("pnbpChart");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: ['{{ $pnbp_hewan_domas }}', '{{ $pnbp_tumbuhan_domas  }}'],
                backgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ],
                hoverBackgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ]

            }],
            labels: [
                "Hewan",
                "Tumbuhan",
            ]
        },
        options: {
            responsive: true
        }
    });

    // dokel
    // line Chart
    var ctx = document.getElementById("lineChartDokel");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Agu", "Sep", "Okt",
                "Nov", "Des"
            ],
            datasets: [{
                    label: "Hewan",
                    borderColor: "rgba(0,0,0,.09)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0,0,0,.07)",
                    data: JSON.parse('{!! json_encode($data_dokel_hewan) !!}')
                },
                {
                    label: "Tumbuhan",
                    borderColor: "rgba(0, 194, 146, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0, 194, 146, 0.5)",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: JSON.parse('{!! json_encode($data_dokel_tumbuhan) !!}')
                }
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }

        }
    });

    //frekuensi chart
    var ctx = document.getElementById("frekuensiChartDokel");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: ['{{ $f_hewan_dokel }}', '{{ $f_tumbuhan_dokel  }}'],
                backgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ],
                hoverBackgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ]

            }],
            labels: [
                "Hewan",
                "Tumbuhan",
            ]
        },
        options: {
            responsive: true
        }
    });

    //ragam chart
    var ctx = document.getElementById("ragamChartDokel");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: ['{{ $r_hewan_dokel }}', '{{ $r_tumbuhan_dokel  }}'],
                backgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ],
                hoverBackgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ]

            }],
            labels: [
                "Hewan",
                "Tumbuhan",
            ]
        },
        options: {
            responsive: true
        }
    });

    //ragam chart
    var ctx = document.getElementById("pnbpChartDokel");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: ['{{ $pnbp_hewan_dokel }}', '{{ $pnbp_tumbuhan_dokel  }}'],
                backgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ],
                hoverBackgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ]

            }],
            labels: [
                "Hewan",
                "Tumbuhan",
            ]
        },
        options: {
            responsive: true
        }
    });

    // Impor
    // line Chart
    var ctx = document.getElementById("lineChartImpor");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Agu", "Sep", "Okt",
                "Nov", "Des"
            ],
            datasets: [{
                    label: "Hewan",
                    borderColor: "rgba(0,0,0,.09)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0,0,0,.07)",
                    data: JSON.parse('{!! json_encode($data_impor_hewan) !!}')
                },
                {
                    label: "Tumbuhan",
                    borderColor: "rgba(0, 194, 146, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0, 194, 146, 0.5)",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: JSON.parse('{!! json_encode($data_impor_tumbuhan) !!}')
                }
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }

        }
    });

    //frekuensi chart
    var ctx = document.getElementById("frekuensiChartImpor");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: ['{{ $f_hewan_impor }}', '{{ $f_tumbuhan_impor  }}'],
                backgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ],
                hoverBackgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ]

            }],
            labels: [
                "Hewan",
                "Tumbuhan",
            ]
        },
        options: {
            responsive: true
        }
    });

    //ragam chart
    var ctx = document.getElementById("ragamChartImpor");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: ['{{ $r_hewan_impor }}', '{{ $r_tumbuhan_impor  }}'],
                backgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ],
                hoverBackgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ]

            }],
            labels: [
                "Hewan",
                "Tumbuhan",
            ]
        },
        options: {
            responsive: true
        }
    });

    //ragam chart
    var ctx = document.getElementById("pnbpChartImpor");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: ['{{ $pnbp_hewan_impor }}', '{{ $pnbp_tumbuhan_impor  }}'],
                backgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ],
                hoverBackgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ]

            }],
            labels: [
                "Hewan",
                "Tumbuhan",
            ]
        },
        options: {
            responsive: true
        }
    });

    // Ekspor
    // line Chart
    var ctx = document.getElementById("lineChartEkspor");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Agu", "Sep", "Okt",
                "Nov", "Des"
            ],
            datasets: [{
                    label: "Hewan",
                    borderColor: "rgba(0,0,0,.09)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0,0,0,.07)",
                    data: JSON.parse('{!! json_encode($data_ekspor_hewan) !!}')
                },
                {
                    label: "Tumbuhan",
                    borderColor: "rgba(0, 194, 146, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0, 194, 146, 0.5)",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: JSON.parse('{!! json_encode($data_ekspor_tumbuhan) !!}')
                }
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }

        }
    });

    //frekuensi chart
    var ctx = document.getElementById("frekuensiChartEkspor");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: ['{{ $f_hewan_ekspor }}', '{{ $f_tumbuhan_ekspor  }}'],
                backgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ],
                hoverBackgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ]

            }],
            labels: [
                "Hewan",
                "Tumbuhan",
            ]
        },
        options: {
            responsive: true
        }
    });

    //ragam chart
    var ctx = document.getElementById("ragamChartEkspor");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: ['{{ $r_hewan_ekspor }}', '{{ $r_tumbuhan_ekspor  }}'],
                backgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ],
                hoverBackgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ]

            }],
            labels: [
                "Hewan",
                "Tumbuhan",
            ]
        },
        options: {
            responsive: true
        }
    });

    //ragam chart
    var ctx = document.getElementById("pnbpChartEkspor");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: ['{{ $pnbp_hewan_ekspor }}', '{{ $pnbp_tumbuhan_ekspor  }}'],
                backgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ],
                hoverBackgroundColor: [
                    "rgba(0,0,0,0.07)",
                    "rgba(0, 194, 146,0.9)",
                ]

            }],
            labels: [
                "Hewan",
                "Tumbuhan",
            ]
        },
        options: {
            responsive: true
        }
    });

</script>

@endsection
