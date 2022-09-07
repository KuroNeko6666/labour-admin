@extends('layouts.home')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Edit Kemampuan</h1>

        @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Kemampuan</h6>
            </div>
            <div class="card-body">

                <form action="{{ $path }}/{{ $data->id }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <label for="skill_group" class="col-sm-2 col-form-label">ID Kategori</label>
                        <div class="col-sm-10">
                            <input name="skill_group" type="text" class="form-control @error('skill_group') is-invalid @enderror" id="skill_group" value="{{ $data->skill_group }}" list="skill_group">
                            <datalist id="skill_group">
                                @foreach ($skill as $item)
                                    <option value="{{ $item->skill_group }}"></option>
                                @endforeach
                            </datalist>
                            @error('skill_group')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="skill" class="col-sm-2 col-form-label">Nama Kemampuan</label>
                        <div class="col-sm-10">
                            <input name="skill" type="text" class="form-control @error('skill') is-invalid @enderror" id="skill" value="{{ $data->skill }}">
                            @error('skill')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row justify-content-end">
                        <a href="{{ $path }}" class="btn btn-light text-primary mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
