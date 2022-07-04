@extends('layouts.master')

@section('title')
    SKRD Herregistrasi
@endsection
<link href="{{ asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            SKRD
        @endslot
        @slot('title')
            Herregistrasi
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Registrasi</th>
                                <th>Nama Ahliwaris</th>
                                {{-- <th>Tahun Herregistrasi</th> --}}
                                <th>Nama Makam</th>
                                <th>Nominal</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->registrasi->kode_registrasi }}</td>
                                    <td>{{ $item->registrasi->ahliwaris->nama }}</td>
                                    {{-- <td>{{$tahun = \Carbon\Carbon::parse($item->registrasi->tanggal_meninggal)->addYear(2)->format('Y')}}</td> --}}
                                    <td>{{ $item->registrasi->nama_meninggal }}</td>
                                    <td>{{ $item->nominal }}</td>
                                    <td>
                                        <button onclick="inv({{ $item->id }})" type="button"
                                            class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                            Lihat
                                        </button>
                                        {{-- <a href="/pembayaran/herregistrasi/detail?id={{$item->id}}">Bayar</a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <div class="modal fade transaction-detailModal" id="modal" tabindex="-1" role="dialog"
        aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transaction-detailModalLabel">Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">Kode Makam <span class="text-primary" id="kode_registrasi"></span></p>
                    <p class="mb-4">Nama Makam: <span class="text-primary" id="nama_makam"></span></p>
                </div>
                <div class="modal-footer" id="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ asset('/assets/libs/inputmask/inputmask.min.js') }}"></script>
    <script src="{{ asset('/assets/js/pages/form-mask.init.js') }}"></script>


    <script>
        function inv(id) {
            $.ajax({
                url: "{{ route('herregistrasi') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#modal').modal('show');
                    $('#kode_registrasi').text(res.registrasi.kode_registrasi);
                    $('#nama_makam').text(res.registrasi.nama_meninggal);

                }
            });
        }
    </script>
    <script type="text/javascript">
      
    </script>
@endsection
