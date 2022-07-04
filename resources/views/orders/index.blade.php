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
                    <table class="table table-hover table-condensed">
                        <thead class="thead-light">
                            <th scope="col">#</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Status Pembayaran</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>#{{ $order->number }}</td>
                                    <td>{{ number_format($order->total_price, 2, ',', '.') }}</td>
                                    <td>
                                        @if ($order->payment_status == 1)
                                            Menunggu Pembayaran
                                        @elseif ($order->payment_status == 2)
                                            Sudah Dibayar
                                        @else
                                            Kadaluarsa
                                        @endif
                                    </td>
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
        </div> <!-- end col -->
    </div>
@endsection
@section('script')

@endsection
