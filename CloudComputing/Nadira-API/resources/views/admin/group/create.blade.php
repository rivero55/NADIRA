@extends('main.app')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
@endsection

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Kelompok Tahfidz</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Kelompok Tahfidz</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Buat Kelompok Baru</li>
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

        <div class="col-md-12">
            <div class="card">
                <div class="">
                    <div class="row">
                        <div class="col-lg-3 border-right pr-0">
                            <div class="card-body border-bottom">
                                <h4 class="card-title mt-2">Buat Kelompok Tahfidz Baru</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 p-4">
                            <form action="{{ url('/group/store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nama Kelompok Tahfidz</label>
                                    <input type="text" class="form-control" name="name" id="" aria-describedby="helpId"
                                        placeholder="Nama Kelompok Tahfidz" required>
                                    <small class="form-text text-muted">Misalnya Kelompok Abu Ubaidah ibn Jarroh</small>
                                </div>

                                <div class="form-group">
                                    <label for="">Pembimbing Tahfidz</label>
                                    <select class="form-control" required name="guru" id="">
                                        <option>Pilih Pembimbing Tahfidz</option>
                                        @forelse ($widget['guru'] as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Anggota Kelompok</label>
                                    <select style="height: 500px; width:100%" class="form-control" required name="member[]"
                                        id="select-student" multiple>
                                        @forelse ($widget['santri'] as $item)
                                            <option value="{{ $item->id }}">{{ $item->kelas . '-' . $item->nama }}
                                            </option>
                                        @empty
                                            <option value="">Tidak Ada Data</option>
                                        @endforelse
                                    </select>
                                </div>






                                <input type="hidden" name="user_id" value="{{ Auth::guard('admin')->user()->id }}">

                                <button type="submit" class=" btn btn-rounded btn-outline-success btn-block">
                                    Input Kelompok Tahfidz
                                </button>



                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('app-script')
<!-- SELECT2 -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
    $("#select-student").select2({});

</script>
@endsection
