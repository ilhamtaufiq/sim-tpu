@extends('layouts.master')

@section('title') 
Detail Makam
@endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Makam @endslot
@slot('title') Detail Makam @endslot
@endcomponent

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-4">
                        <img src="{{route('root')}}/assets/images/pemda.png" alt="" class="avatar-sm">
                    </div>

                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-truncate font-size-15">{{$data->kode_registrasi}}</h5>
                        <p class="text-muted">{{$data->nama_meninggal}}</p>
                    </div>
                </div>

                <h5 class="font-size-15 mt-4">Ahliwaris :</h5>

                <p class="text-muted">{{$data->ahliwaris->nama}} - {{$data->ahliwaris->nomor_telepon}}</p>

                <div class="text-muted mt-4">
                    <p><i class="mdi mdi-chevron-right text-primary me-1"></i> {{$data->tpu->nama_tpu}}</p>
                    <p><i class="mdi mdi-chevron-right text-primary me-1"></i> Blok Makam: {{$data->blok_makam}}</p>
                </div>
                <div class="row task-dates">
                    <div class="col-sm-4 col-6">
                        <div class="mt-4">
                            <h5 class="font-size-14"><i class="bx bx-calendar me-1 text-primary"></i>Tanggal Registrasi</h5>
                            <p class="text-muted mb-0">{{$data->tanggal_meninggal}}</p>
                        </div>
                    </div>

                    <div class="col-sm-4 col-6">
                        <div class="mt-4">
                            <h5 class="font-size-14"><i class="bx bx-calendar-check me-1 text-primary"></i>Herregistrasi terkahir</h5>
                            <p class="text-muted mb-0">12 Oct, 2019</p>
                        </div>
                    </div>
                </div>
                <div>
                   {{$data->order->number}}
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Invoice</h4>
                <div class="table-responsive">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>

<!-- end row -->

@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- project-overview init -->
<script src="{{ asset('/assets/js/pages/project-overview.init.js') }}"></script>
@endsection