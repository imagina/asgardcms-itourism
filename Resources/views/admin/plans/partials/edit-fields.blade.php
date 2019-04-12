<div class="box-body">
  <div class='form-group{{ $errors->has("{$lang}.title") ? ' has-error' : '' }}'>
      {!! Form::label("{$lang}[title]", trans('itourism::persontypes.form.title')) !!}
      <?php $old = $plan->hasTranslation($lang) ? $plan->translate($lang)->title : '' ?>
      {!! Form::text("{$lang}[title]", old("{$lang}.title",$old), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('itourism::persontypes.form.title')]) !!}
      {!! $errors->first("{$lang}.title", '<span class="help-block">:message</span>') !!}
  </div>
  <div class='form-group{{ $errors->has("{$lang}.title") ? ' has-error' : '' }}'>
    <?php $old = $plan->hasTranslation($lang) ? $plan->translate($lang)->description : '' ?>
    @editor('description', trans('itourism::persontypes.form.description'), old("{$lang}.description",$old), $lang)
      {!! $errors->first("{$lang}.description", '<span class="help-block">:message</span>') !!}
  </div>
  <div class='form-group{{ $errors->has("{$lang}.includes") ? ' has-error' : '' }}'>
    <?php $old = $plan->hasTranslation($lang) ? $plan->translate($lang)->includes : '' ?>
    @editor('includes', trans('itourism::plans.form.include'), old("{$lang}.includes",$old), $lang)
    {!! $errors->first("{$lang}.includes", '<span class="help-block">:message</span>') !!}
  </div>
  <div class='form-group{{ $errors->has("{$lang}.notincludes") ? ' has-error' : '' }}'>
    <?php $old = $plan->hasTranslation($lang) ? $plan->translate($lang)->notincludes : '' ?>
    @editor('notincludes', trans('itourism::plans.form.notincludes'), old("{$lang}.notincludes",$old), $lang)
    {!! $errors->first("{$lang}.notincludes", '<span class="help-block">:message</span>') !!}
  </div>
  <div class='form-group{{ $errors->has("{$lang}.notes") ? ' has-error' : '' }}'>
    <?php $old = $plan->hasTranslation($lang) ? $plan->translate($lang)->notes : '' ?>
    @editor('notes', trans('itourism::plans.form.notes'), old("{$lang}.notes",$old), $lang)
    {!! $errors->first("{$lang}.notes", '<span class="help-block">:message</span>') !!}
  </div>
  <div class='form-group{{ $errors->has("{$lang}.payforms") ? ' has-error' : '' }}'>
    <?php $old = $plan->hasTranslation($lang) ? $plan->translate($lang)->payforms : '' ?>
    @editor('payforms', trans('itourism::plans.form.payforms'), old("{$lang}.payforms",$old), $lang)
    {!! $errors->first("{$lang}.payforms", '<span class="help-block">:message</span>') !!}
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
                      <?php $old = $plan->hasTranslation($lang) ? $plan->translate($lang)->metatitle : '' ?>
                      {!! Form::text("{$lang}[metatitle]", old("{$lang}.metatitle", $old), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('itourism::common.form.metatitle')]) !!}
                      {!! $errors->first("{$lang}.metatitle", '<span class="help-block">:message</span>') !!}
                  </div>

                  <div class='form-group{{ $errors->has("{$lang}.metakeywords") ? ' has-error' : '' }}'>
                      {!! Form::label("{$lang}[metakeywords]", trans('itourism::common.form.metakeywords')) !!}
                      <?php $old = $plan->hasTranslation($lang) ? $plan->translate($lang)->metatitle : '' ?>
                      {!! Form::text("{$lang}[metakeywords]", old("{$lang}.metakeywords", $old), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('itourism::common.form.metakeywords')]) !!}
                      {!! $errors->first("{$lang}.metakeywords", '<span class="help-block">:message</span>') !!}
                  </div>

                  <?php $old = $plan->hasTranslation($lang) ? $plan->translate($lang)->metadescription : '' ?>
                  @editor('content', trans('itourism::common.form.metadescription'), old("$lang.metadescription",
                  $old),
                  $lang)
              </div>
          </div>
      </div>
  </div>
</div>
