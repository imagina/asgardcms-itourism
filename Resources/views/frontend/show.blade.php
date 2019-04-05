@extends('layouts.master')

@section('meta')
    <!-- Schema.org Google+ -->

    <meta itemprop="name"
          content="{{$plan->title}}">
    <!-- Open Graph Facebook-->
    <meta property="og:title"
          content="{{$plan->title}}"/>
    <meta property="og:url" content="{{url($plan->slug)}}"/>
    <meta property="og:image"
          content="{{url(json_decode($plan->options)->mainimage ?? 'modules/itourism/img/product/default.jpg')}}"/>
    <meta property="og:description"
    <meta property="og:site_name" content="{{Setting::get('core::site-name') }}"/>
    <meta property="og:locale" content="{{config('asgard.iblog.config.oglocal')}}">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="{{ Setting::get('core::site-name') }}">
    <meta name="twitter:title"
          content="{{$plan->title}}">
    <meta name="twitter:creator" content="">
    <meta name="twitter:image:src"
          content="{{url(json_decode($plan->options)->mainimage ?? 'modules/itourism/img/product/default.jpg')}}">
@stop

@section('title')
    {{ $plan->title }} | @parent
@stop

@section('content')

    <div id="content_preloader" class="mt-4">
        <div id="preloader"></div>
    </div>

    <div id="layout-tourism" class="page blog-category-tourism">

        <!-- MIGA DE PAN  -->
        <div class="container">
            <div class="row justify-content-end mb-5">
                <div class="col-auto">
                    <nav class="mt-3" aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent rounded-0 mb-0">
                            <li class="breadcrumb-item">
                                <a class="text-primary" href="{{url('/')}}">Inicio</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{$plan->title}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-9 mb-5">


                    <div class="big-img">
                        @if(count($plan->gallery))
                            @include('itourism::frontend.widgets.gallery-images')
                        @else
                            @if(isset($plan->mainImage) && $plan->mainImage)
                                <img class="img-fluid w-100" src="{{url(json_decode($plan->options)->mainimage)}}">
                            @else
                                <img class="cover-img" src="{{url('modules/itourism/img/default.jpg')}}" alt="{{$plan->title}}"/>
                            @endif
                        @endif

                        <h1 class="title text-primary bg-white py-3 pl-0 pr-3 mb-4 d-flex align-items-center">
                            {{$plan->title}}
                        </h1>
                    </div>

                    <div class="description text-justify my-4 pb-4 border-style-uno">
                        {!!$plan->description !!}
                    </div>

                    @if(count($plan->roomPrice)>0)
                        <div class="row">
                            @foreach($plan->roomPrice as $roomPrice)
                                <div class="col-sm-6 col-md-4 room-price mb-4">
                                    <h4>
                                        <span class="badge badge-primary px-3 py-2">{{$roomPrice->personType->title}}</span>
                                    </h4>
                                    <p class="mb-0">{{$roomPrice->roomType->title}}</p>
                                    <p class="text-primary mb-0">{{$roomPrice->price}}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="border-style py-4 text-center">
                        <img class="img-fluid w-100" src="{{ Theme::url('img/publicidad2.jpg') }}">
                    </div>

                    <!--
                    <div class="description text-justify my-3">
                        Cosas que incluye el plan
                    </div>
                    -->

                    @include('itourism::frontend.widgets.compartir',array('url'=>$plan->url))


                    <div class="facebook-comments">
                        <div class="fb-comments"
                             data-href="{{url($plan->url)}}"
                             data-numposts="5" data-width="100%">
                        </div>
                    </div>

                    <div id="fb-root"></div>
                    <script>(function (d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) return;
                            js = d.createElement(s);
                            js.id = id;
                            js.src = "//connect.facebook.net/{{config('asgard.iblog.config.oglocale')}}/sdk.js#xfbml=1&version=v2.8";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));
                    </script>


                </div>
                <div class="col-xl-3 pb-4">



                    @include('itourism::frontend.widgets.availability')


                    <a class=" btn-rounded border border-primary text-primary mx-auto my-3" href=""><i
                                class="fa fa-phone"></i> LLamar</a>

                    <div class="border-style py-4 text-center mb-4">
                        <a href="">
                            <img class="img-fluid" src="{{ Theme::url('img/descarga.png') }}">
                        </a>
                    </div>

                    <img class="img-fluid w-100" src="{{ Theme::url('img/publicidad1.jpg') }}">


                </div>
            </div>
        </div>





{{--




                    <!-- IMAGEN PRODUCTO-->
                    <!-- Adriana, por lo que vi en el diseño en esta parte va es una galería y no la imagen principal -->
                    <!-- Las url de las imagenes las obtienes así: $plan->gallery -->
                    <!-- Eso te retornará un arreglo con las direcciones de las imagenes de la galería:  -->
                <!-- Tipo esto:
        array:3 [▼
          0 => "assets/itourism/plan/gallery/4/1.jpg"
          1 => "assets/itourism/plan/gallery/4/47.jpg"
          2 => "assets/itourism/plan/gallery/4/cedula.jpg"
        ]
        Como esto esto es a punta de puro blade y php, para mostrarlo aplicarías el facade url(''), ejemplo: {{url('assets/itourism/plan/gallery/4/cedula.jpg')}}
                        -->

        --}}




    </div>
@stop

@section('scripts')
    @parent
    <script type="text/javascript">
        /*console.log('now');*/
    </script>
@stop
