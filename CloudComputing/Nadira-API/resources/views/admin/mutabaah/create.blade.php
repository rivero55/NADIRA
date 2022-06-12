@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Mutaba'ah</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Mutaba'ah</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Buat Agenda Mutaba'ah</li>
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
    <div class="row">
        <form class="row" action="{{ url('/mutabaah/store') }}" method="post">


            <div class="col-md-12">
                @include('components.message')
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="">
                        <div class="row">
                            <div class="col-lg-3 border-right pr-0">
                                <div class="card-body border-bottom">
                                    <h4 class="card-title mt-2">Buat Agenda Mutaba'ah Baru</h4>
                                </div>
                                <div class="card-body">

                                </div>
                            </div>
                            <div class="col-lg-9 p-4">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nama Agenda Mutabaah</label>
                                    <input type="text" class="form-control" required name="judul" id=""
                                        aria-describedby="helpId" placeholder="Judul Mutabaah (Opsional)">
                                    <small class="form-text text-muted">Judul Mutabaah</small>
                                </div>

                                <div class="form-group">
                                    <label for="">Tanggal Mutaba'ah</label>
                                    <input type="date" required class="form-control" name="tanggal" id=""
                                        aria-describedby="input_date" placeholder="">
                                    <small id="input_date" class="form-text text-muted">Klik Logo Calendar untuk memilih
                                        tanggal</small>
                                    <small id="input_date2" class="form-text text-muted">Mutabaah hanya dapat diakses pada
                                        tanggal terkait</small>
                                </div>


                                <div class="form-group">
                                    <label for="">Status Mutaba'ah</label>
                                    <select required class="form-control" name="status" id="">
                                        <option value="1">Dibuka</option>
                                        <option value="0">Ditutup</option>
                                        <option value="3">Pending</option>
                                    </select>
                                </div>

                                <input type="hidden" name="user_id" value="{{ Auth::guard('admin')->user()->id }}">


                            </div>


                        </div>



                    </div>
                </div>


            </div>

            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <h2 class="card-title">Kegiatan Yang Dinilai</h2>
                        <h4 class="card-subtitle">
                            Tambahkan Kegiatan Yang Akan Dinilai Beserta Poin Kegiatan
                        </h4>
                        <h4>
                            Total Skor Kegiatan (Max 100) = <span id="totalSkor"></span>
                        </h4>

                        <div class="container row mb-4">
                            <div class=" col-12 col-md-6">
                                <label for="">Nama Kegiatan</label>
                                <input type="text" class="form-control" name="" id="fName" aria-describedby="helpId"
                                    placeholder="Nama Kegiatan">
                                <small id="helpId" class="form-text text-muted">Nama Kegiatan</small>
                            </div>
                            <div class=" col-12 col-md-6">
                                <label for="">Jumlah Poin</label>
                                <input type="number" class="form-control" name="" id="fPoin" aria-describedby="helpId"
                                    placeholder="Poin Kegiatan">
                                <small id="" class=" form-text text-muted">Masukkan Jumlah Poin Kegiatan</small>
                            </div>
                        </div>

                        <button onclick="addRow()" type="button" class="col-6 btn btn-rounded btn-primary mb-4">
                            Tambah Kegiatan ke Agenda
                        </button>

                        <button onclick="addDefaultRow()" type="button" class="col-6 btn btn-rounded btn-outline-primary mb-4">
                            Input Agenda dari Template
                        </button>

                        <div class="table-responsive">
                            <table id="tableActivity" class="table table-hover table-success table-bordered display no-wrap"
                                style="width:100%">
                                <thead class="bg-success text-white">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Poin</th>
                                        <th>Batal</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>

                                    </tr>

                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <button type="submit" class=" btn btn-rounded btn-outline-success btn-block">
                            Input Agenda Mutabaah
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection


@section('app-script')
    <script>
        let totalPoin = 0;
        let fNumber = 0;

        function addRowManually(name, poin) {
            let error = false;
            if (totalPoin + poin > 100) {
                error = true
                swal("Error", "Maksimum Poin adalah 100 ", "error");
            }

            if (name == "" || poin == "") {
                error = true
                swal("Error", "Lengkapi Nama Kegiatan dan Poin Terlebih Dahulu ", "error");
            }

            if (error == false) {
                fNumber++;
                totalPoin += poin;

                $("#totalSkor").html("");
                $('#totalSkor').text(totalPoin);

                $("#tableActivity").find('tbody')
                    .append($('<tr>')
                        .append($('<td>')
                            .append($('  <input type="text" class="form-control" name="activityName[]"  value="' +
                                name + '" placeholder="">'))
                        )
                        .append($('<td>')
                            .append($('<h4 class="poinKeg">')
                                .append($(
                                    '  <input type="text" class="form-control" readonly name="activityPoin[]"  value="' +
                                    poin + '" placeholder="">'))
                            )
                        )
                        .append($('<td>')
                            .append($('<button type="button" onclick="decPoin(' + poin +
                                    ')" class="btn btn-primary razBtn">')
                                .text("Hapus Kegiatan")
                            )
                        )
                    );

                $('button.razBtn').on('click', function() {
                    $(this).closest("tr").remove();
                })
            }
        }

        function addRow() {
            const name = $('#fName').val();
            const poin = parseInt($('#fPoin').val());

            let error = false;

            if (totalPoin + poin > 100) {
                error = true
                swal("Error", "Maksimum Poin adalah 100 ", "error");
            }

            if (name == "" || poin == "") {
                error = true
                swal("Error", "Lengkapi Nama Kegiatan dan Poin Terlebih Dahulu ", "error");
            }

            if (error == false) {
                fNumber++;
                totalPoin += poin;

                $("#totalSkor").html("");
                $('#totalSkor').text(totalPoin);

                $("#tableActivity").find('tbody')
                    .append($('<tr>')
                        .append($('<td>')
                            .append($('  <input type="text" class="form-control" name="activityName[]"  value="' +
                                name + '" placeholder="">'))
                        )
                        .append($('<td>')
                            .append($('<h4 class="poinKeg">')
                                .append($(
                                    '  <input type="text" class="form-control" readonly name="activityPoin[]"  value="' +
                                    poin + '" placeholder="">'))
                            )
                        )
                        .append($('<td>')
                            .append($('<button type="button" onclick="decPoin(' + poin +
                                    ')" class="btn btn-primary razBtn">')
                                .text("Hapus Kegiatan")
                            )
                        )
                    );

                $('button.razBtn').on('click', function() {
                    $(this).closest("tr").remove();
                })
            }
        }


        function addDefaultRow() {
            addRowManually("Makan Sahur",5);
            addRowManually("Sholat Shubuh",8);
            addRowManually("Tilawah Setelah Sholat Shubuh",2);
            addRowManually("Membaca Dzikir Pagi",4);
            addRowManually("Sholat Syuruq",4);
            addRowManually("Sholat Dhuha",4);
            addRowManually("Sholat Dzuhur",8);
            addRowManually("Tilawah Setelah Sholat Dzuhur",2);
            addRowManually("Sholat Ashar",8);
            addRowManually("Tilawah Setelah Sholat Ashar",2);
            addRowManually("Birrul Walidain",7);
            addRowManually("Membaca Dzikir Petang",4);
            addRowManually("Olahraga",4);
            addRowManually("Bersedekah / Memberi Makan Untuk Orang Berbuka",5);
            addRowManually("Membaca Buku/Kitab/Muroja'ah Pelajaran",4);
            addRowManually("Sholat Maghrib",8);
            addRowManually("Tilawah Setelah/Sebelum Sholat Maghrib",2);
            addRowManually("Shalat Isya",8);
            addRowManually("Sholat Tarawih",5);
            addRowManually("Tilawah Setelah Sholat Tarawih",2);
            addRowManually("Sholat Sunnah Rawatib",4);
            swal("Alhamdulillah", "Berhasil Menambahkan Kegiatan", "success");
        }

    </script>

    @include('admin.mutabaah.script_default')


@endsection
