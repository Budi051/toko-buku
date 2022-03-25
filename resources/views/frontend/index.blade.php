@extends('layouts.frontend')

@section('title', 'Products')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="container products">

        <div class="row">

            @foreach($products as $b)
                <div class="col-xs-18 col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="{{ asset('images/'.$b->gambar) }}" width="500" height="300">
                        <div class="caption">
                            <p><h4>{{ $b->title }}</h4><h5>-{{$b->category->name}}-</h5></p>
                            
                            <h6>Published by : {{ $b->publisher}}</h6>
                            <p></p>
                            <p><strong>Stok: </strong>{{ $b->stok }}<br><strong>Price: </strong> Rp. {{ $b->price }}</p>
                            <p class="btn-holder"><a href="{{ url('add-to-cart/'.$b->id) }}" 
                               class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div><!-- End row -->

    </div>

@endsection