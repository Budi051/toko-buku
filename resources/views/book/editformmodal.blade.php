<form method="POST" action="{{route('books.update', $book->id)}}" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Judul</label>
        <div class="col-sm-10">
        <input type="text" value="{{$book->title}}" name="book" class="form-control" id="eBook" placeholder="Book" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Publisher</label>
        <div class="col-sm-10">
        <input type="text" value="{{$book->publisher}}" name="publisher" class="form-control" id="ePublisher" placeholder="Publisher" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="stok" class="col-sm-2 col-form-label">Stok</label>
        <div class="col-sm-10">
        <input type="number" value="{{$book->stok}}" name="stok" class="form-control" id="eStok" placeholder="Stok" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="harga" class="col-sm-2 col-form-label">Price</label>
        <div class="col-sm-10">
        <input type="number" value="{{$book->price}}" name="price" class="form-control" id="ePrice" placeholder="Price" step="100" required>
        </div>
    </div><br>
    <div class="form-group">
        <label >Kategori</label>
        <select class="form-control" 
        name="category_id" id="eKategori">
            @foreach($category as $c)
                @if($c->id == $book->idKategori)
                {
                    <option value="{{$c->id}}" selected>{{$c->name}}</option>
                }
                @else
                {
                    <option value="{{$c->id}}">{{$c->name}}</option>
                }
                @endif
            @endforeach
        </select>
    </div><br>
    
    <div class="custom-file">
        <label class="custom-file-label" for="gambar">Gambar Buku</label>
        <input type="file" class="custom-file-input" id="eGambar" name="gambar">
    </div>
    <br><br>

    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary" id="btnSubmit">Simpan</button>
            <a class="btn btn-danger" href="{{ route('books.index')}}">Batal</a>
        </div>
    </div>
</form>