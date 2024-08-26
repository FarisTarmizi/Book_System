@extends('management.layout.main')
@section('title','ADMIN')
@section('page','EDIT BORROWER DETAILS')
@section('position',strtoupper($u_nme))
@section('content')
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">EDIT BORROWER DETAILS</h3>
            </div>
            <form id="Form" action="{{route('admin.update',['id'=>$data->id])}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="matrix">ID</label>
                        <input type="text" name="matrix" class="form-control  @error('matrix') is-invalid @enderror"
                               id="matrix" placeholder="Enter ID"
                               minlength="12"
                               maxlength="12" value="{{$data->ic}}">
                        @error('matrix')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror"
                               id="name" placeholder="Enter Full Name"
                               value="{{$data->name}}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror"
                               id="email" placeholder="Enter email"
                               value="{{$data->user_email}}">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" name="department"
                               class="form-control  @error('department') is-invalid @enderror"
                               id="department"
                               placeholder="Enter Department" value="{{$data->department}}">
                        @error('department')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--<div class="form-group">
                        <label for="bookId">Book ID</label>
                        <input type="text" name="bookId" class="form-control  @error('bookId') is-invalid @enderror"
                               id="bookId" placeholder="Enter Book ID"
                               @if(!is_null($data->i_num)) value="{{$data->i_num}}" @else value="None" @endif >
                        @error('bookId')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="numDaysBorrow">Number of Days Borrowed</label>
                        <input type="number" name="num_day" class="form-control  @error('num_day') is-invalid @enderror"
                               id="numDaysBorrow" min="1" @if(!is_null($data->num_day)) value="{{$data->num_day}}" @else value="0" @endif >
                        @error('num_day')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>--}}
                    <div class="form-group">
                        <label for="img">Picture</label>
                        <input type="file" name="img" class="form-control  @error('img') is-invalid @enderror"
                               id="img">
                        @error('img')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <p>Current: </p>
                        @if(!empty($data->img))
                            <td>
                                <a href="#" data-toggle="modal" data-target="#book-cover-{{$data->id}}">
                                    <img src="{{asset('storage/borrower_photo/'.$data->img)}}"
                                         alt="cover" width="80" height="100">
                                </a>
                            </td>
                            {{--image Modal--}}
                            <div class="modal fade" id="book-cover-{{$data->id}}">
                                <div class="modal-dialog modal-lg   ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <img src="{{asset('storage/borrower_photo/'.$data->img)}}" alt="cover"
                                                 width="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <td>
                                <img src="{{asset('img/default.png')}}"
                                     alt="profile" width="100" height="100">
                            </td>
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                    <a href="{{route('admin.view_b',['id'=>$data->id])}}" class="btn btn-secondary ">Back</a>
                    {{--user reset password--}}
                    <a href="#" class="btn btn-warning" data-toggle="modal"
                       data-target="#modal-warning-{{ $data->id }}">Reset Password</a>
                    <div class="modal fade" id="modal-warning-{{ $data->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content bg-warning">
                                <div class="modal-header">
                                    <h4 class="modal-title">Confirmation</h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure reset {{$data->name}}'s password?</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <form method="post"
                                          action="{{route('admin.delete',['id'=>$data->id])}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                class="btn btn-outline-light"
                                                data-dismiss="modal">Cancel
                                        </button>
                                        <button type="submit" class="btn btn-outline-light">
                                            Confirm
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
@section('notification')
    @if(sizeof($pend)>0)
        <span class="badge badge-warning animation__shake">
       {{sizeof($pend)}}
    </span>
    @endif
@endsection
