<?php

namespace Modules\Itourism\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Itourism\Entities\Plan;
use Modules\Itourism\Http\Requests\CreatePlanRequest;
use Modules\Itourism\Http\Requests\UpdatePlanRequest;
use Modules\Itourism\Repositories\PlanRepository;
use Modules\Itourism\Repositories\PlanPriceRepository;
use Modules\Itourism\Repositories\PersonTypesRepository;
use Modules\Itourism\Repositories\RoomTypesRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Itourism\Events\PlanWasUpdated;

class PlanController extends AdminBaseController
{
  /**
  * @var PlanRepository
  */
  private $plan;
  private $roomtypes;
  private $persontypes;
  public function __construct(PersonTypesRepository $persontypes,RoomTypesRepository $roomtypes,PlanRepository $plan)
  {
    parent::__construct();
    $this->persontypes = $persontypes;
    $this->roomtypes = $roomtypes;
    $this->plan = $plan;
  }

  /**
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function index()
  {
    $plans = $this->plan->all();
    return view('itourism::admin.plans.index', compact('plans'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return Response
  */
  public function create()
  {
    $roomtypes = $this->roomtypes->all();
    $persontypes = $this->persontypes->all();
    if(count($roomtypes)==0 || count($persontypes)==0){
      return redirect()->back()
      ->withError(trans('itourism::plans.validation.error some roomtype and persontype'));
    }//if count
    return view('itourism::admin.plans.create',compact('roomtypes','persontypes'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  CreatePlanRequest $request
  * @return Response
  */
  public function store(CreatePlanRequest $request)
  {
    $data=$request->all();
    $this->plan->create($data);

    return redirect()->route('admin.itourism.plan.index')
    ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('itourism::plans.title.plans')]));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  Plan $plan
  * @return Response
  */
  public function edit(Plan $plan)
  {
    // dd($plan);
    $roomtypes = $this->roomtypes->all();
    $persontypes = $this->persontypes->all();
    $roomPrices=$plan->roomPrice;
    foreach($roomPrices as &$roomPrice){
      $roomPrice['roomTypeText']=$roomPrice->roomType->title;
      $roomPrice['roomType']=$roomPrice->roomType->id;
      $roomPrice['personTypeText']=$roomPrice->personType->title;
      $roomPrice['personType']=$roomPrice->personType->id;
      $roomPrice['nightPrice']=$roomPrice->additional_night_price;
    }//foreach
    return view('itourism::admin.plans.edit', compact('plan','roomtypes','persontypes'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  Plan $plan
  * @param  UpdatePlanRequest $request
  * @return Response
  */
  public function update(Plan $plan, UpdatePlanRequest $request)
  {
    $data=$request->all();
    $data['created_at']=\Carbon\Carbon::parse($data['created_at']);
    $data['oldOptions']=$plan->options;
    /*
    array:8 [▼
      "_method" => "PUT"
      "_token" => "2l5AZn1tqkJYoynFruL9F5t4mObJr8mgeUh287kl"
      "es" => array:10 [▶]
      "prices" => "[{"id":2,"plan_id":"4","roomtype_id":"1","persontype_id":"1","price":"5313.00","additional_night_price":"1.00","created_at":"2019-04-15 01:59:25","updated_at":" ▶"
      "mainimage" => "assets/itourism/plan/4.jpg"
      "options" => array:1 [▼
        "videos" => "https://www.youtube.com/watch?v=omox9IUdHEo"
      ]
      "created_at" => Carbon @1555293562 {#1264 ▶}
      "oldOptions" => {#1253 ▼
        +"videos": "https://www.youtube.com/watch?v=omox9IUdHEo"
        +"mainimage": "assets/itourism/plan/4.jpg"
        +"document": "assets/itourism/plan/4.pdf"
      }
    */
    // $mainimage=$data['mainimage'];
    // unset($data['mainimage']);
    // dd($data);
    $plan->update($data);
    // $data['mainimage']=$mainimage;
    event(new PlanWasUpdated($plan, $data));

    return redirect()->route('admin.itourism.plan.index')
    ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('itourism::plans.title.plans')]));
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  Plan $plan
  * @return Response
  */
  public function destroy(Plan $plan)
  {
    $this->plan->destroy($plan);

    return redirect()->route('admin.itourism.plan.index')
    ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('itourism::plans.title.plans')]));
  }

  public function uploadGalleryimage(Request $request)
  {

      $original_filename = $request->file('file')->getClientOriginalName();

      $idpost = $request->input('idedit');
      $extension = $request->file('file')->getClientOriginalExtension();
      $allowedextensions = array('JPG', 'JPEG', 'PNG', 'GIF');

      if (!in_array(strtoupper($extension), $allowedextensions)) {
          return 0;
      }
      $disk = 'publicmedia';
      $image = \Image::make($request->file('file'));
      $name = str_slug(str_replace('.' . $extension, '', $original_filename), '-');


      $image->resize(config('asgard.itourism.config.imagesize.width'), config('asgard.itourism.config.imagesize.height'), function ($constraint) {
          $constraint->aspectRatio();
          $constraint->upsize();
      });

      $nameimag = $name . '.' . $extension;
      $destination_path = 'assets/itourism/plan/gallery/' . $idpost . '/' . $nameimag;

      \Storage::disk($disk)->put($destination_path, $image->stream($extension, '100'));

      return array('dir' => $destination_path);
  }

  public function deleteGalleryimage(Request $request)
  {
      $disk = "publicmedia";
      $dirdata = $request->input('dirdata');
      \Storage::disk($disk)->delete($dirdata);
      return array('success' => true);
  }
}
