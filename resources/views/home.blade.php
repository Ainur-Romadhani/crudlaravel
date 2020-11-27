@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="home/create">Tambah User</a>
                   @if(session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h6><i class="fas fa-check"></i><b> Success  {{session('success')}}</b></h6>
                    </div>
                    @endif
                     @if(session('delete'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h6><i class="fas fa-check"></i><b> Success  {{session('delete')}}</b></h6>
                    </div>
                    @endif
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Username</th>
                          <th scope="col">Email</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($user as $data)
                        <tr>
                          <th scope="row">{{$loop->iteration}}</th>
                          <td>{{$data->name}}</td>
                          <td>{{$data->email}}</td>
                          <td><a href="{{route ('home.edit',$data->id)  }}" class="btn btn-outline-primary">Edit</a>
                            <a href="/todo/index/{{$data->id}}" class="btn btn-outline-success">To Do List</a>
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalDelete{{$data->id}}">Hapus</button>
                          </td>

                        </tr>
                        <!--  -->
                        <form action="/home/{{$data->id}}" method="POST" class="remove-record-model">
                        @method('delete')
                        @csrf
                        <div id="ModalDelete{{$data->id}}" class="modal modal-danger fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog" style="width:55%;">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h4>Apakah yakin menghapus {{$data->name}}?</h4>
                                        <input type="hidden", name="applicant_id" id="app_id" value="">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger waves-effect remove-data-from-delete-form">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <!--  -->
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
