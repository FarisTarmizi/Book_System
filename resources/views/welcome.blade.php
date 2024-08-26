@extends('management.layout.test')
@section('nav','LIBRARY LOAN MANAGEMENT SYSTEM')
@section('nme','BOOK SYSTEM')
@section('title','WELCOME')

@section('content')
    @if(Session::has('success'))
        <script>
            Swal.fire({
                title: "Exit",
                text: "{{ Session::get('success') }}",
                icon: "success",
                backdropColor: "#000000"
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
    <div class="container-fluid">
        <h1 class="text-center mt-4" style="font-family: 'Times New Roman',sans-serif">WELCOME TO
            OUR SYSTEM
        </h1>
        <a href="{{route('login_b')}}">
            <img src="{{asset('img/logo2.png')}}" alt="logo" class="mt-2" style="margin-left: 33%">
        </a>
    </div>
@endsection

