@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('itourism::plans.title.create plan') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.itourism.plan.index') }}">{{ trans('itourism::plans.title.plans') }}</a></li>
        <li class="active">{{ trans('itourism::plans.title.create plan') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.itourism.plan.store'], 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-9">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                    </button>
                </div>
                <div class="nav-tabs-custom">
                    @include('partials.form-tab-headers')
                    <div class="tab-content">
                        <?php $i = 0; ?>
                        @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                            <?php $i++; ?>
                            <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                                @include('itourism::admin.plans.partials.create-fields', ['lang' => $locale])
                            </div>
                        @endforeach
                    </div>
                </div> {{-- end nav-tabs-custom --}}
              </div>
            </div>
          @include('itourism::admin.plans.partials.extra-fields-create')
        </div>
        <input type="hidden" name="prices" id="pricesArray" value="">
        </div>
        <div class="col-md-3">
            <div class="row">
              <div class="col-xs-12 ">
                  <div class="box box-primary">
                      <div class="box-header">
                          <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                          class="fa fa-minus"></i>
                              </button>
                          </div>
                          <div class="form-group">
                              <label>Image</label>
                          </div>
                          <div class="box-body">
                            @include('itourism::admin.fields.image')
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
        @php
            $field = array(
                'name' => 'gallery' ,
                'label' => 'Gallery',
                'label_drag' => trans('iblog::post.form.drag'),
                'label_click' =>trans('iblog::post.form.click'),
                'route_upload' => route('itourism.gallery.upload'),
                'route_delete' => route('itourism.gallery.delete'),
                'folder' => 'assets/itourism/plan/gallery/'
            );
        @endphp
        @if(isset($plan))
            <?php $rand = $plan->id;?>
        @else
            <?php $rand = str_random(5);?>
            <input type="hidden" id="{{$field['name']}}" name="{{$field['name']}}" value="{{$rand}}">
        @endif
    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
    var prices=[];
    function createCombination(){
      var price=$('#price').val();
      var roomType=$('#roomtype_id').val();
      var roomTypeText=$('#roomtype_id').find('option:selected').text();
      var personType=$('#persontype_id').val();
      var personTypeText=$('#persontype_id').find('option:selected').text();
      prices.push({
        price,
        roomType,
        roomTypeText,
        personTypeText,
        personType
      });
      $('#price').val(1);
      loadBodyTable();
    }
    function deleteConfigPrice(position){
      prices.splice(position,1);
      loadBodyTable();
    }
    function loadBodyTable(){
      var html='';
      for(var i=0;i<prices.length;i++){
        html+='<tr>';
        html+='<td>'+prices[i].roomTypeText+'</td>';
        html+='<td>'+prices[i].personTypeText+'</td>';
        html+='<td>'+prices[i].price+'</td>';
        html+='<td><button type="button" class="btn btn-danger" onclick="deleteConfigPrice('+i+')"><i class="fa fa-times"></i> </button></td>';
        html+='</tr>';
      }//for
      $('#prices tbody').html(html);
      var priceArray=JSON.stringify(prices);
      $('#pricesArray').val(priceArray);
    }
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.itourism.plan.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@endpush
