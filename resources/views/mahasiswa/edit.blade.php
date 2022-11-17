<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<!-- START FORM -->
@if ($errors->any())
    <div class="pt-3">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
<form action='{{ url('mahasiswa/' . $data->nim) }}' method='post'>
    @csrf
    @method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href='{{ url('mahasiswa') }}' class="btn btn-secondary">
            << kembali</a>
                <div class="mb-3 row">
                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                    <div class="col-sm-10">
                        {{ $data->nim }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nama' value="{{ $data->nama }}"
                            id="nama">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jeniskelamin" class="col-sm-2 col-form-label">jeniskelamin</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='jeniskelamin' value="{{ $data->jeniskelamin }}"
                            id="jeniskelamin">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kelas" class="col-sm-2 col-form-label">kelas</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name='kelas' value="{{ $data->kelas }}"
                            id="kelas">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label">alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='alamat' value="{{ $data->alamat }}"
                            id="alamat">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='jurusan' value="{{ $data->jurusan }}"
                            id="jurusan">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jurusan" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                    </div>
                </div>
</form>
</div>
<!-- AKHIR FORM -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>