@if(count($plans)!=0)
<div class="other-places my-4">
    <h3 class="h3 mb-3">Tal véz te puede interesar...</h3>
    <div id="other-places" class="owl-carousel owl-theme">
        @foreach($plans as $p)
        <div class="item">
            <a class="place-imagen d-block position-relative" href="{{$p->slug}}">
              @if(isset($p->mainImage) && $p->mainImage)
                    <img class="cover-img" src="{{url($p->mainImage)}}"
                         alt="{{$p->title}}">
                @else
                    <img class="cover-img" src="{{url('modules/iblog/img/post/default.jpg')}}" alt="{{$p->title}}"/>
                @endif
                <img class="right-badge position-absolute" src="{{ Theme::url('img/esquina.png') }}">
            </a>
            <h3 style="text-align:center">{{$p->title}}</h3>
        </div>
        @endforeach
    </div>
</div>
@endif

@section('scripts-owl')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            var owl = $('#other-places');

            owl.owlCarousel({
                loop: false,
                margin: 20,
                responsiveClass: true,
                dots: false,
                nav: true,
                navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 3
                    }
                }
            });
        });
    </script>
@stop
