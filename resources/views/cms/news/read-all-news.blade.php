@extends('cms.master-admin')
@section('title','all news')
@section('style')



    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/modern-business.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
@endsection

        @section('content')
        
        <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
      
     <h1 class="mt-4 mb-3">All news
        <small>Subheading</small>
      </h1>

        @foreach ($data as $item)
            <hr>

                <!-- news title Two -->
                <div class="row"id='news-{{$item->id}}'>
                    <div class="col-md-7">
                       
                    <a href="{{route('news.show',$item->id)}}">
                        <img class="img-fluid full-width h-200 rounded mb-3 mb-md-0" src="{{Storage::url($item->images->first()->path)}}" alt="{{$item->images->first->path}}">
                    </a>
                    </div>
                    <div class="col-md-5">
                     <button type="button" onclick="del({{$item->id}})" class="close position-absolute" style="top: 5px; right: 10px;" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>


                    <h3>{{$item->title}}</h3>
                    <p>{{$item->description}}</p>

                     <button id="button_status_{{$item->id}}" class="btn btn-primary" type ='button' onclick='arch({{$item->id}})'> 
                      @if ($item->status=='archived')
                       unarchive
                      @else
                         archive
                      @endif 
                        <span class="glyphicon glyphicon-chevron-right"></span>
                      </button>
                      
                    <a class="btn btn-primary"href='{{route('news.show',$item->id)}}'>View details
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    </div>
                </div>
                <!-- /.row -->

            <hr>
        @endforeach
    
            {{$data->links()}}
        </div>
    </section>
  </div>
@endsection


@section('script')
       <!-- Bootstrap core JavaScript -->
        <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>

  function arch(id){
    axios.post(`/news/archive/${id}`)
    .then(function(response){
      console.log();      
      toastr.success(response.data.message)    
      document.getElementById(`button_status_${id}`).innerText=response.data.button;

    }).catch(function(error){
      console.log();
      
      toastr.error(error.response.data.message)
    })
  }
    function del(id){
    axios.delete(`/news/news/${id}`)
    .then(function(response){
      console.log();      
      toastr.success(response.data.message);
      document.getElementById(`news-${id}`).remove();
      location.reload();
    }).catch(function(error){
      console.log();
      
      toastr.error(error.response.data.message)
    })
  }
</script>
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
@endsection