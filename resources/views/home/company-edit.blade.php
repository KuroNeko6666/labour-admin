@extends('layouts.home')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Edit Akun Perusahaan</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Akun Perusahaan</h6>
            </div>
            <div class="card-body">

                <form action="{{ $path }}/{{ $data->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $data->name }}">
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
                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $data->email }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="member" class="col-sm-2 col-form-label">Member</label>
                        <div class="col-sm-10">
                            <select name="member" id="member" class="form-control @error('member') is-invalid @enderror">
                                <option value="{{ $data->member }}" selected>{{ $data->member }}, Klik untuk ubah</option>
                                <option value="free">Free</option>
                                <option value="silver">Silver</option>
                                <option value="gold">Gold</option>
                            </select>
                            @error('member')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"
                                id="alamat" value="{{ $data->alamat }}">
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hp" class="col-sm-2 col-form-label">No Hp</label>
                        <div class="col-sm-10">
                            <input name="hp" type="number" class="form-control @error('hp') is-invalid @enderror"
                                id="hp"  value="{{ $data->hp }}">
                            @error('hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="web" class="col-sm-2 col-form-label">Website</label>
                        <div class="col-sm-10"  >
                            <input name="web" type="text" class="form-control @error('web') is-invalid @enderror"
                                id="web" value="{{ $data->web }}">
                            @error('web')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="visi" class="col-sm-2 col-form-label">Visi</label>
                        <div class="col-sm-10">
                            <textarea name="visi" type="text" class="form-control @error('visi') is-invalid @enderror" id="visi">{{ $data->visi }}</textarea>
                            @error('visi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="misi" class="col-sm-2 col-form-label">Misi</label>
                        <div class="col-sm-10">
                            <textarea name="misi" type="text" class="form-control @error('misi') is-invalid @enderror" id="misi">{{ $data->misi }}</textarea>
                            @error('misi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea name="deskripsi" type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi">{{ $data->deskripsi }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="logo" class="col-sm-2 col-form-label">Logo</label>
                        <div class="col-sm-3 ml-2">
                            <label class="custom-file-label" for="logo">Pilih Gambar</label>
                            <input name="logo" type="file" class="custom-file-input form-control  @error('logo') is-invalid @enderror" id="logo" accept="image/*" onchange="loadFile(event)">
                            @error('logo')
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
                        <button type="submit" class="btn btn-primary">Ubah</button>
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
