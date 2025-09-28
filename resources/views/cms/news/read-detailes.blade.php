    @extends('cms.master-admin')
    @section('title','detailes')
    @section('style')
        <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
    <!-- Custom styles for this template -->
    <link href="{{asset('assets/css/modern-business.css')}}" rel="stylesheet">
    @endsection
    @section('content')
    <div class="content-wrapper">
     <section class="content">
      <div class="container-fluid">
          <h1 class="mt-4 mb-3"><h2>{{$news->title}}</h2> 

      </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="">{{$news->category->name}}</a>
            </li>
            <li class="breadcrumb-item active">news details</li>
        </ol>

        <div class="row">
          <div class="container-fluid">
        <!-- Post Content Column -->
          <div class="col-lg-8">
            
            @foreach ($news->images as $image)

            <div class="image-box">
              <img src="{{Storage::url($image->path)}}" alt="{{$image->alt_txt}}">
            </div>

            @endforeach 
            <hr>

            <!-- Date/Time -->
            
            <p>Posted on {{$news->published_at}}</p>
            <hr>
            {!! $news->content!!}

            <hr>
             <div class="col-md-5">
            <button id='button_pub' class="btn btn-primary" type ='button'onclick='publish({{$news->id}})'>publish to public 
                        <span class="glyphicon glyphicon-chevron-right"></span>
            </button>
             </div>
             <hr>
             </div>
            </div>
          </div>
        </div>
      </div></section>
    </div>
    @endsection
    @section('script')
           <!-- Bootstrap core JavaScript -->
        <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  function publish(id){
    axios.post(`/news/publish/${id}`)
    .then(function(response){
      console.log();      
      toastr.success(response.data.message)
      document.getElementById('button_pub').innerText='published';
      document.getElementById('button_pub').disabled=true;
    })
    .catch(function(error){
      console.log();      
      toastr.error(error.response.data.message)
    })
  }
</script>
    <!-- Bootstrap core JavaScript -->
    
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    @endsection
    