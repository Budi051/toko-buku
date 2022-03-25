<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Detail Buku</h4>
</div>
<div class="modal-body"> 
  <div class="row">        
    <div class="col-md-4">
      <img src="{{ asset('images/'.$data->gambar) }}" width="350px", height="300px"/>
    </div>
    <div class="col-md-4">
      <p>ID Buku : <b>{{$data->id}}</b></p>
      <p>Judul Buku :  <b>{{$data->title}}</b></p>
      <p>Publisher :  <b>{{$data->publisher}}</b></p>
      <p>Price :  <b>{{$data->price}}</b></p>
      <p>Stok :  <b>{{$data->stok}}</b></p>
      <p>Kategori :  <b>{{$data->category->name}}</b></p>
    </div>
  </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
