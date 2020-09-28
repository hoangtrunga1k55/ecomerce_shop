<div class="testimonial">
    <div class="small-container">
        <div class="row">
            @foreach($testimonials as $testimonial)
            <div class="col-3">
                <i class="fa fa-quote-left"></i>
                <p>
                    {{$testimonial->content}}
                </p>
                <div class="rating">
                    @for($i=0;$i<$testimonial->numberOfStar;$i++)
                        <i class="fa fa-star"></i>
                        @endfor
                </div>
                <img src="{{$testimonial->User->img}}" alt="">
                <h3>{{$testimonial->User->name}}</h3>
            </div>
                @endforeach
        </div>
    </div>
</div>
