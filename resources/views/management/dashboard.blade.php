@extends('management.layout.main')
@section('title','ADMIN')
@section('position',strtoupper($u_nme))
@section('page','HOME')
@section('content')
    @if( Session::has('welcome'))
        <script>
            Swal.fire({
                title: "Welcome Back",
                text: "{{ Session::get('welcome') }}",
                icon: "success",
            });
        </script>
    @endif
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
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-8">
                    <!-- TABLE: LATEST BORROWER -->
                    <div class="card mt-5">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">REGISTERED BORROWER</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>{{$ic}}</th>
                                        <th>{{$nme}}</th>
                                        <th>{{$mail}}</th>
                                        <th>Image</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!is_null($borrower))
                                        @php $i=1; @endphp
                                        @foreach($borrower as $d)
                                            @foreach($d as $a)
                                                <tr>
                                                    <td>{{$i++}} .</td>
                                                    @if(!empty($a->ic))
                                                        <td>{{strtoupper($a->ic)}}</td>
                                                    @else
                                                        <td>None</td>
                                                    @endif
                                                    @if(!empty($a->name))
                                                        <td>
                                                            {{strtoupper($a->name)}}
                                                            @if(!is_null($a->deadline))
                                                                @if(DateTime::createFromFormat('Y-m-d', $a->deadline)< new DateTime())
                                                                    <br>
                                                                    <span class="badge badge-danger">
                                                Overdue Borrowing
                                                    </span>
                                                                @elseif(DateTime::createFromFormat('Y-m-d', $a->deadline)>new DateTime())
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
                                                    @if(!empty($a->user_email))
                                                        <td>{{$a->user_email}}</td>
                                                    @else
                                                        <td>None</td>
                                                    @endif
                                                    @if(!empty($a->img))
                                                        <td>
                                                            <a href="{{route('admin.view_b',['id'=>$a->id])}}">
                                                                <img src="{{asset('storage/borrower_photo/'.$a->img)}}"
                                                                     alt="profile" width="50" height="50">
                                                            </a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <a href="#">
                                                                <img src="{{asset('img/default.png')}}"
                                                                     alt="profile" width="50" height="50">
                                                            </a>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">NO RECORD FOUND</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <a href="{{route('admin.form')}}" class="btn btn-sm btn-info float-left">New Borrower</a>
                            <a href="{{route('admin.list_b')}}" class="btn btn-sm btn-secondary float-right">Manage
                                Details</a>
                        </div>
                    </div>
                    <!-- TABLE: LATEST ADMIN -->
                    <div class="card mt-5">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">CURRENT ADMIN</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>{{$nme}}</th>
                                        <th>{{$mail}}</th>
                                        <th>Date Join</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user as $a)
                                        <tr>
                                            <td>{{$loop->iteration}} .</td>
                                            @if(!empty($a->name))
                                                <td>
                                                    {{strtoupper($a->name)}}
                                                    @if($u_nme==$a->name)
                                                        <span class="text-success"> ( You )</span>
                                                    @endif
                                                </td>
                                            @else
                                                <td>None</td>
                                            @endif
                                            @if(!empty($a->email))
                                                <td>{{$a->email}}</td>
                                            @else
                                                <td>None</td>
                                            @endif
                                            @if(!empty($a->created_at))
                                                <td>{{$a->created_at->format('d-m-Y') }}</td>
                                            @else
                                                <td>None</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{--Right col--}}
                <div class="col-md-4">
                    <!-- Info Boxes Style 2 -->
                    <div class="info-box mb-3 bg-warning">
                        <span class="info-box-icon"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Registered Borrower</span>
                            <span class="info-box-number">{{sizeof($borrower)}}</span>
                        </div>
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-success">
                        <span class="info-box-icon"><i class="fas fa-book-reader"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Current Book Borrowed</span>
                            <span class="info-box-number">{{sizeof($borrow)}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-danger">
                        <span class="info-box-icon"><i class="fas fa-book"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Book Available</span>
                            <span class="info-box-number">{{sizeof($avail)}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"><i class="fas fa-list-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Books</span>
                            <span class="info-box-number">{{sizeof($book_num)}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->

                    <!-- PRODUCT LIST -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recently Added Book</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                @foreach($book as $e)
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="{{asset('storage/book_img/'.$e->c_img)}}"
                                                 alt="book_img" class="img-size-50" data-toggle="modal"
                                                 data-target="#book-img-{{$e->id}}">
                                        </div>
                                        {{--image Modal--}}
                                        <div class="modal fade" id="book-img-{{$e->id}}">
                                            <div class="modal-dialog modal-lg   ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <img src="{{asset('storage/book_img/'.$e->c_img)}}" alt="cover"
                                                             width="100%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title">
                                                {{$e->created_at->format('d-m-Y')}}
                                                <span class="badge badge-success float-right">
                                                    RM{{$e->price}}
                                                </span>
                                            </a>
                                            <span class="product-description">
                                                {{$e->title}}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        <a href="{{route('admin.l_book')}}" class="uppercase">
                            <div class="card-footer text-center">
                                View All Books
                            </div>
                        </a>
                        <!-- /.card-footer -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('notification')
    @if(sizeof($pend)>0)
        <span class="badge badge-warning animation__shake f">
       {{sizeof($pend)}}
    </span>
    @endif
@endsection
