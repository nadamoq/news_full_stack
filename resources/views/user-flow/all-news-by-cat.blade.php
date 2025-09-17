@extends('user-flow.master')
@section('content')
    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">{{$category->name}}
        <small>all you need</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{route('user-view.index')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">{{$category->name}}</li>
      </ol>
      @foreach ($news as $item)               
      <!-- news title One -->
      <div class="row">
        <div class="col-md-7">
          <a href="{{route('user-view.show',$item->id)}}">
            <img class="img-fluid full-width h-200 rounded mb-3 mb-md-0" src="{{Storage::url($item->images->first()->path)}}" 
            alt="{{$item->images->first()->alt_txt}}">
          </a>
        </div>
        <div class="col-md-5">
          <h3>{{$item->title}}</h3>
          <p>{{$item->description}}</p>
          <a class="btn btn-primary" href="{{route('user-view.show',$item->id)}}">View {{$item->title}}
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div>
      </div>
      <!-- /.row -->
      <hr>
      @endforeach
  

      <!-- Pagination -->
  

    {{ $news->links() }}



      
    </div>
    <!-- /.container -->

@endsection