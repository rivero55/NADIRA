<div class="table-responsive">
    <table id="table_data" class="table table-striped table-bordered no-wrap">

        <thead>
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
                                <button type="button" class="btn btn-block btn-primary btn-rounded"><i
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