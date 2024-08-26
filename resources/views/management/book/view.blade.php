@extends('management.layout.main')
@section('title','ADMIN')
@section('page','BOOK DETAILS')
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
    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <a href="{{route('admin.l_book')}}" class="btn btn-primary btn-lg">Back</a>
                <!-- TABLE: LATEST ORDERS -->
                <div class="card mt-3">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Book Details</h3>
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
                                <tbody>
                                <tr>
                                    <th>Id</th>
                                    <td>{{ $data->i_num }}</td>
                                </tr>
                                <tr>
                                    <th>Cover Page</th>
                                    <td>
                                        @if(!empty($data->c_img))
                                            <img src="{{ asset('storage/book_img/' . $data->c_img) }}"
                                                 alt="book_img" width="30%">
                                        @else
                                            None
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Title</th>
                                    <td>{{ $data->title }}</td>
                                </tr>
                                <tr>
                                    <th>Author</th>
                                    <td>{{ $data->author }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td class="text-justify">{{ $data->description }}</td>
                                </tr>
                                <tr>
                                    <th>Date Registered</th>
                                    <td>{{ $data->created_at->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>RM {{ $data->price }}</td>
                                </tr>
                                <tr>
                                    <th>Current Borrower</th>
                                    <td>
                                        @if(!is_null($data->id_borrower))
                                            {{ strtoupper($data2->name)}} ({{$data2->ic}})
                                            @php $deadline = date_create_from_format('Y-m-d',$data2->deadline)->format('d-m-Y');$current=(new DateTime())->format('d-m-Y'); @endphp
                                            @if($deadline<$current)
                                                <br><span class="badge badge-danger">
                                                Overdue Borrower
                                            </span>
                                            @endif
                                        @else
                                            None
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <td>
                                        <a href="{{route('admin.e_book',['id'=>$data->id])}}" class="btn btn-primary">Edit</a>
                                        <a href="#" class="btn btn-danger" data-toggle="modal"
                                           data-target="#modal-danger-{{ $data->id }}">Delete</a>
                                        <div class="modal fade" id="modal-danger-{{ $data->id }}">
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
                                                        <p>Are You Sure Delete This Data?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <form method="post"
                                                              action="{{route('admin.d_book',['id'=>$data->id])}}">
                                                            @csrf
                                                            @method('DELETE')
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
