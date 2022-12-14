@extends('layouts.home')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Data Perusahaan</h1>

        <form action="{{ $path }}">
            @if (request('status'))
            <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <div class="input-group mb-3">
                <input name="search" type="text" class="form-control bg-white border-0 " placeholder="Cari Data.." aria-label="Cari Data.." aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit" id="button-addon2">
                    <i class="fas fa-fw fa-search"></i>
                  </button>
                </div>
            </div>
        </form>

        <!-- DataTales Example -->
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Tabel Perusahaan</h6>
                    <a href="{{ $path }}/create" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                          <a class="nav-link {{ $status == '' ? 'active' : '' }}" href="{{ $path }}">Semua</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'active' ? 'active' : '' }}" href="{{ $path . '?status=active' }}">Aktif</a>
                          </li>
                        <li class="nav-item">
                          <a class="nav-link {{ $status == 'non-active' ? 'active' : '' }}" href="{{ $path . '?status=non-active' }}">Non Aktif</a>
                        </li>
                      </ul>
                    @if ($data->count() != 0 )
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>NoHp</th>
                                    <th>Alamat</th>
                                    <th>Member</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + $data->firstItem() }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->hp }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->member }}</td>
                                        <td>
                                            @livewire('user-status', ['user' => $item], key($item->id))
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="nav-link" href="{{ $path }}/{{ $item->id }}/edit">
                                                    <i class="fas fa-fw fa-pen"></i>
                                                </a>
                                                <a class="nav-link" href="#"
                                                    data-target="#deleteModal{{ $item->id }}" data-toggle="modal">
                                                    <i class="fas fa-fw fa-trash text-danger"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    @include('partials.delete-modal')
                                @endforeach
                            </tbody>
                        </table>
                    @else

                        <p class="text-center">Tidak ada data</p>

                    @endif
                </div>
            </div>
        </div>

        {{ $data->links() }}

    </div>
@endsection
