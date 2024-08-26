@extends('management.layout.main')
@section('title','ADMIN')
@section('page','ADD NEW BOOK')
@section('position',strtoupper($u_nme))
@section('content')
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">ADD NEW BOOK</h3>
            </div>
            <form id="Form" action="#" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="id">Id</label>
                        <input type="text" name="id" class="form-control" id="id" placeholder="EnterBook Id "
                               value="{{old('id')}}">
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter Book Title"
                               value="{{old('title')}}">
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" name="author" class="form-control" id="author"
                               placeholder="Enter author names" value="{{old('author')}}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control"
                                  id="description">{{old('description')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price (RM)</label>
                        <input type="text" name="price" class="form-control" id="price"
                               placeholder="example : 2.23" value="{{old('price')}}">
                    </div>
                    <div class="form-group">
                        <label for="c_img">Picture</label><span class="text-danger" style="font-size: 12px"> * Max 10MB only</span>
                        <input type="file" name="c_img" class="form-control" id="c_img"
                               accept="image/*">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{route('admin.dash')}}" class="btn btn-secondary ">Back</a>
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
