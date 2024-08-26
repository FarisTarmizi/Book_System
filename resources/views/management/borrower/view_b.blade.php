@extends('management.layout.main')
@section('title','ADMIN')
@section('page','BORROWER DETAILS')
@section('position',strtoupper($u_nme))
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

    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <a href="{{route('admin.list_b')}}" class="btn btn-primary btn-lg">Back</a>
                <div class="card mt-3">
                    <div class="card-header border-transparent">
                        <h2 class="mt-3 card-title font-weight-bold">BORROWER DETAILS</h2>
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
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>{{$pfl}}</th>
                                    <td>
                                        @if(!empty($data->img))
                                            <img src="{{ asset('storage/borrower_photo/' . $data->img) }}"
                                                 alt="profile" width="30%">
                                        @else
                                            None
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{$nme}}</th>
                                    <td>
                                        @if(!empty($data->name))
                                            {{ strtoupper($data->name)}}
                                        @else
                                            None
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>{{$ic}}</th>
                                    <td>
                                        @if(!empty($data->ic))
                                            {{ strtoupper($data->ic) }}
                                        @else
                                            None
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{$mail}}</th>
                                    <td>
                                        @if(!empty($data->user_email))
                                            {{ $data->user_email }}
                                        @else
                                            None
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{$dpt}}</th>
                                    <td>
                                        @if(!empty($data->department))
                                            {{strtoupper($data->department)}}
                                        @else
                                            None
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date Join</th>
                                    <td>
                                        @if(!empty($dj))
                                            @foreach($dj as $a)
                                                {{($a->updated_at)->format('d-m-Y')}}
                                            @endforeach
                                        @else
                                            None
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        @if($data->status == 'P')
                                            {{$cbb}} <br>
                                            <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                               data-target="#modal-warning-{{ $data->id }}">Approve</a>
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
                                                            <p>Are You Sure Approve The Requested Book?</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <form method="post"
                                                                  action="{{route('admin.approve',['id'=>$data->id])}}">
                                                                @csrf
                                                                @method('PUT')
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
                                        @elseif($data->status == 'A')
                                            Approved Requested Books <br>
                                            <span style="font-size: 12px" class="badge badge-info">
                                                waiting for the borrower pickup the book
                                            </span>
                                        @else
                                            {{$cbb}}
                                        @endif
                                    </th>
                                    @if(!is_null($list))
                                        <td>
                                            @foreach($list as $l)
                                                {{$loop->iteration}}. {{$l}}<br>
                                            @endforeach
                                        </td>
                                    @else
                                        <td>NONE</td>
                                    @endif
                                </tr>

                                @if(!is_null($list))
                                    <tr>
                                        <th>{{$nd}}</th>
                                        <td>
                                            @if(!empty($data->num_day))
                                                {{ $data->num_day }} days
                                            @else
                                                NONE
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{$dt}}</th>
                                        <td>
                                            @if(!empty($data->date_borrow))
                                                {{ DateTime::createFromFormat('Y-m-d', $data->date_borrow)->format('d-m-Y')}}
                                                <br>
                                            @else
                                                NONE
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Due Date <br>
                                            <span style="font-size: 12px">( Added 1 day for returning process )</span>
                                        </th>
                                        <td>
                                            @if(!empty($data->deadline))
                                                @php
                                                    $start = DateTime::createFromFormat('Y-m-d', $data->date_borrow);
                                                    $end = DateTime::createFromFormat('Y-m-d', $data->deadline);
                                                    $current = new DateTime();
                                                    function baki ($c,$e) {
                                                        // Calculate the difference between the current date and the end date
                                                        $interval = $c->diff($e);
                                                        // Build the output string conditionally
                                                        $output = '';
                                                        // Include years if there's a difference in years
                                                        if ($interval->y > 0) {
                                                            $output .= $interval->y . ' years, ';
                                                        }
                                                        // Include months if there's a difference in months
                                                        if ($interval->m > 0) {
                                                            $output .= $interval->m . ' months, ';
                                                        }
                                                        // Always include days
                                                        $output .= $interval->d . ' days';
                                                        // Remove trailing comma and space if present
                                                        return rtrim($output, ', ');
                                                    }
                                                @endphp
                                                {{ $end->format('d-m-Y')}}
                                                @if($end<$current)
                                                    <span class="badge badge-danger">
                                                      {{baki($current,$end)}}
                                                </span><br>
                                                    <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                                       data-target="#modal-warning-{{ $data->id }}"> Book Has
                                                        Returned</a>
                                                    <div class="modal fade" id="modal-warning-{{ $data->id }}">
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
                                                                    <p>Borrower Has Returned The Book?</p>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <form method="post"
                                                                          action="{{route('admin.return_b',['id'=>$data->id])}}">
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
                                                @else
                                                    <span class="badge badge-warning">
                                                    {{$current->diff($end)->d + 1 . ' days left'}}
                                                </span>
                                                @endif
                                            @else
                                                NONE
                                            @endif
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <th>Action</th>
                                    <td>
                                        <a href="{{route('admin.edit',['id'=>$data->id])}}"
                                           class="btn btn-primary">Edit</a>
                                        <a href="#" class="btn btn-danger" data-toggle="modal"
                                           data-target="#modal-danger-{{ $data->id }}">Delete</a>
                                        <div class="modal fade" id="modal-danger-{{ $data->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-danger">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Confirmation</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are You Sure Delete This Data?</p>
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
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
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
