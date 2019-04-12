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
{!! Form::open(['route' => ['admin.itourism.plan.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
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
              <label>{{trans('itourism::plans.form.image')}}</label>
            </div>
            <div class="box-body">
              @include('itourism::admin.fields.image')
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 ">
        <div class="box box-primary">
          <div class="box-header">
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                class="fa fa-minus"></i>
              </button>
            </div>
            <div class="form-group">
              <label>{{trans('itourism::plans.form.document')}}</label>
            </div>
            <div class="box-body">
              <div class="text-center">
                <input type="file" accept="application/pdf" id="maindocument"
                name="maindocument"
                value=""
                class="form-control" >
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12">
        <div class="box box-primary">

          <div class="box-header">
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                class="fa fa-minus"></i>
              </button>
            </div>
            <div class="form-group">
              <label>{{ trans('itourism::plans.gallery.title') }} </label>
            </div>
            <div class="box-body text-center">
              <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">
                {{ trans('itourism::plans.gallery.add gallery') }}
              </button>
            </div>
          </div>

        </div>
      </div>
      <div class="col-xs-12">
        <div class="box box-primary">

          <div class="box-header">
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                class="fa fa-minus"></i>
              </button>
            </div>
            <div class="form-group">
              <label for="options[videos]"><strong>{{trans('itourism::plans.form.videos')}}</strong></label>
            </div>
            <div class="box-body text-center">
              <textarea id="options" class="form-control" name="options[videos]" rows="8">{{ old('options[videos]')}}</textarea>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <?php $rand = str_random(5);?>
  @php
  $field = array(
  'name' => 'gallery' ,
  'label' => 'Gallery',
  'label_drag' => trans('itourism::plans.form.drag'),
  'label_click' =>trans('itourism::plans.form.click'),
  'route_upload' => route('itourism.gallery.upload'),
  'route_delete' => route('itourism.gallery.delete'),
  'folder' => 'assets/itourism/plan/gallery/'
  );
  @endphp
  <input type="hidden" id="{{$field['name']}}" name="{{$field['name']}}" value="{{$rand}}">

</div>
{!! Form::close() !!}
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ trans('itourism::plans.gallery.title') }}</h4>
      </div>
      <div class="modal-body">
        @include('itourism::admin.plans.partials.gallery-img')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('itourism::plans.gallery.ready') }}</button>
      </div>
    </div>
  </div>
</div>
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

function checkRepeated(roomType,personType){
  for(var i=0;i<prices.length;i++){
    if(prices[i].roomType==roomType && prices[i].personType==personType)
    return true;
  }

  return false;
}//checkRepeated()

function createCombination(){
  var price=$('#price').val();
  var nightPrice=$('#nightPrice').val();
  var roomType=$('#roomtype_id').val();
  var roomTypeText=$('#roomtype_id').find('option:selected').text();
  var personType=$('#persontype_id').val();
  var personTypeText=$('#persontype_id').find('option:selected').text();
  if(!checkRepeated(roomType,personType)){
    if((price!="" && parseInt(price)>0) && (nightPrice!="" && parseInt(nightPrice)>=0)){
      prices.push({
        nightPrice,
        price,
        roomType,
        roomTypeText,
        personTypeText,
        personType
      });
      $('#price').val(1);
      $('#nightPrice').val(1);
      loadBodyTable();
    }//conditional
  }else
  alert('Ya existe esta combinación.');
}//createCombination()

function deleteConfigPrice(position){
  prices.splice(position,1);
  loadBodyTable();
}//deleteConfigPrice()

function loadBodyTable(){
  var html='';
  for(var i=0;i<prices.length;i++){
    html+='<tr>';
    html+='<td>'+prices[i].roomTypeText+'</td>';
    html+='<td>'+prices[i].personTypeText+'</td>';
    html+='<td>'+prices[i].price+'</td>';
    html+='<td>'+prices[i].nightPrice+'</td>';
    html+='<td><button type="button" class="btn btn-danger" onclick="deleteConfigPrice('+i+')"><i class="fa fa-times"></i> </button></td>';
    html+='</tr>';
  }//for
  $('#prices tbody').html(html);
  var priceArray=JSON.stringify(prices);
  $('#pricesArray').val(priceArray);
}//loadBodyTable()
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
