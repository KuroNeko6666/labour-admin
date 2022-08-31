@extends('layouts.home')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Ubah Kategori</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Ubah Kategori</h6>
            </div>
            <div class="card-body">

                <form action="{{ $path }}/{{ $data->id }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <label for="category" class="col-sm-2 col-form-label">Nama Kategori</label>
                        <div class="col-sm-10">
                            <input name="category" type="text" class="form-control @error('category') is-invalid @enderror" id="category" value="{{ $data->category }}">
                            @error('category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
@endsection
