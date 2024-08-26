@extends('management.layout.main')
@section('position',strtoupper($u_nme))
@section('page','PENDING REQUEST')
@section('title','ADMIN')
@section('content')
    @if( Session::has('success'))
        <script>
            Swal.fire({
                title: "Notification",
                text: "{{ Session::get('success') }}",
                icon: "success",
            });
            {{--alert("{{ Session::get('success') }}");--}}
        </script>
    @endif

    @if(Session::has('error'))
        <script>
            Swal.fire({
                title: "Error",
                text: "{{ Session::get('error') }}",
                icon: "error"
            });
            {{--alert("{{ Session::get('error') }}");--}}
        </script>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <a href="{{route('admin.form')}}" class="btn btn-info float-left">
                            <i class="fas fa-user-plus"></i>
                            New Borrower
                        </a>
                    </div>
                    <br>
                    <div class="card mt-4">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Pending User</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <br>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table " id="example1">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>{{$nme}}</th>
                                        <th>{{$mail}}</th>
                                        <th>{{$dt}}</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $d)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>

                                            @if(!empty($d->name))
                                                <td>{{strtoupper($d->name)}}</td>
                                            @else
                                                <td>None</td>
                                            @endif
                                            @if(!empty($d->email))
                                                <td>{{$d->email}}</td>
                                            @else
                                                <td>None</td>
                                            @endif
                                            @if(!empty($d->created_at))
                                                <td>{{$d->created_at->format('d-m-Y')}}</td>
                                            @else
                                                <td>None</td>
                                            @endif
                                            <td>
                                                @if($d->role===0)
                                                    <span class="text-success font-weight-bold">
                                                        Approved
                                                    </span>
                                                @else
                                                    <div style="display: inline-block;">
                                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-warning-{{ $d->id }}">
                                                            Approve
                                                        </a>
                                                        <h4 style="display: inline-block;">
                                                            <span class="badge badge-warning animation__wobble">!</span>
                                                        </h4>
                                                    </div>

                                                    <div class="modal fade" id="modal-warning-{{ $d->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-warning">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Confirmation</h4>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are You Sure Approved This User?</p>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <form method="post"
                                                                          action="{{route('admin.lp_user',['id'=>$d->id])}}">
                                                                        @csrf
                                                                        <button type="button"
                                                                                class="btn btn-outline-light"
                                                                                data-dismiss="modal">Cancel
                                                                        </button>
                                                                        <button type="submit"
                                                                                class="btn btn-outline-light">
                                                                            Confirm
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div>
                        <a href="{{route('admin.home')}}" class="btn btn-secondary float-right">
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('notification')
    @if(sizeof($pend)>0)
        <span class="badge badge-warning animation__shake">
       {{sizeof($pend)}}
    </span>
    @endif
@endsection
