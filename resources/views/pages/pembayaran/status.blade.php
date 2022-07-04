@extends('layouts.master')

@section('title')
    Status Pembayaan
@endsection
@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Pembayaran
        @endslot
        @slot('title')
            Status
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                   <p id="status"></p>
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
    <script>
            $.ajax({
                url: "{{ url('https://api.sandbox.midtrans.com/v2/667882208/status') }}",
                dataType: 'json',
                success: function(res) {
                    console.log(res);

                }
            });
        
    </script>

@endsection
