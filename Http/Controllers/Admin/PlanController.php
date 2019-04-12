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
    if(isset($data['options']['videos']))
      $data['options']['videos']=json_encode($data['options']['videos']);
    $data['prices']=json_decode($data['prices']);
    foreach(\LaravelLocalization::getSupportedLocales() as $locale => $language){
      $data['slug']=str_slug($data[$locale]['title'],"-");
      break;
    }
    $file = $request->file('maindocument');
    $data['maindocument']=$request->file('maindocument');
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

    if(isset($data['options']['videos']))
      $data['options']['videos']=json_encode($data['options']['videos']);
    foreach(\LaravelLocalization::getSupportedLocales() as $locale => $language){
      $data['slug']=str_slug($data[$locale]['title'],"-");
      break;
    }
    $mainimage=$data['mainimage'];
    unset($data['mainimage']);
    $data['maindocument']=$request->file('maindocument');
    $plan->update($data);
    $data['mainimage']=$mainimage;
    $data['prices']=json_decode($data['prices']);
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


      $image->resize(config('asgard.iblog.config.imagesize.width'), config('asgard.iblog.config.imagesize.height'), function ($constraint) {
          $constraint->aspectRatio();
          $constraint->upsize();
      });

      if (config('asgard.iblog.config.watermark.activated')) {
          $image->insert(config('asgard.iblog.config.watermark.url'), config('asgard.iblog.config.watermark.position'), config('asgard.iblog.config.watermark.x'), config('asgard.iblog.config.watermark.y'));
      }
      $nameimag = $name . '.' . $extension;
      $destination_path = 'assets/itourism/plan/gallery/' . $idpost . '/' . $nameimag;

      \Storage::disk($disk)->put($destination_path, $image->stream($extension, '100'));

      return array('direccion' => $destination_path);
  }

  public function deleteGalleryimage(Request $request)
  {
      $disk = "publicmedia";
      $dirdata = $request->input('dirdata');
      \Storage::disk($disk)->delete($dirdata);
      return array('success' => true);
  }
}
