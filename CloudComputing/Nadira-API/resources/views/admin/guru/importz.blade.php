@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Guru</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Import</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">
         
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
                        <h4 class="mb-0 ">Upload Data Guru (CSV)</h4>
                    </div>

                    <div class="card-body">
                        <p class="card-text"></p>
                        <form class="form" action="{{ route('import_guru') }}" method="post"
                            enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label>File input (.csv)</label>
                                <input type="file" class="form-control-file" name="file">
                                <small class="form-text text-muted">Baca keterangan sample file excel <a
                                        href="#">berikut</a></small>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table Format Information --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card-header bg-primary text-white rounded-top">
                    <h4 class="mb-0 ">Format File Excel Guru (Excel) </h4>
                </div>

                <div class="card ">
                    <div class="card-header card-header-inverse">
                        <p class="card-title title-collapse"></p>
                        <p class="card-text" style="color:#1c2d3f">Akan menolak tambahan attribut (Bold == Wajib
                            Ada)</p>
                    </div>
                    <div class="card-block">
                        <div style="padding: 10px;" class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Header</th>
                                        <th>Input</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>

                               
                                    <tr>
                                        <td>1</td>
                                        <td><strong>Nama</strong></td>
                                        <td>Huruf</td>
                                        <td>Contoh : Henry Augusta Harsono</td>
                                    </tr>
                                  

                                    <tr>
                                        <td>2</td>
                                        <td>Kontak Whatsapp</td>
                                        <td>String</td>
                                        <td>Contoh : 081320380666 , Boleh Dikosongkan</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Email</td>
                                        <td>String</td>
                                        <td>Contoh : ahmad_suadi@gmail.com  <strong>WAJIB , Digunakan Untuk Login</strong></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
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
    <script>
        function alertSuccess(message) {
            swal({
                icon: "success",
                message: message
            });
        }

    </script>
@endsection
