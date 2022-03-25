@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Riwayat Transaksi') }}</div>

                <div class="card-body">
                   <h1></h1>
                   <table class="table table-hover table-border">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Total</th>
                                <th>Tanggal Transaksi</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($transaction as $t)
                            <tr>
                                <td>{{$t->id}}</td>
                                <td>{{$t->total_belanja}}</td>
                                <td>{{$t->created_at}}</td>
                                <td><a href="{{route('orders.show', $t->id)}}" class="btn btn-info">View</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                   </table>
                </div>
            </div>
            <a href="{{ url('/catalog') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
        </div>
    </div>
</div>
@endsection

