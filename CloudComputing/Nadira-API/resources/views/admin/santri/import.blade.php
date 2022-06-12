@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Santri</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Import</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">
            <div class="customize-input float-right">
                <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                    <option selected>Aug 19</option>
                    <option value="1">July 19</option>
                    <option value="2">Jun 19</option>
                </select>
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
                        <h4 class="mb-0 ">Upload Data Santri (CSV)</h4>
                    </div>

                    <div class="card-body">
                        <p class="card-text"></p>
                        <form class="form" action="{{ route('import_santri') }}" method="post"
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
                <div class="card  card-accent-primary">
                    <div class="card-header card-header-inverse">
                        <p class="card-title title-collapse">Format File CSV Mentee</p>
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
                                        <td><strong>NIS</strong></td>
                                        <td>Angka</td>
                                        <td>Contoh : 1301140171</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><strong>Nama</strong></td>
                                        <td>Huruf</td>
                                        <td>Contoh : Henry Augusta Harsono</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><strong>Kelas</strong></td>
                                        <td>Kode Kelas</td>
                                        <td>Contoh : 7B</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><strong>Asrama</strong></td>
                                        <td>String - Nama Fakultas</td>
                                        <td>Contoh : MADINAH</td>
                                    </tr>

                                    <tr>
                                        <td>5</td>
                                        <td><strong>JK</strong></td>
                                        <td>"Pria"/"Laki-laki" atau "Wanita"/"Perempuan"</td>
                                        <td>Format Header harus JK !, selain format diatas ditolak</td>
                                    </tr>

                                    <tr>
                                        <td>6</td>
                                        <td>no_telp</td>
                                        <td>String</td>
                                        <td>Contoh : 081320380666 , Boleh Dikosongkan</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Line_id</td>
                                        <td>String</td>
                                        <td>Contoh : henryaugusta , Boleh Dikosongkan</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>

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
