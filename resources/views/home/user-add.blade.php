@extends('layouts.home')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Tambah Akun Psikolog</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Akun Psikolog</h6>
            </div>
            <div class="card-body">

                <form action="{{ $path }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hp" class="col-sm-2 col-form-label">No HP</label>
                        <div class="col-sm-10">
                            <input name="hp" type="number" class="form-control @error('hp') is-invalid @enderror" id="hp">
                            @error('hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-10">
                            <input name="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input name="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                        <div class="col-sm-10">
                            <input name="provinsi" type="text" class="form-control @error('provinsi') is-invalid @enderror" id="provinsi">
                            @error('provinsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kokab" class="col-sm-2 col-form-label">Kota</label>
                        <div class="col-sm-10">
                            <input name="kokab" type="text" class="form-control @error('kokab') is-invalid @enderror" id="kokab">
                            @error('kokab')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat">
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kewarganegaraan" class="col-sm-2 col-form-label">kewarganegaraan</label>
                        <div class="col-sm-10">
                            <select name="kewarganegaraan" id="kewarganegaraan"
                                class="form-control @error('kewarganegaraan') is-invalid @enderror">
                                <option value="WNI">WNI</option>
                                <option value="WNA">WNA</option>
                            </select>
                            @error('kewarganegaraan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                        <div class="col-sm-10">
                            <input name="agama" type="text" class="form-control @error('agama') is-invalid @enderror" id="agama">
                            @error('agama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-3 ml-2">
                            <label class="custom-file-label" for="foto">Pilih Gambar</label>
                            <input name="foto" type="file" class="custom-file-input form-control  @error('foto') is-invalid @enderror" id="foto" accept="image/*" onchange="loadFile(event)">
                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="ml-3">
                            <img id="output" height="200" width="200">
                            <p class="fs-6 text-center mt-2">Preview</p>
                        </div>

                    </div>
                    <div class="form-group row justify-content-end">
                        <a href="{{ $path }}" class="btn btn-light text-primary mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
    <script type="application/javascript">
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });
        var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
        }
    };
    </script>
@endsection
