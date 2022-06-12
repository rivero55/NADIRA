@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Kelompok</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Kelompok</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Lihat Detail Kelompok</li>
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
                <img class="card-img-top" src="holder.js/100x180/" alt="">
                <div class="card-body">
                    @if ($widget['group'] != null)
                        <h1 class="card-title">{{$widget['group']->nama_kelompok}}</h1>
                        <h2 class="card-title">Pembimbing : {{$widget['group']->g_name}}</h1>
                        <h3 class="card-title">Kontak Pembimbing : {{$widget['group']->g_contact}}</h3>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <img class="card-img-top" src="holder.js/100x180/" alt="">
                <div class="card-body">
                    @if ($widget['group'] != null)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Santri</th>
                                    <th>Kelas</th>
                                    <th>Asrama</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($widget['member'] as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nis}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->kelas}}</td>
                                    <td>{{$item->asrama}}</td>
                                </tr>
                                @empty
                                    
                                @endforelse
                           
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


@section('app-script')

@endsection
