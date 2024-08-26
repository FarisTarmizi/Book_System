@extends('management.layout.main')
@section('title','ADMIN')
@section('position',strtoupper($u_nme))
@section('page','LIST OF BOOK')
@section('content')
    <div class="card mt-5">
        <div class="card-header border-transparent">
            <h3 class="card-title">LIST OF BOOK</h3>
            <a href="{{route('admin.r_book')}}" class="btn  btn-info float-right">Add Book</a>
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
                        <th>Cover Book</th>
                        <th>About</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data2 as $d)
                        <tr>
                            @if(!empty($d->c_img))
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#book-image-{{$d->id}}">
                                        <img src="{{asset('storage/book_img/'.$d->c_img)}}"
                                             alt="cover" width="80" height="100">
                                    </a>
                                </td>
                                {{--image Modal--}}
                                <div class="modal fade" id="book-image-{{$d->id}}">
                                    <div class="modal-dialog modal-lg   ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <img src="{{asset('storage/book_img/'.$d->c_img)}}" alt="cover"
                                                     width="100%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <td>
                                    <a href="{{route('admin.view',['id'=>$d->id])}}">
                                        <img src="{{asset('img/default.png')}}"
                                             alt="profile" width="100" height="100">
                                    </a>
                                </td>
                            @endif
                            <td>
                                @if(!empty($d->i_num))
                                    <b>Id :</b> {{$d->i_num}}
                                @else
                                    <b>Id :</b> NONE
                                @endif
                                <br>
                                @if(!empty($d->title))
                                    <b>Title :</b> {{strtoupper($d->title)}}
                                @else
                                    <b>Title :</b> NONE
                                @endif
                                <br>
                                @if(!empty($d->author))
                                    <b>Author :</b> {{$d->author}}
                                @else
                                    <b>Author :</b>  NONE
                                @endif
                                <br>
                                @if(!is_null($d->id_borrower))
                                    <span class="badge badge-danger">
                                                {{$d->id_borrower}} Borrowed
                                                    </span>
                                    @php $deadline = date_create_from_format('Y-m-d',$d->deadline)->format('d-m-Y');$current=(new DateTime())->format('d-m-Y'); @endphp
                                    @if($deadline<$current)
                                            <br>
                                        <span class="badge badge-danger">
                                                Overdue Borrowed
                                                    </span>
                                    @endif
                                @else
                                    <span class="badge badge-success">
                                               Available
                                                    </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('admin.m_book',['id'=>$d->id])}}" class="btn btn-info float-left">Manage
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
