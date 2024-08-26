@extends('management.layout.sec')
@section('page','REQUEST STATUS')
@section('position',strtoupper($u_nme))
@section('content')
    @if(Session::has('error'))
        <script>
            Swal.fire({
                title: "Notification",
                text: "{{ Session::get('error') }}",
                icon: "error"
            });
        </script>
    @endif
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">REQUEST STATUS </h3>
            </div>
            @if(!(is_null($data->num_day) && is_null($data->i_num)))
                @if($data->status=='P')
                    <div class="card-body text-center">
                        <h1 class="text-secondary">
                            <i class="far fa-clock"></i><br>
                            WAITING FOR ADMINISTRATOR'S APPROVAL
                        </h1>
                        <p class="mt-3">List of requested books:</p>
                        @foreach($list as $l)
                            {{$loop->iteration}}. {{$l}}<br>
                        @endforeach
                    </div>
                @elseif($data->status=='A')
                    <div class="card-body text-center">
                        <h1 class="text-secondary">
                            <i class="fas fa-check-circle"></i><br>
                            YOUR REQUEST WAS APPROVED BY ADMINISTRATOR
                        </h1>
                        <p class="mt-3">
                            <b>Instruction: </b> <br>
                            1 - Please pickup the booked books at the library. <br>
                            <b> Address: </b><br> Public Library Alor Setar <br>
                            Jalan Kolam Air,<br> Bandar Alor Setar,<br> 05200 Alor Setar, Kedah.<br><br>
                            2 - After pickup the books, please click the "Confirm" below.
                        </p>
                        <b>Booked Book:</b> <br>
                        @foreach($list as $l)
                            {{$loop->iteration}}. {{$l}}<br>
                        @endforeach

                        <a href="#" class="btn btn-warning mt-5" data-toggle="modal"
                           data-target="#modal-warning-{{ $data->id }}" style="width: 150px">Confirm</a>
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
                                        <p>Are You Sure Has Pickup The Requested Book?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <form method="post"
                                              action="{{route('borrower.pickup',['id'=>$data->id])}}">
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
                    </div>
                @else
                    <div class="card-body text-center">
                        <h1 class="text-secondary">
                            <i class="fas fa-book-reader"></i><br>
                            YOUR CURRENTLY BORROWED A BOOK
                        </h1>
                        {{--<p class="mt-3">
                            <b>Instruction: </b> <br>
                            1 - Please pickup the booked books at the library. <br>
                            <b> Address: </b><br> Public Library Alor Setar <br>
                            Jalan Kolam Air,<br> Bandar Alor Setar,<br> 05200 Alor Setar, Kedah.<br><br>
                            2 - After pickup the books, please click the "Confirm" below.
                        </p>--}}

                        <b>Current Book:</b> <br>
                        @foreach($list as $l)
                            {{$loop->iteration}}. {{$l}}<br>
                        @endforeach

                        {{--<a href="#" class="btn btn-warning mt-5" data-toggle="modal"
                           data-target="#modal-warning-{{ $data->id }}" style="width: 150px">Confirm</a>
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
                                        <p>Are You Sure Has Pickup The Requested Book?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <form method="post"
                                              action="{{route('borrower.pickup',['id'=>$data->id])}}">
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
                        </div>--}}
                    </div>
                @endif
            @else
                <div class="card-body text-center">
                    <h1 class="text-secondary">
                        <i class="far fa-clock"></i><br>
                        NO BOOK REQUESTING
                    </h1>
                    <p class="mt-3">Request books here :</p>
                    <a href="{{route('borrower.req_b')}}" class="btn btn-primary "
                       style="width: 150px">Request Book</a>
                </div>
            @endif
        </div>
    </div>
@endsection

