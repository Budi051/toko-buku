@extends('layouts.frontend')

@section('title', 'Riwayat')

@section('content')
    <p>Kode Transaksi = {{$order->id}}</p>
    <p>Tanggal Transaksi = {{$order->created_at}}</p>
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Title</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
        </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            @foreach($order->book as $detail)
            <?php $total += $detail->pivot->harga_satuan * $detail->pivot->quantity; ?>
            <tr>
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-3 hidden-xs"><img src="{{asset('images/'.$detail->gambar)}}" alt="..." 
                            class="img-responsive" width="100px" height="100px"/></div>
                        <div class="col-sm-9">
                            <h4 class="nomargin">{{$detail->title}}</h4>
                        </div>
                    </div>
                </td>
                <td data-th="Price">{{$detail->pivot->harga_satuan}}</td>
                <td data-th="Quantity">
                    {{$detail->pivot->quantity}}
                </td>
                <td data-th="Subtotal" class="text-center">{{$detail->pivot->harga_satuan * $detail->pivot->quantity}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
        <tr class="visible-xs">
            <td class="text-center"><strong>Total {{$total}}</strong></td>
        </tr>
        <tr>
        <td><a href="{{ url('/catalog') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
        </tr>
        </tfoot>
    </table>

@endsection