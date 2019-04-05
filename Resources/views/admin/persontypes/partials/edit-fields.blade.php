<div class="box-body">
  <div class='form-group{{ $errors->has("{$lang}.title") ? ' has-error' : '' }}'>
      {!! Form::label("{$lang}[title]", trans('itourism::persontypes.form.title')) !!}
      <?php $old = $persontypes->hasTranslation($lang) ? $persontypes->translate($lang)->title : '' ?>
      {!! Form::text("{$lang}[title]", old("{$lang}.title",$old), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('itourism::persontypes.form.title')]) !!}
      {!! $errors->first("{$lang}.title", '<span class="help-block">:message</span>') !!}
  </div>
  <div class='form-group{{ $errors->has("{$lang}.title") ? ' has-error' : '' }}'>
      {!! Form::label("{$lang}[description]", trans('itourism::persontypes.form.description')) !!}
      <?php $old = $persontypes->hasTranslation($lang) ? $persontypes->translate($lang)->description : '' ?>
      {!! Form::text("{$lang}[description]", old("{$lang}.description",$old), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('itourism::persontypes.form.description')]) !!}
      {!! $errors->first("{$lang}.description", '<span class="help-block">:message</span>') !!}
  </div>

</div>
