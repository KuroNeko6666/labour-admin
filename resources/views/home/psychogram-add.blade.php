@extends('layouts.home')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Tambah Data Psikogram</h1>

        <!-- DataTales Example -->
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Data Psikogram</h6>
            </div>
            <div class="card-body">

                <form action="{{ $path }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class='col-sm-2'for="file">Pilih file</label>
                        <div class="col-sm-10">
                            <label class="custom-file-label" for="file"></label>
                            <input name="file" type="file" class="custom-file-input form-control  @error('file') is-invalid @enderror" id="file" accept="image/*" onchange="loadFile(event)">
                            @error('file')
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
        <script type="application/javascript">
            $('input[type="file"]').change(function(e){
                var fileName = e.target.files[0].name;
                $('.custom-file-label').html(fileName);
            });
        </script>


    </div>

@endsection
