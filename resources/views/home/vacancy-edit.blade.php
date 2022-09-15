@extends('layouts.home')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Ubah Lowongan</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Ubah Lowongan</h6>
            </div>
            <div class="card-body">

                <form action="{{ $path }}/{{ $data->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <label for="perusahaan_id" class="col-sm-2 col-form-label">ID Perusahaan</label>
                        <div class="col-sm-10">
                            <input name="perusahaan_id" type="text"
                                class="form-control @error('perusahaan_id') is-invalid @enderror" id="perusahaan_id" list="company" value="{{ $data->perusahaan_id }}">
                            <datalist id="company">
                                @foreach ($company as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </datalist>
                            @error('perusahaan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lowongan" class="col-sm-2 col-form-label">Lowongan</label>
                        <div class="col-sm-10">
                            <input name="lowongan" type="text" class="form-control @error('lowongan') is-invalid @enderror"
                                id="lowongan" value="{{ $data->lowongan }}">
                            @error('lowongan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="skill" class="col-sm-2 col-form-label">Kemampuan</label>
                        <div class="col-sm-10">
                            <input name="skill" type="skill" class="form-control @error('skill') is-invalid @enderror"
                                id="skill" value="{{ $data->skill }}">
                            @error('skill')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="min_gaji" class="col-sm-2 col-form-label">Minimal Gaji</label>
                        <div class="col-sm-10">
                            <input name="min_gaji" type="number" class="form-control @error('min_gaji') is-invalid @enderror"
                                id="min_gaji" value="{{ $data->min_gaji }}">
                            @error('min_gaji')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="max_gaji" class="col-sm-2 col-form-label">Maksimal Gaji</label>
                        <div class="col-sm-10">
                            <input name="max_gaji" type="number" class="form-control @error('max_gaji') is-invalid @enderror"
                                id="max_gaji" value="{{ $data->max_gaji }}">
                            @error('max_gaji')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="experience" class="col-sm-2 col-form-label">Pengalaman</label>
                        <div class="col-sm-10">
                            <input name="experience" type="text" class="form-control @error('experience') is-invalid @enderror"
                                id="experience" value="{{ $data->experience }}">
                            @error('experience')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi" class="col-sm-2 col-form-label">Lokasi</label>
                        <div class="col-sm-10">
                            <input name="lokasi" type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                id="lokasi" value="{{ $data->lokasi }}">
                            @error('lokasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jobdesk" class="col-sm-2 col-form-label">Jobdesk</label>
                        <div class="col-sm-10">
                            <textarea name="jobdesk" type="text" class="form-control @error('jobdesk') is-invalid @enderror" id="jobdesk">{{ $data->jobdesk }}</textarea>
                            @error('jobdesk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="logo" class="col-sm-2 col-form-label">Gambar</label>
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
                            <img id="output" height="200" width="200" src="/gambar/{{ $data->gambar }}">
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
