    @extends('user-flow.master')
    @section('title','details')
    @section('style')
        <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

      <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">

    <link href="{{asset('assets/css/modern-business.css')}}" rel="stylesheet">
    @endsection
    @section('content')
      <div class="container">
    <div class="content-wrapper">
     <section class="content">
      <div class="container-fluid">
          <h1 class="mt-4 mb-3"><h2>{{$news->title}}</h2> 

      </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="{{route('user-view.index')}}">Home</a>
            </li>
            <li class="breadcrumb-item active">news details</li>
        </ol>

        <div class="row">
          <div class="container-fluid">

          <div class="col-lg-8">
            
            @foreach ($news->images as $image)

            <div class="image-box">
              <img src="{{Storage::url($image->path)}}" alt="{{$image->alt_txt}}">
            </div>

            @endforeach 
            <hr>

      
            
            <p>Posted on {{$news->published_at}}</p>
            <hr>
            {!! $news->content!!}

            <hr>
          <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
              <form id='form'>
                <input  id="name"    class="form-control js-name" placeholder="your name">
                <textarea id="content" class="form-control js-content" rows="3" placeholder="your comment"></textarea>

                <button type="button" class="btn btn-primary" onclick="comment(this)">Submit</button>

              </form>
            </div>
          </div>
             
        @foreach ($news->comments as $comment)
  
          <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
              <h5 class="mt-0">{{$comment->name}}</h5>
              {{$comment->content}}
               <button class="btn btn-sm btn-outline-secondary mb-3" type="button"
                onclick="toggleReplyForm({{ $comment->id }})">
                  Reply
                </button>
                   
                <form id="reply-form-{{ $comment->id }}" class="comment-form border p-3 rounded mb-3"
                      data-parent-id="{{ $comment->id }}" style="display:none;">
                  <div class="form-group">
                    <label>الاسم</label>
                    <input  class="form-control js-name" placeholder="اكتب اسمك">
                  
                  </div>
                  <div class="form-group">
                  
                  <textarea class="form-control js-content" rows="2" placeholder="اكتب ردّك"></textarea>

                  </div>
                 <button type="button" class="btn btn-sm btn-primary" onclick="comment(this, {{ $comment->id }})">أرسل الرد</button>

                </form>

             @foreach ($comment->children?? collect() as $reply)
                                      
              <div class="media mt-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                  <h5 class="mt-0">{{$reply->name}}</h5>
                {{$reply->content}} </div>
              </div> @endforeach   
            
            

            </div>
          </div>
       @endforeach
           
            </div>
          </div>
        </div>
      </div></section>
    </div>
      </div>
    @endsection
    @section('script')
           <!-- Bootstrap core JavaScript -->
       <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
 <script>
  ///////////////////////////////////////////////////////
  function toggleReplyForm(id){
  const el = document.getElementById('reply-form-' + id);
  el.style.display = (!el || el.style.display === 'none' || !el.style.display) ? 'block' : 'none';
  }
  //////////////////////////
 
     function comment(btn, parentId = null){
    // خُذي نفس النموذج الذي يحوي الزر
    const form = btn.closest('form');
        const data = {
          name: document.getElementById('name').value,
          content: document.getElementById('content').value,
          news_id: {{ $news->id }}
        };
        if (id != null) data.parent_id = id;

        axios.post('{{route('comment.store')}}',data
        )
            .then(function(response){
            toastr.success(response.data.message);
            document.getElementById('form').reset();
            if (parentId !== null) form.style.display = 'none'; 
            })
            .catch(function(error){
            console.log(error)
            toastr.error(error.response.data.message);
            })
        }
    </script>
    <!-- Bootstrap core JavaScript -->
    
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    @endsection
    