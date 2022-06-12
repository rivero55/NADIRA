@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Santri</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Santri</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Manage Data Santri</li>
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
                                        {{ $widget['countGroup'] }} </h2>

                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Jumlah Kelompok</h6>
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
                                    <h2 id="widgetCountGuru" class="text-dark mb-1 font-weight-medium">
                                        {{ $widget['countGuru'] }} </h2>

                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Jumlah Pembimbing</h6>
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
                    <h4 class="card-title">Manage Kelompok Tahfidz</h4>
                    <h6 class="card-subtitle">
                        Daftar Kelompok Tahfidz, Edit data dengan tombol di sisi kanan
                    </h6>
                    <div class="table-responsive">
                        <table id="table_group" class="table table-hover table-success table-bordered display no-wrap"
                            style="width:100%">
                            <thead class="bg-success text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelompok</th>
                                    <th>Pembimbing</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if ($widget['group'] != null)
                                    @forelse ($widget['group'] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_kelompok }}</td>
                                            <td>{{ $item->g_name }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <button id="{{ $item->id }}" type="button"
                                                        class="btn btn-change-mentor btn-primary mr-2">Ganti
                                                        Pembimbing</button>
                                                    <button id="{{ $item->id }}" type="button"
                                                        class="btn btn-danger btn-delete mr-2">Hapus
                                                        Kelompok</button>
                                                    <a href='{{url("group/$item->id/detail")}}'>
                                                        <button type="button" class="btn btn-outline-primary mr-2">
                                                            Lihat Detail</button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty

                                @endforelse

                                @endif

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
        <div class="modal-dialog" role="document">
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
            <form action="{{url('/group/delete')}}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" class="ind-group-id" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="destroy-modalLabel">Apakah Anda Yakin Ingin Menghapus Kelompok Ini ?
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Aksi Ini akan menghapus seluruh data setoran siswa dan data halaqoh lainnya yang berkaitan
                            dengan kelompok ini</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger btn-destroy">Hapus</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <!-- Change Mentor Modal -->
    <div class="modal fade" id="change-mentor-modal" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ url('group/change_mentor') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" class="ind-group-id" name="group_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="destroy-modalLabel">Ganti Pembimbing Halaqoh</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Pilih Pembimbing Baru Untuk Kelompok</label>
                            <select class="form-control" name="mentor_id" id="">
                                @forelse ($widget['guru'] as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @empty

                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-save-change-mentor"
                            data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Ganti Pembimbing</button>
                    </div>
                </form>

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
            var table = $('#table_group').DataTable({
                processing: true,
                serverSide: false,
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
                        title: 'Data Kelompok Tahfidz Export {{ \Carbon\Carbon::now()->year }}'
                    },
                    'csvHtml5',
                ],

            });

            $('body').on("click", ".btn-delete", function() {
                var id = $(this).attr("id")
                $(".ind-group-id").val(id)
                $(".btn-destroy").attr("id", id)
                $("#destroy-modal").modal("show")
            });

            $('body').on("click", ".btn-change-mentor", function() {
                var id = $(this).attr("id")
                $(".btn-destroy").attr("id", id)
                $(".ind-group-id").val(id)
                $("#change-mentor-modal").modal("show")
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
            // Reset Password
            $('body').on("click", ".btn-res-pass", function() {
                var id = $(this).attr("id")
                $(".btn-reset").attr("id", id)
                $("#reset-password-modal").modal("show")
            });

        });



        $(".btn-reset").on("click", function() {
            var id = $(this).attr("id")
            console.log(id);
            $.ajax({
                url: "{{ URL::to('/') }}/santri/" + id + "/resetPassword",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "user_id": {{ Auth::guard('admin')->user()->id }},
                    "id": id,
                },
                method: "POST",
                success: function(response) {
                    console.log(response);
                    $("#edit-modal").modal("hide")
                    $('#table_santri').DataTable().ajax.reload();
                    swal("Sukses", "Berhasil Mengupdate Password Santri ", "success");
                },
                error: function(xhr, error, code) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(error);
                    console.log(err);
                    swal("Error", "Gagal Mengupdate Password Santri ", "error");
                }
            });
        })

    </script>




@endsection
