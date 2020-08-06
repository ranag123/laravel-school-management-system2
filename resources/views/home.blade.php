@extends('layouts.guest')

@section('content')

    <style>
        img{
         height:150px;
            width:150px
        }
    </style>
    <div class="flex flex-wrap mt-20 items-center uppercase text-sm     ">
        <div class="w-3/12 px-4 py-3 "> </div>
        <div class="w-2/12 px-4 mr-2 py-3 bg-white text-center">
            <a class="text-green-700" href="{{route('login')}}">
                <img src="{{asset('images/admin.jpg')}}">
                Admin</a>
        </div> <div class="w-2/12 px-4 mr-2 py-3 bg-white text-center">
            <a href="{{route('login')}}" class="text-green-700">
                <img src="{{asset('images/teacher.jpg')}}">
                Admin</a>
        </div>

    </div>
    <div class="flex flex-wrap mt-5 items-center uppercase text-sm     ">
        <div class="w-3/12 px-4 py-3 "> </div>
        <div class="w-2/12 px-4 mr-2 py-3 bg-white text-center">
            <a href="{{route('login')}}">
                <img src="{{asset('images/parent.png')}}">
                Parents</a>
        </div> <div class="w-2/12 px-4 mr-2 py-3 bg-white text-center">
            <a href="{{route('login')}}">
                <img src="{{asset('images/student.png')}}">
                Student</a>
        </div>

    </div>



  @endsection

