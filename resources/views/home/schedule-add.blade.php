@extends('layouts.home')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Tambah Jadwal Psikotest</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Jadwal Psikotest</h6>
            </div>
            <div class="card-body">

                <form action="{{ $path }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="psychologist_id" class="col-sm-2 col-form-label">ID Psikolog</label>
                        <div class="col-sm-10">
                            <input name="psychologist_id" type="number" class="form-control @error('psychologist_id') is-invalid @enderror" id="psychologist_id" list="psycholog">
                            <datalist id="psycholog">
                                @foreach ($psychologist as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </datalist>
                            @error('psychologist_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="location" class="col-sm-2 col-form-label">Lokasi</label>
                        <div class="col-sm-10">
                            <input name="location" type="text" class="form-control @error('location') is-invalid @enderror" id="location">
                            @error('location')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input name="date" type="date" class="form-control @error('date') is-invalid @enderror" id="date">
                            @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="time" class="col-sm-2 col-form-label">Jam</label>
                        <div class="col-sm-10">
                            <input name="time" type="time" class="form-control @error('time') is-invalid @enderror" id="time">
                            @error('time')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quota" class="col-sm-2 col-form-label">Kuota</label>
                        <div class="col-sm-10">
                            <input name="quota" type="number" class="form-control @error('quota') is-invalid @enderror" id="quota">
                            @error('quota')
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
