@extends('front.layouts.app')

@section('style')

@endsection

@section('content')
    <!-- header -->
    <div class="container my-4" style="padding-top:150px;">
        <div class="row">
            <div class="col-sm-12 ">
                <nav class="" aria-label="breadcrumb">
                    <ol class="breadcrumb aboutBreadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">خانه </a></li>
                        <li class="breadcrumb-item active" aria-current="page">تماس با ما</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Parallax Section -->
    <div class="container p-0 mt-190">
       <h2>صفحه تماس با ما</h2>
    </div>



@endsection

@section('script')

@endsection
