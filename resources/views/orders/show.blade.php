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
                    @if ($order->payment_status == 1)
                    <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
                @else
                    Pembayaran berhasil
                @endif
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
@section('script')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        const payButton = document.querySelector('#pay-button');
        payButton.addEventListener('click', function(e) {
            e.preventDefault();
 
            snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                }
            });
        });
    </script>
@endsection
