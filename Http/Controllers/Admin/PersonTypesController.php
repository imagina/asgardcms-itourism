<?php

namespace Modules\Itourism\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Itourism\Entities\PersonTypes;
use Modules\Itourism\Http\Requests\CreatePersonTypesRequest;
use Modules\Itourism\Http\Requests\UpdatePersonTypesRequest;
use Modules\Itourism\Repositories\PersonTypesRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class PersonTypesController extends AdminBaseController
{
    /**
     * @var PersonTypesRepository
     */
    private $persontypes;

    public function __construct(PersonTypesRepository $persontypes)
    {
        parent::__construct();

        $this->persontypes = $persontypes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $persontypes = $this->persontypes->all();
        return view('itourism::admin.persontypes.index', compact('persontypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('itourism::admin.persontypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePersonTypesRequest $request
     * @return Response
     */
    public function store(CreatePersonTypesRequest $request)
    {
        $this->persontypes->create($request->except(['_token']));

        return redirect()->route('admin.itourism.persontypes.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('itourism::persontypes.title.persontypes')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PersonTypes $persontypes
     * @return Response
     */
    public function edit(PersonTypes $persontypes)
    {
        return view('itourism::admin.persontypes.edit', compact('persontypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PersonTypes $persontypes
     * @param  UpdatePersonTypesRequest $request
     * @return Response
     */
    public function update(PersonTypes $persontypes, UpdatePersonTypesRequest $request)
    {
        $this->persontypes->update($persontypes, $request->except(['_method','_token']));

        return redirect()->route('admin.itourism.persontypes.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('itourism::persontypes.title.persontypes')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PersonTypes $persontypes
     * @return Response
     */
    public function destroy(PersonTypes $persontypes)
    {
        $this->persontypes->destroy($persontypes);

        return redirect()->route('admin.itourism.persontypes.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('itourism::persontypes.title.persontypes')]));
    }
}
