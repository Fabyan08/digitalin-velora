@extends('layouts.head')

@section('content')
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <h1>Data Order</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Data Order</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data Order</h2>


                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="d-flex justify-between">
                                <div class="card-header">
                                    <h4>Data</h4>
                                </div>
                            </div>
                            <div style="margin-left:30px">
                                <h4>Pemesan: {{ $orders[0]->name }} </h4>
                                <h6>Tanggal: {{ date('j F Y', strtotime($orders[0]->created_at)) }}</h6>
                            </div>

                            @if ($orders[0]->status == 'Pending')
                                <div class="badge badge-warning">Pending</div>
                            @else
                                <div class="badge badge-success">Success</div>
                            @endif
                            <div class="row">
                                @foreach ($orders as $order)
                                    <div class="col-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="{{ asset($order->gambar) }}" width="100" alt="Gambar">
                                                <p>{{ $order->nama }}</p>
                                                <p>Jumlah: {{ $order->jumlah }}</p>
                                                <p>Harga : {{ $order->harga }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
