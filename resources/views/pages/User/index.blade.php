@extends('layouts.head')

@section('content')
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <h1>Data User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Data User</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data User</h2>


                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="d-flex justify-between">
                                <div class="card-header">
                                    <h4>Data</h4>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Level</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>

                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->email }}</td>
                                                    <td>
                                                        <div class="badge badge-warning">{{ $data->level }}</div>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('users.delete', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button
                                                                onclick="return confirm('Apakah anda yakin ingin menghapus data {{ $data->name }} ?')"
                                                                type="submit"
                                                                class="btn btn-icon h-fit icon-left btn-danger"
                                                                style="height: fit-content">
                                                                Hapus </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection