@extends('management.layout.main')
@section('title','ADMIN')
@section('page','EDIT BOOK DETAILS')
@section('position',strtoupper($u_nme))
@section('content')
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">EDIT BOOK DETAILS</h3>
            </div>
            <form id="eForm" action="#" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="id">Id</label>
                        <input type="text" name="id" class="form-control" id="id" placeholder="EnterBook Id "
                               value="{{$result->i_num}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter Book Title"
                               value="{{$result->title}}">
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" name="author" class="form-control" id="author"
                               placeholder="Enter author names" value="{{$result->author}}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea rows="7" name="description" class="form-control text-justify" id="description">{{$result->description}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price (RM)</label>
                        <input type="text" name="price" class="form-control" id="price"
                               placeholder="example : 2.23" value="{{$result->price}}">
                    </div>
                    <div class="form-group">
                        <label for="c_img">Picture</label> <span class="text-danger" style="font-size: 12px"> * Max 10MB only</span>
                        <input type="file" name="c_img" class="form-control"
                               id="c_img">
                        <p>Current: </p>
                        @if(!empty($result->c_img))
                            <td>
                                <a href="#" data-toggle="modal" data-target="#book-image-{{$result->id}}">
                                    <img src="{{asset('storage/book_img/'.$result->c_img)}}"
                                         alt="cover" width="80" height="100">
                                </a>
                            </td>
                            {{--image Modal--}}
                            <div class="modal fade" id="book-image-{{$result->id}}">
                                <div class="modal-dialog modal-lg   ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <img src="{{asset('storage/book_img/'.$result->c_img)}}" alt="cover"
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
                    <a href="{{route('admin.m_book',['id'=>$result->id])}}" class="btn btn-secondary ">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
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
