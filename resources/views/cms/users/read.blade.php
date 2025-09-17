@extends('cms.master-admin')
@section('content')
<div class="content-wrapper" style="min-height: 1345.6px;">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>name</th>
                      <th>email</th>
                      <th>email status</th>
                      <th >role</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $item)
                        
                 
                    <tr>
                      <td>{{$loop->index+1}}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->email}}</td>
                      <td>{{$item->email_has_verified}}</td>
                      <td>{{$item->role}}</td>
                    </tr>
                    @endforeach
            
                  </tbody>
                </table>
              </div>
           
              <!-- /.card-body -->
              <div class="card-footer clearfix">  
                 {{$data->links()}}
                
              </div>
            </div> 
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
    
        </div>
     
      
      </div><!-- /.container-fluid -->
    </section>
@endsection