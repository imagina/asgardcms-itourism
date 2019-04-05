<?php

namespace Modules\Itourism\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Itourism\Entities\PlanPrice;
use Modules\Itourism\Http\Requests\CreatePlanPriceRequest;
use Modules\Itourism\Http\Requests\UpdatePlanPriceRequest;
use Modules\Itourism\Repositories\PlanPriceRepository;
use Modules\Itourism\Repositories\PersonTypesRepository;
use Modules\Itourism\Repositories\RoomTypesRepository;
use Modules\Itourism\Repositories\PlanRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class PlanPriceController extends AdminBaseController
{
    /**
     * @var PlanPriceRepository
     */
    private $planprice;
    private $plan;
    private $roomtypes;
    private $persontypes;

    public function __construct(
      PlanPriceRepository $planprice,
      PlanRepository $plan,
      RoomTypesRepository $roomtypes,
      PersonTypesRepository $persontypes
      )
    {
        parent::__construct();
        $this->planprice = $planprice;
        $this->persontypes = $persontypes;
        $this->plan = $plan;
        $this->roomtypes = $roomtypes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $planprices = $this->planprice->all();

        return view('itourism::admin.planprices.index', compact('planprices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $plans = $this->plan->all();
        $roomtypes = $this->roomtypes->all();
        $persontypes = $this->persontypes->all();
        return view('itourism::admin.planprices.create',compact('plans','roomtypes','persontypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePlanPriceRequest $request
     * @return Response
     */
    public function store(CreatePlanPriceRequest $request)
    {
        // dd($request->all());
        $this->planprice->create($request->all());

        return redirect()->route('admin.itourism.planprice.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('itourism::planprices.title.planprices')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PlanPrice $planprice
     * @return Response
     */
    public function edit(PlanPrice $planprice)
    {
      $plans = $this->plan->all();
      $roomtypes = $this->roomtypes->all();
      $persontypes = $this->persontypes->all();
        return view('itourism::admin.planprices.edit', compact('planprice','plans','roomtypes','persontypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PlanPrice $planprice
     * @param  UpdatePlanPriceRequest $request
     * @return Response
     */
    public function update(PlanPrice $planprice, UpdatePlanPriceRequest $request)
    {
        $this->planprice->update($planprice, $request->all());

        return redirect()->route('admin.itourism.planprice.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('itourism::planprices.title.planprices')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PlanPrice $planprice
     * @return Response
     */
    public function destroy(PlanPrice $planprice)
    {
        $this->planprice->destroy($planprice);

        return redirect()->route('admin.itourism.planprice.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('itourism::planprices.title.planprices')]));
    }
}
