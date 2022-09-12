@extends('layouts.home')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Tambah Jadwal Psikotest</h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Jadwal Psikotest</h6>
            </div>
            <div class="card-body">

                <form action="{{ $path }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="psikolog_id" class="col-sm-2 col-form-label">ID Psikolog</label>
                        <div class="col-sm-10">
                            <input name="psikolog_id" type="number" class="form-control @error('psikolog_id') is-invalid @enderror" id="psikolog_id" list="psycholog">
                            <datalist id="psycholog">
                                @foreach ($psychologist as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </datalist>
                            @error('psikolog_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_test" class="col-sm-2 col-form-label">Jenis Test</label>
                        <div class="col-sm-10">
                            <input name="jenis_test" type="text" class="form-control @error('jenis_test') is-invalid @enderror" id="jenis_test">
                            @error('jenis_test')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="waktu" class="col-sm-2 col-form-label">Waktu</label>
                        <div class="col-sm-10">
                            <input name="waktu" type="datetime-local" class="form-control @error('waktu') is-invalid @enderror" id="waktu">
                            @error('waktu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kuota" class="col-sm-2 col-form-label">Kuota</label>
                        <div class="col-sm-10">
                            <input name="kuota" type="number" class="form-control @error('kuota') is-invalid @enderror" id="kuota">
                            @error('kuota')
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
