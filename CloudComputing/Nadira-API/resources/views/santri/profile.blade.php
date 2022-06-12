@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h1 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Data Santri</h1>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Data</li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Santri</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>



@endsection

@section('page-wrapper')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                @include('components.message')
            </div>

    

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white rounded-top">
                        <h4 class="mb-0 "> Edit Data Santri</h4>
                    </div>

                    <div class="card-body">
                        <form class="form" method="post" action="{{ url('/santri/update') }}">
                            @csrf

                            <input type="hidden" name="id" value="{{ $widget['santri']->id }}">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>NIM</label>
                                        <input disabled class="form-control @error('nis') is-invalid @enderror" name="nis"
                                            value="{{ $widget['santri']->nis }}" required>
                                    </div>
                                    <div disabled class="form-group">
                                        <label>Nama</label>
                                        <input disabled class="form-control @error('nama') is-invalid @enderror" name="nama"
                                            value="{{ $widget['santri']->nama }}" required>
                                    </div>

                                    <div class="form-group"> <label>Kelas</label>
                                        <select disabled class="form-control @error('kelas') is-invalid @enderror"
                                            name="kelas" required>
                                            @forelse ($widget['classes'] as $item)
                                                @if ($item->kelas == $widget['santri']->kelas)
                                                    <option selected value="{{ $item->kelas }}">{{ $item->kelas }}</option>
                                                @endif
                                                <option value="{{ $item->kelas }}">{{ $item->kelas }}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group"> <label> Program Studi</label>
                                        <select disabled class="form-control @error('jenjang') is-invalid @enderror"
                                            name="jenjang" required>
                                            @forelse ($widget['jenjang'] as $item)
                                                <option value="{{ $item->jenjang }}">{{ $item->jenjang }}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select disabled class="form-control" name="jk" required>
                                            <option value="" selected>Pilih Jenis Kelamin</option>
                                            @if (1 == $widget['santri']->jk)
                                                <option value="1" selected>Ikhwan</option>
                                                <option value="2">Akhwat</option>
                                            @else
                                                <option value="1">Ikhwan</option>
                                                <option value="2" selected>Akhwat</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Line ID</label>
                                        <input class="form-control" name="line_id"
                                            value="{{ $widget['santri']->line_id }}">
                                    </div>

                                    <div class="form-group">
                                        <label>No Telephone</label>
                                        <input class="form-control" name="no_telp"
                                            value="{{ $widget['santri']->no_telp }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Asrama</label>
                                        <select disabled class="form-control" name="asrama" required>
                                            @forelse ($widget['asrama'] as $item)
                                                @if ($item->asrama == $widget['santri']->asrama)
                                                    <option selected value="{{ $item->asrama }}">{{ $item->asrama }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item->asrama }}">{{ $item->asrama }}</option>
                                                @endif
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>


                                </div>

                                <div class="col-12 mt-5">
                                    <button type="submit"
                                        class="btn btn-block  waves-effect waves-light btn-lg btn-rounded btn-outline-success">Simpan
                                        Perubahan</button>
                                </div>

                        </form>
                    </div>

                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white rounded-top">
                        <h4 class="mb-0 "> Ganti Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('santri/update_password') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Password Lama</label>
                                <input type="text" class="form-control" name="old_password" id="" aria-describedby="helpId"
                                    placeholder="Masukkan Password Lama Antum" required>
                            </div>
                            <div class="form-group">
                                <label for="">Password Baru</label>
                                <input type="text" class="form-control" name="new_password" id="" aria-describedby="helpId"
                                placeholder="Masukkan Password Baru Antum" required>
                            </div>
                            <button type="submit"
                            class="btn btn-block  waves-effect waves-light btn-lg btn-rounded btn-outline-success">Simpan
                            Perubahan Password</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>




    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
@endsection

@section('app-script')

    @if (session()->has('success'))
        <script>
            swal("Alhamdulillah", "{{ Session::get('success') }}", "success");

        </script>
    @endif

    <script>
        function alertSuccess(message) {
            swal({
                icon: "success",
                message: message
            });
        }

    </script>
@endsection
