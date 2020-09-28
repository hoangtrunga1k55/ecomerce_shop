<div class="brands">
    <div class="small-container">
        <div class="row">
            @foreach($brands as $brand)
            <div class="col-5">
                <img src="{{$brand->img}}" alt="">
            </div>
                @endforeach
        </div>
    </div>
</div>
