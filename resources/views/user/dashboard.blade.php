@extends('management.layout.sec')
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
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header text-white"
                             style="background: url('{{asset('img/bg3.jpg')}}'); background-size: cover">
                            <h3 class="widget-user-username text-left" style="color: black">{{strtoupper($u_nme)}}</h3>
                            <h5 class="widget-user-desc text-left mt-1" style="color: black">Details Record</h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle" style="width: 33%; margin-left: -6%"
                                 src="{{asset('storage/borrower_photo/'.$detail->img)}}" alt="User Avatar">
                        </div>
                        <div class="card-footer mt-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="description-block">
                                        <h5 class="description-header">ID</h5>
                                        <span class="description-text">{{$detail->ic}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="description-block">
                                        <h5 class="description-header">EMAIL</h5>
                                        <span>{{$detail->user_email}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="description-block">
                                        <h5 class="description-header">DEPARTMENT</h5>
                                        <span class="description-text">{{$detail->department}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="description-block">
                                        <h5 class="description-header">JOIN DATE</h5>
                                        <span class="description-text">{{$detail->created_at->format('d-m-Y')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="description-block">
                                        <h5 class="description-header">{{$lb}}</h5>
                                        <span class="description-text">
                                        @if(!empty($list))
                                                @foreach($list as $l)
                                                    {{$loop->iteration}}. {{$l}}<br>
                                                @endforeach
                                            @else
                                                NONE
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{--Right col--}}
                <div class="col-md-4">
                    <!-- Info Boxes Style 2 -->
                    <div class="info-box mb-3 bg-warning">
                        <span class="info-box-icon"><i class="fas fa-list-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Book Inventory</span>
                            <span class="info-box-number">{{sizeof($book_num)}}</span>
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
                        <span class="info-box-icon"><i class="fas fa-clock"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pending Approval Books</span>
                            @if($pend == 'A')
                                <span class="info-box-number">{{sizeof($list)}}</span>
                            @else
                                <span class="info-box-number">0</span>
                            @endif

                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->

                    <!-- PRODUCT LIST -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">New Library Books</h3>
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
                        <div class="card-footer text-center">
                            <a href="{{route('borrower.l_bk')}}" class="uppercase">View All Books</a>
                        </div>
                        <!-- /.card-footer -->
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
