@extends('cms.master-admin')
@section('title','contact')
    @section('style')
      <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
@endsection
@section('content')

  <div class="content-wrapper">
<div class="container py-4">
  <div class="d-flex justify-content-between mb-3">
    <h3 class="mb-0">Contact Messages</h3>
    <span class="badge text-bg-primary">Total:{{count($contacts)}}</span>
  </div>

  <div class="card shadow-sm">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Message</th>
          <th>Date</th>
          <th class="text-center">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($contacts as $item)
        <tr id="contact-{{$item->id}}">
          <td>{{$loop->index+1}}</td>
          <td>{{$item->name}}</td>
          <td><a href="mailto:{{$item->email}}">{{$item->email}}</a></td>
          <td>{{$item->phone}}</td>
         <td class="message-cell">
            <details>
              <summary class="btn btn-link p-0">See message</summary>
              <div class="mt-2">{{ $item->message }}</div>
            </details>
          </td>

          <td>{{$item->created_at->format('d-m-Y h:i A')}}</td>
          <td class="text-center">
            <div class="btn-group">
             
              <input class="btn btn-sm btn-outline-danger" onclick='del({{$item->id}})' value='delete' type='button'>
            </div>
          </td>
        </tr>
     @endforeach
        </tbody>
      </table>
      {{$contacts->links()}}
    </div>
  </div>
</div>

</div>

</html>


@endsection
@section('script')
  <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function del (id){
      axios.delete(`/news/contact/${id}`)
      .then(function(reponse){
        toastr.success(reponse.data.message)
        document.getElementById(`contact-${id}`).remove();
      })
      .catch(function(error){
        console.log(error);
        
        toastr.error(error.reponse.data.message)
      })
    }
</script>
@endsection