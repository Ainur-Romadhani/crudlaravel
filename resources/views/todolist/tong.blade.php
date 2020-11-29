@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-">
            <div class="card">
                <div class="card-header">Tong Sampah</div>
                 <div class="card-body">
                    <a href="/todo/deleteall" class="btn btn-outline-danger">Delete All</a>
                    <a href="/todo/restoreall" class="btn btn-outline-success">Restore All</a>
                    <a href="/todo/index/{{$iduser->id}}" class="btn btn-outline-primary">Kembali</a><br><br>
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
                        <h6><i class="fas fa-check"></i><b>{{session('delete')}}</b></h6>
                    </div>
                    @endif
                <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Name</th>
                          <th scope="col">Start_Date</th>
                          <th scope="col">End_Date</th>
                          <th scope="col">Progres</th>
                          <th scope="col">Delete_BY</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach($todo as $data)
                       
                        <tr>
                          <th scope="row">{{$loop->iteration}}</th>
                          <td>{{$data->name}}</td>
                          <td>{{$data->start_date}}</td>
                          <td>{{$data->end_date}}</td> 
                          <td><progress value="{{$data->proggress}}" max="100"></progress></td>
                          <td>{{$data->delete_by}}</td>
                          <td><a href="/todo/restore/{{$data->id_todos}}" class="btn btn-outline-primary">Restore</a>
                            <a href="/todo/deletepermanent/{{$data->id_todos}}" class="btn btn-outline-danger">Delete</a></td> 
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
@endsection
