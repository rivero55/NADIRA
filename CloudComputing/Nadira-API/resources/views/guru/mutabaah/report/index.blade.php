@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Mutaba'ah</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Mutaba'ah</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Report</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Seluruh Santri</li>
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

        <div class="col-md-12">
            <div class="card">
                <div class="">
                    <div class="row">
                        <div class="col-lg-3 border-right pr-0">
                            <div class="card-body border-bottom">
                                <h4 class="card-title mt-2">Download Laporan Mutaba'ah</h4>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="calendar-events" class="">

                                            <div class="calendar-events mb-3" data-class="bg-danger">
                                                <i class="fa fa-circle text-danger mr-2"></i>
                                                Pilih rentang tanggal dengan urutan aktivitas di mutabaah yang serupa dan
                                                sama
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-lg-9 p-4">
                            <form action="{{ route('guru.mutabaah.search_filter_all') }}" method="post">
                                @csrf
                                @method('POST')

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Agenda Mutaba'ah Yang Ingin Ditampilkan</label>
                                            <select class="form-control" required name="agenda_id" id="">
                                                <option value="">Pilih Agenda Mutaba'ah</option>
                                                @foreach ($widget['mutabaah'] as $item)
                                                    <option @if ($widget['currentMutabaah'] != null) {{ $item->id == $widget['currentMutabaah']->id ? 'selected' : '' }} @endif value="{{ $item->id }}">

                                                        {{ $item->tanggal }} :
                                                        {{ $item->judul }}

                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                 
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Filter Kelompok</label>
                                            <select class="form-control" required name="kelompok_id" id="">
                                                <option value="">Pilih Kelompok</option>
                                                @foreach ($widget['kelompok'] as $item)

                                                <option 
                                                @if ($widget['kelompokCurrent'] != null)
                                                 {{ $item->id == $widget['kelompokCurrent'] ? 'selected' : '' }} @endif value="{{ $item->id }}">
                                                 {{$item->nama_kelompok}}
                                                </option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-12 ">
                                        <button type="submit" class=" btn btn-rounded btn-outline-success btn-block">
                                            Tampilkan Laporan
                                        </button>
                                        <hr>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Data Laporan Mutaba'ah : </h2>
                    <h2 class="card-title">
                        @if ($widget['currentMutabaah'] != null)
                            {{ $widget['currentMutabaah']->judul }}
                        @endif
                    </h2>
                    <h3 class="card-title">
                        @if ($widget['currentMutabaah'] != null)
                            Tanggal : {{ $widget['currentMutabaah']->tanggal }}
                        @endif
                    </h3>
                    <hr>
                    <h6 class="card-subtitle">
                    </h6>
                    <div class="table-responsive">
                        <table id="table_record" class="table table-hover table-primary table-bordered no-wrap"
                            style="width:100%">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Santri</th>
                                    <th>NIS</th>
                                    <th>Kelas</th>
                                    <th>Asrama</th>
                                    @if ($widget['activities'] != null)
                                        @forelse ($widget['activities'] as $item)
                                            <th>{{ $item->nama_kegiatan }}</th>
                                        @empty
                                            <th>Pilih Lembar Mutaba'ah Yang Ingin Ditampilkan </th>
                                    @endforelse
                                    @endif
                                </tr>
                            </thead>
                            <tbody>


                                @forelse ($widget['recordSantri'] as $item)
                                    <tr>
                                        @php
                                            $zep = $loop->iteration;
                                        @endphp
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- <td colspan="5">{{ dd($widget['recordSantri']) }}</td> --}}
                                        <td>{{ $item['santri_name'] }}</td>
                                        <td>{{ $item['santri_nis'] }}</td>
                                        <td>{{ $item['santri_kelas'] }}</td>
                                        <td>{{ $item['santri_asrama'] }}</td>
                                        @forelse ($item['record'] as $itemz)
                                            <td>
                                                @if ($itemz->status == 0)
                                                    <button type="button" class="btn btn-danger btn-rounded"><i
                                                            class="fas fa-times-circle"></i> Tidak Dilakukan</button>
                                                @endif

                                                @if ($itemz->status == 1)
                                                    <button type="button" class="btn btn-primary btn-rounded"><i
                                                            class="fas fa-check-circle"></i> Ya</button>
                                                @endif
                                            </td>

                                        @empty
                                            <td colspan="5">
                                                <button type="button" class="btn btn-block btn-warning btn-rounded">
                                                    SISWA TIDAK MENGISI MUTABA'AH
                                                </button>
                                            </td>
                                        @endforelse
                                    </tr>
                                    </tr>
                                @empty

                                @endforelse


                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

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
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ count($widget['recordSantri']) }}
                                    </h2>

                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">SANTRI MENGISI MUTABA'AH
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
                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                                    {{ count($widget['santriNotFill']) }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">SANTRI TIDAK MENGISI
                                </h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 font-weight-medium">{{ count($widget['activities']) }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Jumlah Aktivitas Yang
                                    Dinilai </h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- *************************************************************** -->
            <!-- End First Cards -->
            <!-- *************************************************************** -->

        </div>

        <!-------START OF MY SOPHISTICATED STATISTIC WIDGET --------->
        <!-------START OF MY SOPHISTICATED STATISTIC WIDGET --------->
        <div class="col-12">
            <div class="card">
                <img class="card-img-top" src="holder.js/100x180/" alt="">
                <div class="card-body">
                    <h4 class="card-title">Santri Yang Tidak Mengisi Mutaba'ah</h4>
                    <div class="table-responsive">
                        <table id="table_record_nf" class="table table-hover table-warning table-bordered no-wrap"
                            style="width:100%">
                            <thead class="bg-warning text-white">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>Kelas</th>
                                    <th>Asrama</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($widget['santriNotFill'] != null)
                                    @forelse ($widget['santriNotFill'] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->nis }}</td>
                                            <td>{{ $item->kelas }}</td>
                                            <td>{{ $item->asrama }}</td>
                                        </tr>
                                    @empty

                                @endforelse
                                @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-------END OF MY SOPHISTICATED STATISTIC WIDGET --------->
        <!-------END OF MY SOPHISTICATED STATISTIC WIDGET --------->







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
    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3/dist/chart.min.js"></script>



    <script type="text/javascript">
        $(function() {
            var tableNotFill = $('#table_record_nf').DataTable({
                searching: true,
                dom: 'Tf<"clear">lrtip<"bottom"B>',
                buttons: [{
                        extend: 'excelHtml5',
                        title: 'Data export'
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'A1',
                        title: 'Data export'
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'Data export'
                    },
                ],

            });

      

        });

    


    </script>

    @include('admin.mutabaah.report.script')





@endsection
