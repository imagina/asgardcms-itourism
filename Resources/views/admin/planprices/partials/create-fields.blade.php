<div class="box-body row">
  <div class="form-group col-md-4">
    <strong>Price:</strong>
    <input type="number" style="text-align:center;" required class="form-control" required name="price" step="0.01" min="1" value="" id="price_product">
  </div>
  <div class="form-group col-md-4">
    <strong>{{ trans('itourism::persontypes.button.select a person types') }}</strong>
    <select class="form-control" name="persontype_id">
      @foreach($persontypes as $persontype)
        <option value="{{$persontype->id}}">{{$persontype->title}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group col-md-4">
    <strong>{{ trans('itourism::roomtypes.button.select a room types') }}</strong>
    <select class="form-control" name="roomtype_id">
      @foreach($roomtypes as $roomtype)
        <option value="{{$roomtype->id}}">{{$roomtype->title}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group col-md-4">
    <strong>{{ trans('itourism::plans.button.select a plan') }}</strong>
    <select class="form-control" name="plan_id">
      @foreach($plans as $plan)
        <option value="{{$plan->id}}">{{$plan->title}}</option>
      @endforeach
    </select>
  </div>
</div>
