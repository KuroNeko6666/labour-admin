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
                        <label for="users_id" class="col-sm-2 col-form-label">ID Peserta</label>
                        <div class="col-sm-10">
                            <input name="users_id" type="text"
                                class="form-control @error('users_id') is-invalid @enderror" id="users_id"
                                value="{{ $data->users_id }}" list="user">
                            <datalist id="user">
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </datalist>
                            @error('users_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jadwal_id" class="col-sm-2 col-form-label">ID Psikotest</label>
                        <div class="col-sm-10">
                            <input name="jadwal_id" type="text"
                                class="form-control @error('jadwal_id') is-invalid @enderror" id="jadwal_id"
                                value="{{ $data->jadwal_id }}" list="psychotest">
                            <datalist id="psychotest">
                                @foreach ($psychotest as $item)
                                    <option value="{{ $item->id }}">{{ $item->jenis_test }}</option>
                                @endforeach
                            </datalist>
                            @error('jadwal_id')
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

