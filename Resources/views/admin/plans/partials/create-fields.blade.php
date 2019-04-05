<div class="box-body">
  <div class='form-group{{ $errors->has("{$lang}.title") ? ' has-error' : '' }}'>
      {!! Form::label("{$lang}[title]", trans('itourism::persontypes.form.title')) !!}
      {!! Form::text("{$lang}[title]", old("{$lang}.title"), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('itourism::persontypes.form.title')]) !!}
      {!! $errors->first("{$lang}.title", '<span class="help-block">:message</span>') !!}
  </div>
  <div class='form-group{{ $errors->has("{$lang}.description") ? ' has-error' : '' }}'>
    @editor('description', trans('itourism::persontypes.form.description'), old("{$lang}.description"), $lang)
    {{--
      {!! Form::label("{$lang}[description]", trans('itourism::persontypes.form.description')) !!}
      {!! Form::text("{$lang}[description]", old("{$lang}.description"), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('itourism::persontypes.form.description')]) !!}
      {!! $errors->first("{$lang}.description", '<span class="help-block">:message</span>') !!}
      --}}
  </div>
  <div class="col-xs-12" style="padding-top: 35px;">
      <div class="panel box box-primary">
          <div class="box-header">
              <div class="box-tools pull-right">
                  <a href="#aditional{{$lang}}" class="btn btn-box-tool" data-target="#aditional{{$lang}}"
                     data-toggle="collapse"><i class="fa fa-plus"></i>
                  </a>
              </div>
              <label>{{ trans('itourism::common.form.metadata')}}</label>
          </div>
          <div class="panel-collapse collapse in" id="aditional{{$lang}}">
              <div class="box-body">
                  <div class='form-group{{ $errors->has("{$lang}.metatitle") ? ' has-error' : '' }}'>
                      {!! Form::label("{$lang}[metatitle]", trans('itourism::common.form.metatitle')) !!}
                      {!! Form::text("{$lang}[metatitle]", old("{$lang}.metatitle"), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('itourism::common.form.metatitle')]) !!}
                      {!! $errors->first("{$lang}.metatitle", '<span class="help-block">:message</span>') !!}
                  </div>

                  <div class='form-group{{ $errors->has("{$lang}.metakeywords") ? ' has-error' : '' }}'>
                      {!! Form::label("{$lang}[metakeywords]", trans('itourism::common.form.metakeywords')) !!}
                      {!! Form::text("{$lang}[metakeywords]", old("{$lang}.metakeywords"), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('itourism::common.form.metakeywords')]) !!}
                      {!! $errors->first("{$lang}.metakeywords", '<span class="help-block">:message</span>') !!}
                  </div>

                  @editor('metadescription', trans('itourism::common.form.metadescription'),
                  old("{$lang}.metadescription"), $lang)
              </div>
          </div>
      </div>
  </div>
</div>