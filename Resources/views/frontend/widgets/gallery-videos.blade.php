@if($plan->videos)
    <div id="{{$plan->id}}-video-place" class="owl-carousel owl-theme owl-video-place">
        @foreach($plan->videos as $video)
        @php
        $video=str_replace('"',"",$video);
        $video=str_replace('\\','',$video);
        @endphp
            <div class="item">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{youtubeID($video)}}" allowfullscreen></iframe>
                </div>
            </div>
        @endforeach
    </div>

@section('scripts')
    @parent


    <script type="text/javascript">
        $(document).ready(function () {
            var owl = $('#{{$plan->id}}-video-place');

            owl.owlCarousel({
                margin: 0,
                nav: false,
                dots: true,
                loop: true,
                lazyContent: true,
                autoplay: false,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    }
                }
            });
        });
    </script>
@stop


@endif
