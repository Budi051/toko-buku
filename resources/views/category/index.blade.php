@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Daftar Kategori</div>
                
                <div class="card-body">
                <a href="{{route('book_category.create')}}">+ Tambah Kategori Baru</a>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif


                    
                    <table id="nota" class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kategori</th>
                            <th>Detail</th>
                            <th>Edit</th>
                            @can('checkadmin')
                            <th class="text-center">Delete</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($query as $t)
                            <tr>
                                <td data-th="Kode">
                                   {{ $t->id }}
                                </td>
                                <td data-th="Judul">{{ $t->name }}</td>

                                <td class="actions" data-th="">
                                    <a class="btn btn-primary" data-target="#modal_detail_{{$t->id}}"
                                       data-toggle="modal" href="{{ route('book_category.show', $t->id) }}">View</a>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="#modal_edit_category" data-toggle="modal" 
                                        onclick="getDataFirst({{$t->id}});">Edit</a>
                                </td>
                                @can('checkadmin')
                                <td>
                                    <form method="POST" action="{{ route('book_category.destroy', $t->id) }}">
                                        @csrf
                                        @method("DELETE")
                                        <input type="hidden" value="{{$t->id}}" name="id">
                                        <input type="submit" value="Delete" class="btn btn-danger btn xs" 
                                        onclick="if(!confirm('Apakah anda yakin ingin menghapus data ini ?')) return false;"/>
                                    </form>
                                </td>
                                @endcan
                                
                            </tr>

                            <div class="modal fade" id="modal_detail_{{$t->id}}" tabindex="-1" role="basic" aria-hidden="true">								
                                <div class="modal-dialog  modal-wide">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">Detail Kategori</h4>
                                        </div>
                                        <div class="modal-body"> 
                                            <div class="row">
                                                @foreach($t->books as $d)        
                                                <div class="col-md-6">
                                                    <p>Judul Buku : <b>{{$d->title}}</b></p>
                                                    <p>Publisher :  <b>{{$d->publisher}}</b></p>
                                                    <p>Harga :  <b>{{$d->price}}</b></p>
                                                    <p>Stok :  <b>{{$d->stok}}</b></p>
                                                    <p><img src="{{asset('images/'.$d->gambar)}}" style="width:100px; height:150px;"></p>
                                                    <p>-----------------------------------</p>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modal_edit_category" tabindex="-1" role="basic" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">Edit Category</h4>
                                    </div>
                                        <div class="modal-body" id="isi_modal_edit_category">
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('tempat_script')
<script>
    function getDataFirst(id)
    {
        $('#isi_modal_edit_category').html('Sedang memuat data ...'+id);
        $.post('{{route("category.getDataFirst")}}',
        {
        _token: "<?php echo csrf_token() ?>",
        id: id
        },
        function(data){
        if(data.status == "oke")
        {
            $('#isi_modal_edit_category').html(data.msg)
        }
        else
        {
            $('#isi_modal_edit_category').html('Gagal mengambil')
        }
        });
    }
</script>
@endsection
