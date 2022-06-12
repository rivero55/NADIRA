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
                <h4>Test</h4>
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
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Mutaba'ah</h4>
                    <h6 class="card-subtitle">
                        Data Agenda Mutaba'ah Yang Dapat Diisi Oleh Santri, Edit dan Hapus Agenda dengan tombol yang berada
                        di sisi kanan tabel
                    </h6>
                    <div class="table-responsive">
                        <table id="table_mutabaah" class="table table-striped table-bordered display no-wrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Dibuat Oleh</th>
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

    <!-- Modal Edit -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-modalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">

                        <div class="form-group">
                            <label for="name">Judul/Nama Agenda Mutaba'ah</label>
                            <input type="hidden" required="" id="id" name="id" class="form-control">
                            <input type="" required="" id="name" placeholder="Judul Agenda Mutaba'ah" name="name"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="edit_datetime">Tanggal Mutaba'ah</label>
                            <input type="date" required="" id="edit_date" name="edit_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Ganti Status Mutaba'ah</label>
                            <select class="form-control" required name="status" id="new_status">
                                <option value="">Pilih Status</option>
                                <option value="1">Dibuka</option>
                                <option value="0">Ditutup</option>
                                <option value="3">Pending</option>
                            </select>
                        </div>

                        <div class="table-responsive">
                            <table id="tableActivity" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kegiatan</th>
                                        <th>Poin</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-update">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edit -->

    <!-- Destroy Modal -->
    <div class="modal fade" id="destroy-modal" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="destroy-modalLabel">Apakah Anda Yakin Ingin Menghapus Agenda Ini ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger btn-destroy">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Destroy Modal -->






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
            var table = $('#table_mutabaah').DataTable({
                processing: true,
                serverSide: true,
                dom: 'lrtipB',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                ],
                ajax: {
                    type: "POST",
                    url: "{{ url('admin/data/mutabaah/manage') }}",
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
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },

                    {
                        render: function(datum, type, row) {
                            console.log(row.status);
                            let html = "";
                            switch (row.status) {
                                case 1:
                                    html = '<h5 class="badge badge-success">' + 'Dibuka' + '</h5>';
                                    break;
                                case 0:
                                    html = '<h5 class="badge badge-warning">' + 'Ditutup' + '</h5>';
                                    break;
                                case 3:
                                    html = '<h5 class="badge badge-danger">' + 'Pending' + '</h5>';
                                    break;
                                default:
                                    html = '<h5 class="badge badge-primary">' + 'Tidak Diketahui' +
                                        '</h5>';
                                    break;
                            }
                            return html;
                        }
                    },
                    {
                        data: 'created_byz',
                        name: 'created_byz',
                        orderable: true,
                        searchable: true
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


            // Edit & Update
            $('body').on("click", ".btn-edit", function() {
                var id = $(this).attr("id")
                $.ajax({
                    url: "{{ URL::to('/') }}/mutabaah/" + id + "/fetch",
                    method: "GET",
                    success: function(response) {
                        console.log(response.toString());
                        $("#edit-modal").modal("show")
                        console.log(response)
                        $("#id").val(response.data.id)
                        $("#name").val(response.data.judul)
                        $("#edit_date").val(response.data.tanggal)

                        $("#tableActivity > tbody").html("");
                        response.activity.forEach(element => {
                            $("#tableActivity").find('tbody')
                                .append($('<tr>')
                                    .append($('<td>')
                                        .append($('<div>' + element.nama_kegiatan +
                                            '</div>'))
                                    )
                                    .append($('<td>')
                                        .append($('<div>' + element.nama_kegiatan +
                                            '</div>'))
                                    )
                                    .append($('<td>')
                                        .append($('<div>' + element.poin + '</div>'))
                                    )
                                );
                        });
                    }
                })
            });

        });

        $("#editForm").on("submit", function(e) {
            e.preventDefault()
            var id = $("#id").val()
            var judul = $("#name").val()
            var tanggal = $("#edit_date").val()
            var status = $("#new_status").val()
            $.ajax({
                url: "{{ URL::to('/') }}/mutabaah/" + id + "/updateAjax",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "judul": judul,
                    "tanggal": tanggal,
                    "status": status,
                },
                success: function(result, status, xhr) {
                    console.log(result);
                    $('#table_mutabaah').DataTable().ajax.reload();
                    $("#edit-modal").modal("hide")
                    swal("Alhamdulillah", "Berhasil Mengupdate Mutaba'ah", "success");
                },
                error: function(xhr, error, code) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err);
                    alert(err.toString());
                    swal("Error", "Gagal Mengupdate Mutaba'ah", "error");
                }
            })
        })

        $(".btn-destroy").on("click", function() {
            var id = $(this).attr("id")
            $.ajax({
                url: "{{ URL::to('/') }}/mutabaah/" + id + "/deleteAjax",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "user_id": {{ Auth::guard('admin')->user()->id }},
                    "id": id,
                },
                method: "DELETE",
                success: function() {
                    $("#destroy-modal").modal("hide")
                    $('#table_mutabaah').DataTable().ajax.reload();
                },
                error: function(xhr, error, code) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err);
                    swal("Error", "Gagal Mengupdate Mutaba'ah " + err.toString, "error");
                }
            });
        })

    </script>




@endsection
