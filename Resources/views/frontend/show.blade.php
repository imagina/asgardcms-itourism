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
          <img class="cover-img" src="{{url('modules/itourism/img/default.jpg')}}"
          alt="{{$plan->title}}"/>
          @endif
          @endif

          <h1 class="title text-primary bg-white py-3 pl-0 pr-3 mb-4 d-flex align-items-center">
            {{$plan->title}}
          </h1>
        </div>

        <div class="description text-justify my-4 pb-4">
          {!!$plan->description !!}
        </div>

        @if($plan->videos)
        <div class="border-style mb-1">
          <br>
          @include('itourism::frontend.widgets.gallery-videos')
        </div>
        @endif

        @if(count($plan->roomPrice)>0)
        <div class="row">
          @foreach($plan->roomPrice as $roomPrice)
          <div class="col-sm-6 col-md-4 room-price mb-4">
            <h4>
              <span class="tag">{{$roomPrice->personType->title}}</span>
            </h4>
            <p class="mb-0">{{$roomPrice->roomType->title}}</p>
            <p class="text-primary mb-0">$ {{$roomPrice->price}}</p>
            <p class="mb-0">Precios por persona.</p>
            @if($roomPrice->additional_night_price && $roomPrice->additional_night_price>0)
            <p class="mb-0">Noche adicional en hotel:</p>
            <p class="text-primary mb-0">$ {{$roomPrice->additional_night_price}}</p>
            @endif
          </div>
          @endforeach
        </div>
        @endif

        <div class="border-style py-4 mb-4 text-center">
          <img class="img-fluid w-100" src="{{ Theme::url('img/publicidad2.jpg') }}">
        </div>


        @if($plan->includes)
        <div class="col-12 text-justify mb-3 description">
          <h2 class="title-incluye mb-2">El plan incluye:</h2>
          {!!$plan->includes !!}
        </div>
        @endif

        @if($plan->notincludes)
        <div class="col-12 text-justify mb-3 description">
          <h2 class="title-incluye mb-2">El plan no incluye:</h2>
          {!!$plan->notincludes !!}
        </div>
        @endif
        @if($plan->notes)
        <div class="col-12 text-justify mb-3 description">
          <h2 class="title-incluye mb-2">Notas importantes:</h2>
          {!!$plan->notes !!}
        </div>
        @endif
        @if($plan->payforms)
        <div class="col-12 text-justify mb-3 description">
          <h2 class="title-incluye mb-2">Formas de pago:</h2>
          {!!$plan->payforms !!}
        </div>
        @endif

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
      @include('itourism::frontend.widgets.other-places')

    </div>
    <div class="col-xl-3 pb-4">


      @include('itourism::frontend.widgets.availability')


      <div class="border-style-uno">
        <a class=" btn-rounded  border border-primary text-primary mx-auto my-3" href=""><i
          class="fa fa-phone"></i> LLamar</a>
        </div>

        <div class="phone text-center py-4">
          <p class="mb-2"><a href="tel:4444494"><i class="fa fa-phone-square mr-2"></i> 444 44 94</a> </p>
          <p><a href="https://api.whatsapp.com/send?phone=573168753305&text=Requiero%20una%20cita%20para%20recibir%20asesor&#xED;a%20personalizada"><i class="fa fa-whatsapp mr-2"></i> 316 875 3305</a></p>
        </div>

        @if(isset($plan->document) && $plan->document)
        <div class="border-style py-4 text-center mb-4">
          <a download href="{{url($plan->document)}}">
            <img class="img-fluid" src="{{ Theme::url('img/descarga.png') }}">
          </a>
        </div>
        @endif
        <img class="img-fluid w-100" src="{{ Theme::url('img/publicidad1.jpg') }}">

      </div>
    </div>
  </div>

</div>
@stop

@section('scripts')
@parent
<script type="text/javascript">
/*console.log('now');*/
</script>




@stop
