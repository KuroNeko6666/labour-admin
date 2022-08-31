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
                        <label for="user_id" class="col-sm-2 col-form-label">ID Peserta</label>
                        <div class="col-sm-10">
                            <select name="user_id" id="user_id"
                                class="select-search form-control m-5 @error('user_id') is-invalid @enderror">
                                <option selected disabled>Cari ID Peserta</option>
                                @foreach ($user as $item)
                                <option value="{{ $item->id }}">{{ $item->email }}</option>
                            @endforeach
                            </select>
                            @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="psychotest_id" class="col-sm-2 col-form-label">ID Peserta</label>
                        <div class="col-sm-10">
                            <select name="psychotest_id" id="psychotest_id"
                                class="select-search form-control m-5 @error('psychotest_id') is-invalid @enderror">
                                <option selected disabled>Cari ID Psikotest</option>
                                @foreach ($psychotest as $item)
                                <option value="{{ $item->id }}">{{'ID: '. $item->id.', Lokasi: '.$item->location }}</option>
                            @endforeach
                            </select>
                            @error('psychotest_id')
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


	<script>
		$(".select-search").select2();
	</script>
@endsection
