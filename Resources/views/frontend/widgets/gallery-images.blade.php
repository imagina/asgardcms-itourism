<div id="gallery-place" class="owl-carousel owl-arrow owl-theme">
    @foreach($plan->gallery as $image)

        <div class="item">

                <img class="img-fluid" src="{{asset($image)}}"
                     alt="{{$plan->title}}">

        </div>

    @endforeach
</div>

@section('scripts')
    @parent


    <script type="text/javascript">
        $(document).ready(function() {
            var owli = $('#gallery-place');

            owli.owlCarousel({
                margin: 0,
                nav: true,
                loop: true,
                dots: false,
                lazyContent: true,
                autoplay: false,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                responsive: {
                    0: {
                        items: 1
                    }
                }
            });
        });
    </script>
@stop

























