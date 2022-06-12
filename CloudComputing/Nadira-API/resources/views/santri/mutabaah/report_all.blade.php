@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Mutaba'ah Yaumiyah</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Mutaba'ah</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Input</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">

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
                    <div class="row">
                        <div class="col-12">
                            <h1 class="text-dark">Laporan Seluruh Lembar Mutabaah</h1>
                            <h4 class="text-dark">Fitur ini hanya dapat digunakan jika semua Mutaba'ah Memiliki Kegiatan
                                Yang Serupa dan Sama</h4>
                            <div class="mt-2 mb-2">
                                <button type="button" data-toggle="modal" data-target="#modelId"
                                    class="btn btn-success btn-lg btn-rounded">
                                    <i class="fas fa-file-excel"></i> Download Laporan Excel</button>
                            </div>


                            <!-- Modal -->
                            <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Export Laporan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form
                                                action="{{ route('santri.mutabaah.export.all', ['santri_id' => Auth::guard('santri')->id()]) }}"
                                                method="get">

                                                <input type="hidden" name="santri_id" value="{{Auth::guard('santri')->id()}}">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Tanggal Mulai</label>
                                                            <input type="date"
                                                                class="form-control @error('start') is-invalid  @enderror"
                                                                name="tanggal_mulai" value="{{ $widget['start'] }}" id="">
                                                            <small class="form-text text-muted">Tanggal Mulai</small>
                                                        </div>
                                                    </div>



                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Tanggal Selesai</label>
                                                            <input type="date"
                                                                class="form-control @error('end') is-invalid  @enderror"
                                                                value="{{ $widget['end'] }}" name="tanggal_selesai" id="">
                                                            <small class="form-text text-muted">Tanggal Selesai</small>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 ">
                                                        <button type="submit" class="btn btn-outline-primary">Download File
                                                            Laporan</button>
                                                        <hr>
                                                    </div>

                                                </div>

                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <form action="{{ route('santri.mutabaah.see_report_all') }}" method="get">

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Tanggal Mulai</label>
                                            <input type="date"
                                                class="form-control @error('start') is-invalid  @enderror"" name=" start"
                                                value="{{ $widget['start'] }}" id="">
                                            <small class="form-text text-muted">Tanggal Mulai</small>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Tanggal Selesai</label>
                                            <input type="date" class="form-control @error('end') is-invalid  @enderror"
                                                value="{{ $widget['end'] }}" name="end" id="">
                                            <small class="form-text text-muted">Tanggal Selesai</small>
                                        </div>
                                    </div>

                                    <div class="col-md-12 ">
                                        <button type="submit" class="btn btn-outline-primary">Tampilkan Laporan</button>
                                        <hr>
                                    </div>

                                </div>
                            </form>




                            <ul>
                                <li>Nama Santri : {{ Auth::guard('santri')->user()->nama }}</li>
                                <li>NISN : {{ Auth::guard('santri')->user()->nis }}</li>
                                <li>Kelas : {{ Auth::guard('santri')->user()->kelas }}</li>
                                <li>Asrama : {{ Auth::guard('santri')->user()->asrama }}</li>
                            </ul>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="table_data" class="table table-striped table-bordered no-wrap">

                            <thead>

                                <tr>
                                    <th>No</th>
                                    <th>Nama Kegiatan</th>
                                    @forelse ($widget['mutabaah'] as $item)
                                        <th>{{ $item->judul . '/' . $item->tanggal }}</th>
                                    @empty

                                    @endforelse
                                </tr>

                            </thead>

                            <tbody>

                                @php
                                    $counter = 0;
                                    $skor = 0;
                                @endphp
                                @forelse ($widget['activity'] as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_kegiatan }}</td>
                                        @forelse ($widget['mutabaah'] as $itemMutabaah)
                                            <td>
                                                @if ($widget['activityScore'][$itemMutabaah->id][$counter]->status == 0)
                                                    <button type="button" class="btn btn-block btn-danger btn-rounded"><i
                                                            class="fas fa-times-circle"></i> Tidak </button>
                                                    @php
                                                        $skor += $itemMutabaah->poin;
                                                    @endphp
                                                @endif
                                                @if ($widget['activityScore'][$itemMutabaah->id][$counter]->status == 1)
                                                    <button type="button" class="btn btn-block btn-success btn-rounded"><i
                                                            class="fas fa-times-circle"></i> Ya </button>
                                                @endif
                                            </td>
                                        @empty

                                        @endforelse
                                        {{-- @foreach ($widget['activityScore'][$widget['mutabaah'][$loop->iteration - 1]->id] as $itemz)
                                        <td>{{ $itemz}}</td>
                                        @endforeach --}}
                                    </tr>

                                    @php
                                        $counter++;
                                    @endphp

                                @empty


                                @endforelse

                                {{-- <tr>
                                    <td colspan="2">Total Skor : {{ $skor }} </td>
                                </tr> --}}

                            </tbody>
                        </table>

                    </div>
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
                serverSide: false,
                paginate: false,
                columnDefs: [{
                    orderable: true,
                    targets: 0
                }],
                dom: 'lrtipB',
                "lengthMenu": [
                    [-1],
                    ["All"]
                ],
                buttons: [
             
                ],

            });




        });

    </script>




@endsection
