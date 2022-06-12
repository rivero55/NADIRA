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
                            <h1 class="text-dark">Laporan Agenda Mutabaah</h1>
                            <h1 class="text-dark">{{$widget['mutabaah']->tanggal}}</h1>
                            <div class="mt-2 mb-2">
                                <a href="{{ url()->previous()}}">
                                    <button type="button" class="btn btn-outline-primary">Kembali</button>
                                </a>
                            </div>
                          

                            <ul>
                                <li>Nama Santri : {{ Auth::guard('santri')->user()->nama }}</li>
                                <li>NISN : {{ Auth::guard('santri')->user()->nis }}</li>
                                <li>Kelas : {{ Auth::guard('santri')->user()->kelas }}</li>
                                <li>Asrama : {{ Auth::guard('santri')->user()->asrama }}</li>
                                <li> <strong> Nama Agenda : {{ $widget['mutabaah']->judul }} </strong></li>
                                <li> <strong> Tanggal : {{ $widget['mutabaah']->tanggal }} </strong></li>
                            </ul>

                            <div class="mt-2 mb-2">
                                <a href="{{route('santri.mutabaah.export.daily',['santri_id' => Auth::guard('santri')->id() , "mutabaah_id"=>$widget['mutabaah']->id])}}">
                                    <button type="button" class="btn btn-success btn-lg btn-rounded">
                                        <i class="fas fa-file-excel"></i> Download Laporan Excel</button>
                                  
                                </a>
                            </div>

                        </div>

                      

                    </div>
                    <div class="table-responsive">
                        <table id="table_data" class="table table-striped table-bordered no-wrap">

                            <thead>
                           
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Nilai Asli Kegiatan</th>
                                    <th>Nilai Siswa</th>
                                    <th>Status</th>
                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($widget['recordMutabaah'] as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- <td>{{ $item->activity->nama_kegiatan }}</td> --}}
                                        <td>{{ $item['activityName']}}</td>
                                        <td>{{ $item['poin'] }}</td>
                                        {{-- <td>{{ $item->activity->poin }}</td> --}}
                                        <td>
                                            @if ($item['status'] == 0)
                                                {{ $item['poin'] }}
                                            @endif

                                            @if ($item['status'] == 1)
                                                0
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item['status'] == 0)
                                                <button type="button" class="btn btn-block btn-danger btn-rounded"><i
                                                        class="fas fa-times-circle"></i> Tidak Dilakukan</button>
                                            @endif

                                            @if ($item['status'] == 1)
                                                <button type="button" class="btn btn-block btn-success btn-rounded"><i
                                                        class="fas fa-check-circle"></i> Ya</button>
                                            @endif

                                        </td>
                                    </tr>
                                @empty

                                @endforelse

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
