@extends('management.layout.sec')
@section('position',strtoupper($u_nme))
@section('page','LIST OF BOOK')
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

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">LIST OF BOOK</h3>
                </div>
                <div class="card-body ">
                    <div class="row">
                        @foreach($details as $item)
                            <div class="col-md-2">
                                <div class="description-block">
                                    @if(!empty($item->c_img))
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#book-cover-{{$item->id}}">
                                                <img src="{{asset('storage/book_img/'.$item->c_img)}}"
                                                     alt="cover book" width="110" height="160">
                                            </a>
                                        </td>
                                        {{--image Modal--}}
                                        <div class="modal fade" id="book-cover-{{$item->id}}">
                                            <div class="modal-dialog modal-lg   ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <img src="{{asset('storage/book_img/'.$item->c_img)}}"
                                                             alt="cover" width="50%" class="mx-auto">
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><b> Title: </b><br>{{$item->title}}</p>
                                                        <p><b>Author: </b><br>{{$item->author}}</p>
                                                        <p><b>RM {{$item->price}}</b></p>
                                                        <b>Description: </b><br>
                                                        <p class="text-justify">{{$item->description}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <td>
                                            <img src="{{asset('img/default.png')}}"
                                                 alt="profile" width="110" height="160">
                                        </td>
                                    @endif
                                    <h5 class="description-header">ID <br>
                                        {{$item->i_num}}</h5>
                                    {{--                                        <span class="description-text">{{$item->title}}</span><br>--}}
                                    @if(!is_null($item->id_borrower))
                                        <span class="badge badge-danger">
                                                Borrowed
                                                    </span>
                                    @else
                                        <span class="badge badge-success">
                                               Available
                                                    </span>
                                    @endif

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('notification')
    @if($pend == 'A')
        <span class="badge badge-warning animation__shake">
       !
    </span>
    @endif
@endsection
