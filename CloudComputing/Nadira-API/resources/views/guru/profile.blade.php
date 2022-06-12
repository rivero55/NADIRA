@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h1 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Data Guru</h1>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Data</li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Guru</li>
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
                        <h4 class="mb-0 "> Edit Data Guru</h4>
                    </div>

                    <div class="card-body">
                        <form class="form" method="post" action="{{ url('/guru/updateByGuru') }}">
                            @csrf

                            <input type="hidden" name="id" value="{{ $widget['guru']->id }}">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input readonly class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ $widget['guru']->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kontak ( Utamakan nomor aktif Whatsapp ) </label>
                                        <input class="form-control @error('contact') is-invalid @enderror" name="contact"
                                            value="{{ $widget['guru']->contact }}" required>
                                    </div>


                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ $widget['guru']->email }}" required>
                                        <small class="form-text text-muted"><strong>Email Ini Akan Digunakan Untuk
                                                Login</strong></small>
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
                        <h4 class="mb-0 ">Ganti Password</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ url('guru/update_password') }}" method="post">
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
