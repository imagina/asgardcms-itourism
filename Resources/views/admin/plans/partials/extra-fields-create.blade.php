<div class="col-xs-12">
  <div class="box box-primary">

    <div class="box-header">
      <h3 class="box-title">{{trans("itourism::common.title.combination")}}</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
    </div>

    <div class="box-body ">
      <div class="row">

        <div class="col-xs-3 text-center">
          <div class="box">
            <div class="box-header">
              <div class="form-group">
                <label>{{ trans('itourism::persontypes.button.select a person types') }}</label>
              </div>
            </div>
            <div class="box-body">
              <div class='form-group{{ $errors->has("persontype_id") ? ' has-error' : '' }}'>
                <select class="form-control" id="persontype_id" >
                  @foreach($persontypes as $persontype)
                  <option value="{{$persontype->id}}">{{$persontype->title}}</option>
                  @endforeach
                </select>
                {!! $errors->first("persontype_id", '<span class="help-block">:message</span>') !!}
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-3 text-center">
          <div class="box">
            <div class="box-header">
              <div class="form-group">
                <label>{{ trans('itourism::roomtypes.button.select a room types') }}</label>
              </div>
            </div>
            <div class="box-body">
              <div class='form-group{{ $errors->has("roomtype_id") ? ' has-error' : '' }}'>
                <select class="form-control" id="roomtype_id">
                  @foreach($roomtypes as $roomtype)
                  <option value="{{$roomtype->id}}">{{$roomtype->title}}</option>
                  @endforeach
                </select>
                {!! $errors->first("roomtype_id", '<span class="help-block">:message</span>') !!}
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-2 text-center">
          <div class="box">
            <div class="box-header">
              <div class="form-group">
                <label>{{ trans('itourism::common.table.price') }}</label>
              </div>
            </div>
            <div class="box-body">
              <input type="number" style="text-align:center;" required class="form-control" id="price" step="0.01" min="1" value="1" >
              <br>
            </div>
          </div>
        </div>
        <div class="col-xs-2 text-center">
          <div class="box">
            <div class="box-header">
              <div class="form-group">
                <label>{{ trans('itourism::planprices.table.aditional night price') }}</label>
              </div>
            </div>
            <div class="box-body">
              <input type="number" style="text-align:center;" required class="form-control" id="nightPrice" step="0.01" min="1" value="1" >
              <br>
            </div>
          </div>
        </div>
        <div class="col-xs-2 text-center">
          <div class="box">
            <div class="box-header">
              <div class="form-group">
                <label>{{ trans('core::core.table.actions') }}</label>
              </div>
            </div>
            <div class="box-body">
              <button onclick="createCombination()" type="button" class="btn btn-success" name="button">
                <i class="fa fa-plus"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="form-group">
                <label>{{ trans('itourism::common.table.prices') }}</label>
              </div>
            </div>
            <div class="box-body">
              <table id="prices" class="table table-bordered">
                <thead>
                  <tr>
                    <th>{{ trans('itourism::common.table.room type') }}</th>
                    <th>{{ trans('itourism::common.table.person type') }}</th>
                    <th>{{ trans('itourism::common.table.price') }}</th>
                    <th>{{ trans('itourism::planprices.table.aditional night price') }}</th>
                    <th>{{ trans('core::core.table.actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="box-footer">
      <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
      <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.itourism.plan.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
  </div>
</div>
