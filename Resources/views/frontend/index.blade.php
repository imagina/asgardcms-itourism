@extends('layouts.master')

@section('title')
    {{ $plan->title ?? "Plans" }} | @parent
@stop

@section('content')

    <div id="layout-tourism" class="page blog-category-tourism">

        <div class="banner">
            <div class="container">
                <div class="row justify-content-start align-items-end">
                    <div class="col-lg-5">
                        <div class="text-white my-0">
                            ¿Ya planeaste
                            tu próximo destino?
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-end mb-5">
                <div class="col-auto">
                    <nav class="mt-3" aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent rounded-0 mb-0">
                            <li class="breadcrumb-item">
                                <a class="text-primary" href="{{url('/')}}">Inicio</a>
                            </li>
                            <li class="breadcrumb-item active text-gray-color" aria-current="page">
                                @if(isset($plan->title) && !empty($plan->title))
                                    {{$plan->title}}
                                @else
                                    Lugares
                                @endif
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="container mb-5">
            <div class="row">

                <div class="col-12 text-center">
                    <h2 class="places-title text-gray-dark mb-5">
                        @if(isset($plan->title) && !empty($plan->title))
                            {{$plan->title}}
                        @else
                            TURISMO
                        @endif
                    </h2>
                </div>

                @if (isset($plans) && !empty($plans))
                    @if(count($plans) >= 1)
                        @foreach($plans as $plan)

                            <div class="col-md-6 col-lg-4 mb-5">
                                <div class="place-imagen d-block position-relative">
                                    <a href="{{url('itourism/'.$plan->slug)}}">
                                        @if(isset($plan->mainImage) && $plan->mainImage)
                                            <img class="cover-img" src="{{ url($plan->mainImage)}}"
                                             alt="{{$plan->title}}">
                                        @else
                                            <img class="cover-img" src="{{url('modules/itourism/img/default.jpg')}}" alt="{{$plan->title}}"/>
                                        @endif

                                        <img class="right-badge position-absolute" src="{{ Theme::url('img/esquina.png') }}">
                                    </a>
                                </div>
                                <h3 class="place-title text-center text-gray-dark my-3">
                                    <a href="{{url('itourism/'.$plan->slug)}}">
                                        {{$plan->title}}
                                    </a>
                                </h3>
                            </div>

                        @endforeach
                        <div id="pagination" class="col-12">
                            <div class="pagination paginacion-blog text-center row">
                                <div class="pull-right">
                                   {{$plans->links('pagination::bootstrap-4')}}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-12">
                            <h4 class="text-center">
                                No hay lugares con esta(s) categoría(s) <i class="fa fa-frown-o"></i>
                            </h4>
                        </div>
                    @endif
                @endif
            </div>


        </div>

    </div>
@stop
