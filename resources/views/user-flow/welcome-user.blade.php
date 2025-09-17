@extends('user-flow.master')
@section('content') 
@include('user-flow.components.coursel',$last_news)
<!-- Page Content -->
<section>

    <div class="container">

        <h3 class="my-4">Last News</h3>
    <div class="row">
        <!-- Marketing Icons Section -->
        @foreach ($last_news as $item)
            
                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                        <h4 class="card-header">{{$item->title}}</h4>
                        <div class="card-body">
                            <p class="card-text">{{$item->description}}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('user-view.show',$item->id)}}" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>
            
        @endforeach
        </div>
        <!-- /.row -->
    </div>
</section>
{{--  هنا قمت بارسال بيانات مصفوفة تحتوي على مصفوفات محتوى كل وحدة هو الاسم وقيمته هو قيمة اسم الكاتيجوري  وايضا الاخبار وقيمتها مودل ناتج عن كويري البحث حسب الكاتيجوري  --}}
@foreach ($all_news as $item)
    <section class="@if ($loop->even)
            white-sec
        @else gray-sec
         @endif">
    <div class="container">
        <!-- category Section -->
        <h3 class="my-4">{{$item['name']}}</h3>
        <div class="row">
        @foreach ($item['news'] as $news)
            
                <div class="col-lg-4 col-sm-6 portfolio-item">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="{{Storage::url($news->images->first()->path)}}" alt="{{$news->images->first()->alt_txt}}"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">{{$news->title}}</a>
                            </h4>
                            <p class="card-text">{{$news->description}}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('user-view.show',$news->id)}}" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>  
                </div>

        @endforeach
        </div> 
        <div align="center"><a class="btn btn-success" href="{{route('user-view.showByCat',$item['news'][0]->category->id)}}">more news</a></div>
    </div>
</section>
@endforeach
<section>
    <div class="container">
        <!--  Section -->
        <div class="row">
            <div class="col-lg-6">
                <h3>main news title</h3>
                <p>The Modern Business template by Start Bootstrap includes:</p>
                <ul>
                    <li>
                        <strong>Bootstrap v4</strong>
                    </li>
                    <li>jQuery</li>
                    <li>Font Awesome</li>
                    <li>Working contact form with validation</li>
                    <li>Unstyled page elements for easy customization</li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, omnis doloremque non cum id
                    reprehenderit, quisquam totam aspernatur tempora minima unde aliquid ea culpa sunt. Reiciendis quia
                    dolorum ducimus unde.</p>
            </div>
            <div class="col-lg-6">
                <img class="img-fluid rounded full-width" src="img/6.jpeg" alt="" style="">
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Call to Action Section -->
        <div class="row mb-4">
            <div class="col-md-8">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum
                    deleniti
                    beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
            </div>
            <div class="col-md-4">
                <a class="btn btn-lg btn-secondary btn-block" href="#">contact us</a>
            </div>
        </div>
    </div>
    <!-- /.container -->

</section>
@endsection