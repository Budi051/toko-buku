@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Daftar Buku</div>
                
                <div class="card-body">
                <a href="{{route('books.create')}}">+ Tambah Buku Baru</a>
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
                            <th class="text-center">Kode</th>
                            <th class="text-center">Nama Buku</th>
                            <th class="text-center">Publisher</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Detail</th>
                            <th class="text-center">Edit</th>
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
                                <td data-th="Judul">{{ $t->title }}</td>
                                <td data-th="Total">
                                    {{ $t->publisher }}
                                </td>
                                <td data-th="Harga">
                                    Rp. {{ $t->price }}
                                </td>
                                <td data-th="Harga">
                                    {{ $t->stok }}
                                </td>
                                <td>
                                    <a href="{{asset('images/'.$t->gambar)}}" target="_blank">
                                        <img src="{{asset('images/'.$t->gambar)}}" style="width:100px; height:150px;">
                                    </a><br>
                                    <a href="#modal_edit_foto_{{$t->id}}" class="btn btn-success" data-toggle="modal">Change</a>
                                </td>
                                <td class="actions" data-th="">
                                    <a class="btn btn-primary" data-target="#modal_detail_{{$t->id}}"
                                       data-toggle="modal" href="{{ route('books.show', $t->id) }}">View</a>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="#modal_edit_book" data-toggle="modal" 
                                        onclick="getDataFirst({{$t->id}});">Edit</a>
                                </td>
                                @can('checkadmin')
                                <td>
                                    <form method="POST" action="{{ route('books.destroy', $t->id) }}">
                                        @csrf
                                        @method("DELETE")
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
                                            <h4 class="modal-title">Detail Buku</h4>
                                        </div>
                                        <div class="modal-body"> 
                                            <div class="row">        
                                                <div class="col-md-6">
                                                <img src="{{ asset('images/'.$t->gambar) }}" width="200px", height="300px"/>
                                                </div>
                                                <div class="col-md-6">
                                                <p>ID Buku : <b>{{$t->id}}</b></p>
                                                <p>Judul Buku :  <b>{{$t->title}}</b></p>
                                                <p>Publisher :  <b>{{$t->publisher}}</b></p>
                                                <p>Price :  <b>{{$t->price}}</b></p>
                                                <p>Stok :  <b>{{$t->stok}}</b></p>
                                                <p>Kategori :  <b>{{$t->category->name}}</b></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modal_edit_book" tabindex="-1" role="basic" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">Edit Buku</h4>
                                    </div>
                                        <div class="modal-body" id="isi_modal_edit_book">
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modal_edit_foto_{{$t->id}}" tabindex="-1" role="basic" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Edit Foto Buku</h4>
                                    </div>
                                    <form method="POST" action=" {{ route('book.changeFoto') }} " enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body" id="isi_modal_edit_supplier">
                                        <div class="form-group row">
                                            <label for="foto" class="col-sm-2 col-form-label">Foto Buku</label>
                                            <div class="col-sm-10">
                                            <input type="file" value="" name="foto" class="form-control" id="foto" required>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="{{$t->id}}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn bnt-default" data-dismiss="modal">Batal</button>
                                    </div>
                                    </form>
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
        $('#isi_modal_edit_book').html('Sedang memuat data ...'+id);
        $.post('{{route("book.getDataFirst")}}',
        {
        _token: "<?php echo csrf_token() ?>",
        id: id
        },
        function(data){
        if(data.status == "oke")
        {
            $('#isi_modal_edit_book').html(data.msg)
        }
        else
        {
            $('#isi_modal_edit_book').html('Gagal mengambil')
        }
        });
    }
</script>
@endsection
