<form method="POST" action="{{ route('book_category.update', $cat->id) }}">
    @csrf
    @method("PUT")
   <input type="hidden" value="{{$cat->id}}" name="id">
    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Nama {{$cat->id}}</label>
        <div class="col-sm-10">
        <input type="text" value="{{$cat->name}}" name="namaKategori" class="form-control" id="eName" placeholder="Nama Kategori" required>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary" id="btnSubmit">Simpan</button>
            <a class="btn btn-danger" href="{{ route('book_category.index')}}">Batal</a>
        </div>
    </div>
</form>