@extends('layouts.head')

@section('content')
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <h1>Data Barang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Data Barang</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data Barang</h2>


                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="d-flex justify-between">
                                <div class="card-header">
                                    <h4>Data</h4>
                                </div>

                                <button data-toggle="modal" data-target="#tambah-modal"
                                    class="btn btn-icon h-fit icon-left btn-primary" style="height: fit-content"><i
                                        class="fas fa-plus"></i>
                                    Tambah Data</button>



                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Gambar</th>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                                <th>Edit</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($barang as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><img src="{{ asset($data->gambar) }}" width="100"
                                                            height="100"></td>
                                                    <td>{{ $data->nama }}</td>
                                                    <td>{{ $data->harga }}</td>
                                                    <td><button data-toggle="modal"
                                                            data-target="#edit-modal-{{ $data->id }}"
                                                            class="btn btn-warning">Edit</button></td>
                                                    <td>
                                                        <form action="{{ route('barangs.delete', ['id' => $data->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button
                                                                onclick="return confirm('Apakah anda yakin ingin menghapus data {{ $data->nama }} ?')"
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
    <div class="modal fade" tabindex="-1" role="dialog" id="tambah-modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action={{ route('barangs.store') }} enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="mt-4">
                                    <label for="name">Nama </label>
                                    <input id="name" class="form-control" type="text" name="name"
                                        :value="old('name')" required autofocus autocomplete="name" />
                                    <p :messages="$errors - > get('name')" class="mt-2" />
                                </div>
                                <div class="mt-4">
                                    <label for="harga">Harga </label>
                                    <input id="harga" class="form-control" type="number" name="harga"
                                        :value="old('harga')" required autofocus autocomplete="harga" />
                                    <p :messages="$errors - > get('harga')" class="mt-2" />
                                </div>
                                <div class="mt-4">
                                    <label for="gambar">Gambar </label>
                                    <input id="gambar" class="form-control" type="file" name="gambar"
                                        :value="old('gambar')" required autofocus autocomplete="gambar" />
                                    <p :messages="$errors - > get('gambar')" class="mt-2" />
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach ($barang as $data)
        <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal-{{ $data->id }}">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action={{ route('barangs.update', ['id' => $data->id]) }}
                        enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mt-4">
                                        <label for="name">Nama </label>
                                        <input id="name" class="form-control" type="text" name="name"
                                            value="{{ $data->nama }}" required autofocus autocomplete="name" />
                                        <p :messages="$errors - > get('name')" class="mt-2" />
                                    </div>
                                    <div class="mt-4">
                                        <label for="harga">Harga </label>
                                        <input id="harga" class="form-control" type="number" name="harga"
                                            value="{{ $data->harga }}" required autofocus autocomplete="harga" />
                                        <p :messages="$errors - > get('harga')" class="mt-2" />
                                    </div>
                                    <div class="mt-4">
                                        <label for="gambar">Gambar </label>
                                        <input id="gambar" class="form-control" type="file" name="gambar"
                                            :value="old('gambar')" autofocus autocomplete="gambar" />
                                        <p :messages="$errors - > get('gambar')" class="mt-2" />
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
