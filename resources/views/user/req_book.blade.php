@extends('management.layout.sec')
@section('page','REQUESTING BOOK')
@section('position',strtoupper($u_nme))
@section('content')
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">BOOK REQUESTING</h3>
            </div>
            <form id="userForm" action="{{route('borrower.req_bp')}}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <input type="hidden" name="id" id="id" value="{{$data->id}}">
                    <div class="form-group">
                        <label for="matrix">ID</label>
                        <input type="text" name="matrix" class="form-control" id="matrix"
                               placeholder="Enter ID / MATRIX"
                               minlength="12" maxlength="12" value="{{$data->ic}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" name="name" class="form-control" id="fullName" placeholder="Enter Full Name"
                               value="{{$data->name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email"
                               value="{{$data->user_email}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" name="department" class="form-control" id="department"
                               placeholder="Enter Department" value="{{$data->department}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="bookId">Book ID</label>
                        <input type="text" name="bookId" class="form-control" id="bookId"
                               placeholder="Enter Book ID"
                               value="{{old('bookId')}}">
                    </div>
                    <div class="form-group">
                        <label for="numDaysBorrow">Number of Days Borrowed</label>
                        <input type="date" name="num_day" class="form-control" id="numDaysBorrow" min="1"
                               value="{{old('num_day')}}">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{route('borrower.dash')}}" class="btn btn-secondary ">Cancel</a>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('notification')
    @if($pend == 'A')
        <span class="badge badge-warning animation__shake">
       !
    </span>
    @endif
@endsection
