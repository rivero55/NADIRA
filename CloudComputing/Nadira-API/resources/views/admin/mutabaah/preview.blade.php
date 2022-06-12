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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="calendar-events" class="">
                                            <div class="calendar-events mb-3" data-class="bg-info"><i
                                                    class="fa fa-circle text-info mr-2"></i>Event One</div>
                                            <div class="calendar-events mb-3" data-class="bg-success"><i
                                                    class="fa fa-circle text-success mr-2"></i> Event Two
                                            </div>
                                            <div class="calendar-events mb-3" data-class="bg-danger"><i
                                                    class="fa fa-circle text-danger mr-2"></i>Event Three
                                            </div>
                                            <div class="calendar-events mb-3" data-class="bg-warning"><i
                                                    class="fa fa-circle text-warning mr-2"></i>Event Four
                                            </div>
                                        </div>
                                        <!-- checkbox -->
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="drop-remove">
                                            <label class="custom-control-label" for="drop-remove">Remove
                                                after drop</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 p-4">
                            <form action="{{url('/mutabaah/store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nama Agenda Mutabaah</label>
                                    <input type="text"
                                           class="form-control" name="judul" id="" aria-describedby="helpId"
                                           placeholder="Judul Mutabaah (Opsional)">
                                    <small class="form-text text-muted">Help text</small>
                                </div>

                                <div class="form-group">
                                    <label for="">Tanggal Mutaba'ah</label>
                                    <input type="date"
                                           class="form-control" name="tanggal" id="" aria-describedby="input_date"
                                           placeholder="">
                                    <small id="input_date" class="form-text text-muted">Klik Logo Calendar untuk memilih tanggal</small>
                                    <small id="input_date2" class="form-text text-muted">Mutabaah hanya dapat diakses pada tanggal terkait</small>
                                </div>


                            <div class="form-group">
                              <label for="">Status Mutaba'ah</label>
                              <select class="form-control" name="status" id="">
                                <option value="1">Dibuka</option>
                                <option value="0">Ditutup</option>
                                <option value="3">Pending</option>
                              </select>
                            </div>

                            <input type="hidden" name="user_id" value="{{Auth::guard('admin')->user()->id}}">

                            <button type="submit" class=" btn btn-rounded btn-outline-success btn-block">
                                Tambah Agenda Mutabaah
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

@endsection
