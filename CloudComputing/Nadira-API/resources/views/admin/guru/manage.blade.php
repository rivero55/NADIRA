@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Guru</h2>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Guru</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Manage Data Guru</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">
            <div class="customize-input float-right">

            </div>
        </div>
    </div>
@endsection

@section('page-wrapper')
    <div class="row">
        <div class="col-md-12">
            @include('components.message')
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- *************************************************************** -->
            <!-- Start First Cards -->
            <!-- *************************************************************** -->
            <div class="card-group">
                <div class="card border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 id="widgetCountSantri" class="text-dark mb-1 font-weight-medium">
                                        {{ $widget['countSantri'] }}</h2>

                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Jumlah Santri</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <h2 id="widgetCountAsatidz" class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                                    {{ $widget['countAsatidz'] }}
                                </h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Jumlah Asatidz
                                </h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 id="widgetCountSMA" class="text-dark mb-1 font-weight-medium">
                                        {{ $widget['countSMA'] }}</h2>

                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">SANTRI SMA</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- *************************************************************** -->
            <!-- End First Cards -->
            <!-- *************************************************************** -->
            <!-- *************************************************************** -->
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Data Guru</h4>
                    <h6 class="card-subtitle">
                        Daftar Asatidz Albinaa, Edit data dengan tombol di sisi kanan
                    </h6>

                    <button type="button" class="btn btn-outline-primary mb-2 btn-add-new">Tambah Data Asatidz</button>

                    <div class="table-responsive">
                        <table id="table_data" class="table table-hover table-success table-bordered display no-wrap"
                            style="width:100%">
                            <thead class="bg-success text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Asatidz</th>
                                    <th>Email Asatidz</th>
                                    <th>Nomor Whatsapp</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add New -->
    <div class="modal fade" id="insert-modal" tabindex="-1" role="dialog" aria-labelledby="insert-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-modalLabel">Tambah Data Guru Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_for_insert">
                    <div class="form-group">
                        <label for="name">Nama Ustadz</label>
                        <input type="hidden" required="" name="txt_in_name" class="form-control">
                        <input type="" required="" id="txt_in_name" placeholder="Nama Lengkap Asatidz" name="name"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email <strong>(Digunakan Untuk Login)</strong></label>
                        <input type="hidden" required="" class="form-control">
                        <input type="" required="" id="txt_in_email" placeholder="Email Asatidz" name="email"
                            class="form-control">
                        <small>Isi Dengan nama_ustadz@albinaa.com jika tidak ada email ustadz</small>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact Whatsapp</label>
                        <input type="hidden" required="" name="txt_in_contact" class="form-control">
                        <input type="" required="" id="txt_in_contact" placeholder="Kontak Whatsapp" name="contact"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="contact">Password Guru (min 6 karakter)</label>
                        <input type="hidden" required="" id="txt_in_password" name="txt_in_password" class="form-control">
                        <input type="" required="" id="contact" placeholder="Password Guru" name="contact"
                            class="form-control">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-insert">Tambah Data</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add New -->

    <!-- Destroy Modal -->
    <div class="modal fade" id="destroy-modal" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="destroy-modalLabel">Apakah Anda Yakin Ingin Menghapus Data Ustadz Ini ?</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Aksi Ini akan menghapus seluruh data yang terkait dengan asatidz terkait</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger btn-destroy">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Destroy Modal -->

    <!-- Reset Pass Modal -->
    <div class="modal fade" id="reset-password-modal" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="destroy-modalLabel">Reset Password</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Password Guru Akan Direset Menjadi AlbinaaIBS!</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger btn-reset">RESET</button>
                </div>
            </div>
        </div>
    </div>






@endsection


@section('app-script')
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/r-2.2.7/sb-1.0.1/sp-1.2.2/datatables.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js">
    </script>




    <script type="text/javascript">
        $(function() {
            var table = $('#table_data').DataTable({
                processing: true,
                serverSide: true,
                columnDefs: [{
                    orderable: true,
                    targets: 0
                }],
                dom: 'T<"clear">lfrtip<"bottom"B>',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                buttons: [
                    'copyHtml5',
                    {
                        extend: 'excelHtml5',
                        title: 'Data Santri Export {{ \Carbon\Carbon::now()->year }}'
                    },
                    'csvHtml5',
                ],
                ajax: {
                    type: "get",
                    url: "{{ url('admin/data/guru/manage') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    async: true,
                    error: function(xhr, error, code) {
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(err);
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },

                    {
                        data: 'contact',
                        name: 'contact'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                ]
            });

            $('body').on("click", ".btn-delete", function() {
                var id = $(this).attr("id")
                $(".btn-destroy").attr("id", id)
                $("#destroy-modal").modal("show")
            });


            $('body').on("click", ".btn-add-new", function() {
                var id = $(this).attr("id")
                $("#insert-modal").modal("show")
            });


            // Edit & Update
            $('body').on("click", ".btn-edit", function() {
                var id = $(this).attr("id")
                $.ajax({
                    url: "{{ URL::to('/') }}/mutabaah/" + id + "/fetch",
                    method: "GET",
                    success: function(response) {
                        $("#edit-modal").modal("show")
                        console.log(response)
                        $("#id").val(response.id)
                        $("#name").val(response.judul)
                        $("#edit_date").val(response.tanggal)
                        $("#role").val(response.role)
                    }
                })
            });

            // Reset Password
            $('body').on("click", ".btn-res-pass", function() {
                var id = $(this).attr("id")
                $(".btn-reset").attr("id", id)
                $("#reset-password-modal").modal("show")
            });

        });


        $(".btn-destroy").on("click", function() {
            var id = $(this).attr("id")
            console.log(id);
            $.ajax({
                url: "{{ URL::to('/') }}/guru/" + id + "/adminDelete",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "user_id": {{ Auth::guard('admin')->user()->id }},
                    "id": id,
                },
                method: "DELETE",
                success: function(response) {
                    console.log(response);
                    $("#destroy-modal").modal("hide")
                    $("#widgetCountaAsatidz").text(response.countSMA)
                    $('#table_data').DataTable().ajax.reload();

                    if (response == 0) {
                        swal("Error", "Gagal Menghapus Data Guru ", "error");
                    } else {
                        $('#widgetCountAsatidz').text(response.toString())
                        swal("Sukses", "Berhasil Menghapus Data Ustadz ", "success");
                        

                    }
                    $("#insert-modal").modal("hide")

                },
                error: function(xhr, error, code) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(error);
                    console.log(err);
                    swal("Error", "Gagal Menghapus Data Guru ", "error");
                }
            });
        })


        $(".btn-insert").on("click", function() {

            let in_name = $('#txt_in_name').val();
            let in_email = $('#txt_in_email').val();
            let in_password = $('#txt_in_password').val();
            let in_contact = $('#txt_in_contact').val();

            let in_error = false;

            if (in_name == null) {
                console.log("error_name")
                in_error = true;
            }

            if (in_email == null) {
                console.log("error_contact")
                in_error = true;
            }

            if (in_contact == null) {
                console.log("error_contact")
                in_error = true;
            }

            if (in_error == true) {
                swal("Afwan", "Mohon Melengkapi Form Input Guru Terlebih Dahulu ", "error");
            } else {

                $.ajax({
                    url: "{{ URL::to('/') }}/guru/adminInsert",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": in_name,
                        "contact": in_contact,
                        "email": in_email,
                        "password": in_password,
                    },
                    method: "POST",
                    success: function(response) {
                        console.log(response);
                        if (response == 0) {
                            swal("Error", "Gagal Menambah Data Guru ", "error");
                        } else {
                            $('#table_data').DataTable().ajax.reload();
                            $('#widgetCountAsatidz').text(response.toString())
                            swal("Sukses", "Berhasil Menambah Data Guru ", "success");
                        }
                        $("#insert-modal").modal("hide")
                    },
                    error: function(xhr, error, code) {
                        $('#table_data').DataTable().ajax.reload();
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(error);
                        console.log(err);
                        swal("Error", "Gagal Menambah Data Guru ", "error");
                    }
                });

            }
        })


        $(".btn-reset").on("click", function() {
            var id = $(this).attr("id")
            console.log(id);
            $.ajax({
                url: "{{ URL::to('/') }}/guru/" + id + "/resetPassword",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "user_id": {{ Auth::guard('admin')->user()->id }},
                    "id": id,
                },
                method: "POST",
                success: function(response) {
                    console.log(response);
                    $("#edit-modal").modal("hide")
                    $('#table_data').DataTable().ajax.reload();
                    swal("Sukses", "Berhasil Mengupdate Password Guru ", "success");
                },
                error: function(xhr, error, code) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(error);
                    console.log(err);
                    swal("Error", "Gagal Mengupdate Password Guru ", "error");
                }
            });
        })

    </script>




@endsection
