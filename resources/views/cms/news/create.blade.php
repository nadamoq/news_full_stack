@extends('cms.master-admin')
@section('style')
      <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper" style="min-height: 1345.6px;">
   
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add news</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id='form'>
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Enter title">
                  </div>
                  <div class="form-group">
                    <label for="category">category</label>
                    <select class="form-control" id="category">
                      @foreach($category as $item)
                      <option value='{{$item->id}}'>{{$item->name}}</option>                          
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="description">description</label>
                    <input type="text" class="form-control" id="description" placeholder="description">
                  </div>
                  <div class="form-group">
                    <label for="content">content</label>
                    <textarea id="editor" name="content">{{ old('content') }}</textarea>
                  </div>
                  
                  <div class="form-group">
                    <label for="images">images</label>
                    <div id="preview"></div>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input"id='images'name='images[]'multiple accept="images/*">
                        <label class="custom-file-label" for="images">Choose images</label>
                        
                      </div>
                      
                    </div>
                  </div>
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" class="btn btn-primary"onclick='addNews()'>Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          

      

          </div>
          <!--/.col (left) -->
          <!-- right column -->
      
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
  @section('script')
  <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
 <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
 <script>
  // خزن نسخة CKEditor في متغيّر ck
let ck = null;
ClassicEditor.create(document.querySelector('#editor'))
  .then(instance => { ck = instance; })
  .catch(console.error);

    let file=document.getElementById('images');
     let view=document.getElementById('preview');
     file.addEventListener('change',()=>{
      
      for(const image of file.files){
        const p=document.createElement('p');
        p.textContent=image.name;
        view.appendChild(p);
      }
     })
   
     function addNews(){
        let form=new FormData();

        form.append('title',document.getElementById('title').value);
      
        form.append('category_id',document.getElementById('category').value);
        form.append('content', ck.getData());
        form.append('description',document.getElementById('description').value);

          let images=document.getElementById('images').files;
        for(let i=0;i<images.length;i++){
          form.append('images[]',images[i]);
        }
        axios.post('{{route('news.store')}}',form)
            .then(function(response){
            toastr.success(response.data.message);
            document.getElementById('form').reset();
            ck.setData('');
            file.value = '';       // صفّر ملفّات input
            view.innerHTML = '';  
            })
            .catch(function(error){
            console.log(error)
            toastr.error(error.response.data.message);
            })}
        
     
     </script>
  @endsection
  