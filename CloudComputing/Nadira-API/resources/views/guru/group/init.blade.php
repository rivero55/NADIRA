@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Ahlan wa Sahlan <br> {{Auth::guard('guru')->user()->nama}}</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                        </li>
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
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
<div class="container-fluid">
   
    <div class="card">
        <div class="card-body">
            <h1 class="card-title mb-5">Kelompok Halaqoh Saya</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelompok</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($group as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->nama_kelompok}}</td>
                            <td>
                                <a href='{{url("group/$item->id/detail")}}'>
                                    <button type="button" class="btn btn-outline-primary mr-2">
                                        Lihat Detail</button>
                                </a>
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                    <tr>
                        <td scope="row"></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td scope="row"></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

  
@endsection

@section('app-script')
    @include('santri.dashboard.script')
@endsection
