@extends('management.layout.main')
@section('title','ADMIN')
@section('page','ADD NEW BORROWER')
@section('position',strtoupper($u_nme))
@section('content')
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">REGISTER NEW BORROWER</h3>
            </div>
            <form action="{{route('admin.insert')}}" method="POST" enctype="multipart/form-data" id="Form2">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="matrix">Matrix / ID</label>
                        <input type="text" name="matrix" class="form-control @error('matrix') is-invalid @enderror"
                               id="matrix"
                               placeholder="Enter ID / MATRIX" minlength="12" maxlength="12" value="{{old('matrix')}}">
                        @error('matrix')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               id="name" placeholder="Enter Full Name"
                               value="{{old('name')}}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror"
                               id="email" placeholder="Enter email"
                               value="{{old('email')}}">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" name="department"
                               class="form-control  @error('department') is-invalid @enderror" id="department"
                               placeholder="Enter Department" value="{{old('department')}}">
                        @error('department')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{--<div class="form-group">
                        <label for="bookId">Book ID</label>
                        <input type="text" name="bookId" class="form-control" id="bookId" placeholder="Enter Book ID"
                               value="{{old('bookId')}}">
                    </div>
                    <div class="form-group">
                        <label for="numDaysBorrow">Number of Days Borrowed</label>
                        <input type="number" name="num_day" class="form-control" id="numDaysBorrow" min="1"
                               value="{{old('num_day')}}">
                    </div>--}}
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" class="form-control  @error('password') is-invalid @enderror"
                               id="password" placeholder="" value=""
                               minlength="8">
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <script>
                            // Define the generatePassword function
                            function generatePassword() {
                                var length = 8; // Length of the random password
                                var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; // Character set for generating the password
                                var password = "";

                                for (var i = 0; i < length; i++) {
                                    password += charset.charAt(Math.floor(Math.random() * charset.length));
                                }

                                // Set the generated password to the input field
                                document.getElementById("password").value = password;
                            }

                            // Call generatePassword() when the page loads
                            window.onload = function () {
                                generatePassword(); // Automatically generate password when the page loads
                            };

                            // Optional, regenerate the password whenever the input field is clicked
                            /*document.getElementById("password").addEventListener("click", function () {
                                generatePassword();
                            });*/

                        </script>
                    </div>
                    <div class="form-group">
                        <label for="img">Picture</label>
                        <input type="file" name="img" class="form-control  @error('img') is-invalid @enderror" id="img"
                               accept="image/*">
                        @error('img')
                        <div class="text-danger">{{ $message }} MAX:10MB</div>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{route('admin.dash')}}" class="btn btn-secondary ">Cancel</a>
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
