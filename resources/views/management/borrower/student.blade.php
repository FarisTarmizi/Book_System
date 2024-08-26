@extends('management.layout.main')
@section('title','ADMIN')
@section('position',strtoupper($u_nme))
@section('page','LIST OF BORROWER')
@section('content')
    @if( Session::has('success'))
        <script>
            Swal.fire({
                title: "Notification",
                text: "{{ Session::get('success') }}",
                icon: "success",
            });
        </script>
    @endif
    @if(Session::has('error'))
        <script>
            Swal.fire({
                title: "Notification",
                text: "{{ Session::get('error') }}",
                icon: "error"
            });
        </script>
    @endif
    <div class="card mt-5">
        <div class="card-header border-transparent">
            <h3 class="card-title">LIST OF BORROWER</h3>
            <a href="{{route('admin.form')}}" class="btn  btn-info float-right">New Borrower</a>

            {{--<div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>--}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="example1">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>{{$nme}}</th>
                        <th>{{$ic}}</th>
                        <th>Notes</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr>
                            @if(!empty($d->img))
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#modal-image{{$d->id}}">
                                        <img src="{{asset('storage/borrower_photo/'.$d->img)}}"
                                             alt="profile" width="100" height="100">
                                    </a>
                                </td>
                                {{--image Modal--}}
                                <div class="modal fade" id="modal-image{{$d->id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <img src="{{asset('storage/borrower_photo/'.$d->img)}}" alt="profile"
                                                     width="100%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <td>
                                    <a href="{{route('admin.view_b',['id'=>$d->id])}}">
                                        <img src="{{asset('img/default.png')}}"
                                             alt="profile" width="100" height="100">
                                    </a>
                                </td>
                            @endif
                            @if(!empty($d->name))
                                <td>
                                    {{strtoupper($d->name)}}
                                    @if(!is_null($d->deadline))
                                        @if(DateTime::createFromFormat('d-m-Y', $d->deadline)<(new DateTime())->format('d-m-Y'))
                                            <br>
                                            <span class="badge badge-danger">
                                                Overdue Borrowing
                                                    </span>
                                        @elseif(DateTime::createFromFormat('d-m-Y', $d->deadline)>(new DateTime())->format('d-m-Y'))
                                            <br>
                                            <span class="badge badge-danger">
                                                Borrowing
                                                    </span>
                                        @endif
                                    @endif
                                </td>
                            @else
                                <td>None</td>
                            @endif
                            @if(!empty($d->ic))
                                <td>{{strtoupper($d->ic)}}</td>
                            @else
                                <td>None</td>
                            @endif

                            @if($d->status=='P')
                                <td>
                                    <span class="badge badge-warning animation__wobble"
                                          style="font-family: 'Times New Roman',serif">!</span> <br>
                                    Waiting for book request approval
                                </td>
                            @elseif($d->status=='A')
                                <td>
                                    <span class="badge badge-info animation__wobble"
                                          style="font-family: 'Times New Roman',serif">i</span> <br>
                                    Waiting the borrower pickup the books at the library
                                </td>
                            @else
                                <td>None</td>
                            @endif
                            <td>
                                <a href="{{route('admin.view_b',['id'=>$d->id])}}" class="btn btn-info float-left">Manage
                                    Detail</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('notification')
    @if(sizeof($pend)>0)
        <span class="badge badge-warning animation__shake f">
       {{sizeof($pend)}}
    </span>
    @endif
@endsection
