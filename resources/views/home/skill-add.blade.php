@extends('layouts.home')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Tambah Kemampuan</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Kemampuan</h6>
            </div>
            <div class="card-body">

                <form action="{{ $path }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="category_id" class="col-sm-2 col-form-label">Kategori Kemampuan</label>
                        <div class="col-sm-10">
                            <input name="category_id" type="number" class="form-control @error('category_id') is-invalid @enderror" id="category_id" list="psycholog">
                            <datalist id="psycholog">
                                @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->category }}</option>
                                @endforeach
                            </datalist>
                            @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="skill" class="col-sm-2 col-form-label">Nama Kemampuan</label>
                        <div class="col-sm-10">
                            <input name="skill" type="text" class="form-control @error('skill') is-invalid @enderror" id="skill">
                            @error('skill')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
@endsection
