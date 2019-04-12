<?php

namespace Modules\Itourism\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Itourism\Repositories\PlanRepository;
use Modules\Itourism\Transformers\PlanTransformer;
use Route;

class PublicController extends BasePublicController
{

    public $plans;

    public function __construct(PlanRepository $plans)
    {
        parent::__construct();
        $this->plans = $plans;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $plans=$this->plans->paginate();
        $tpl = 'itourism::frontend.index';
        $ttpl = 'itourism.index';
        if (view()->exists($ttpl))
          $tpl = $ttpl;
        Return view($tpl, compact('plans'));
    }

    public function show($slug){
      // dd($criteria);
      $plan=$this->plans->findBySlug($slug);
      if(!$plan)
        abort(404);
      $tpl = 'itourism::frontend.show';
      $ttpl = 'itourism.show';
      if (view()->exists($ttpl))
        $tpl = $ttpl;
      $plans=$this->plans->randomOrder($plan->id);
      Return view($tpl, compact('plan','plans'));
    }//show

}
