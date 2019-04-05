<div class="box-body row">
  <div class="form-group col-md-4">
    <strong>Price:</strong>
    <input type="number" style="text-align:center;" required class="form-control" value="{{$planprice->price}}" required name="price" step="0.01" min="1" value="" id="price_product">
  </div>
  <div class="form-group col-md-4">
    <strong>{{ trans('itourism::persontypes.button.select a person types') }}</strong>
    <select class="form-control" name="persontype_id">
      @foreach($persontypes as $persontype)
        <option value="{{$persontype->id}}" @if($persontype->id==$planprice->persontype_id) selected @endif>{{$persontype->title}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group col-md-4">
    <strong>{{ trans('itourism::roomtypes.button.select a room types') }}</strong>
    <select class="form-control" name="roomtype_id">
      @foreach($roomtypes as $roomtype)
        <option value="{{$roomtype->id}}" @if($roomtype->id==$planprice->roomtype_id) selected @endif>{{$roomtype->title}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group col-md-4">
    <strong>{{ trans('itourism::plans.button.select a plan') }}</strong>
    <select class="form-control" name="plan_id">
      @foreach($plans as $plan)
        <option value="{{$plan->id}}" @if($plan->id==$planprice->plan_id) selected @endif>{{$plan->title}}</option>
      @endforeach
    </select>
  </div>
</div>
