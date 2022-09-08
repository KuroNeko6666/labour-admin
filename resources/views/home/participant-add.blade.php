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

                <form action="{{ $path }}{{ request('psychotest') ? '?psychotest='.request('psychotest') : '' }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="user_id" class="col-sm-2 col-form-label">ID Peserta</label>
                        <div class="col-sm-10">
                            <input name="user_id" type="text"
                                class="form-control @error('user_id') is-invalid @enderror" id="user_id" list="user">
                            <datalist id="user">
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </datalist>
                            @error('user_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="psychotest_id" class="col-sm-2 col-form-label {{ request('psychotest') ? 'd-none' : '' }}">ID Psikotest</label>
                        <div class="col-sm-10">
                            <input name="psychotest_id" type="{{ request('psychotest') ? 'hidden' : 'text' }}"
                                class="form-control @error('psychotest_id') is-invalid @enderror" id="psychotest_id"
                                 list="psychotest" value="{{ request('psychotest') }}">
                            <datalist id="psychotest">
                                @foreach ($psychotest as $item)
                                    <option value="{{ $item->id }}">{{ $item->location }}</option>
                                @endforeach
                            </datalist>
                            @error('psychotest_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <a href="{{ $path }}{{ request('psychotest') ? '?psychotest='.request('psychotest') : '' }}" class="btn btn-light text-primary mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>

            </div>
        </div>

    </div>


    <script>
        $(".select-search").select2();
    </script>
@endsection
