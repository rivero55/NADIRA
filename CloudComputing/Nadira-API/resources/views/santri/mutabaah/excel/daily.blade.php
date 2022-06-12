<div class="table-responsive">
    <table id="table_data" class="table table-striped table-bordered no-wrap">

        <thead>
            <tr>
                <th colspan="5">Judul Mutaba'ah  : {{$widget['mutabaah']->judul}}</th>
            </tr>
            <tr>
                <th colspan="5">Tanggal  : {{$widget['mutabaah']->tanggal}}</th>
            </tr>
            <tr>
                <th colspan="5">Nama Siswa  : {{$widget['santri']->nama}}</th>
            </tr>
            <tr>
                <th colspan="5">NIS  : {{$widget['santri']->nis}}</th>
            </tr>
            <tr>
                <th colspan="5">Asrama  : {{$widget['santri']->asrama}}</th>
            </tr>
            <tr>
                <th colspan="5">Kelas  : {{$widget['santri']->kelas}}</th>
            </tr>
       
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