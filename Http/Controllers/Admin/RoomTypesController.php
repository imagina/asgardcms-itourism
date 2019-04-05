<?php

namespace Modules\Itourism\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Itourism\Entities\RoomTypes;
use Modules\Itourism\Http\Requests\CreateRoomTypesRequest;
use Modules\Itourism\Http\Requests\UpdateRoomTypesRequest;
use Modules\Itourism\Repositories\RoomTypesRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class RoomTypesController extends AdminBaseController
{
    /**
     * @var RoomTypesRepository
     */
    private $roomtypes;

    public function __construct(RoomTypesRepository $roomtypes)
    {
        parent::__construct();

        $this->roomtypes = $roomtypes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roomtypes = $this->roomtypes->all();
        return view('itourism::admin.roomtypes.index', compact('roomtypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('itourism::admin.roomtypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRoomTypesRequest $request
     * @return Response
     */
    public function store(CreateRoomTypesRequest $request)
    {
        $this->roomtypes->create($request->except(['_token']));

        return redirect()->route('admin.itourism.roomtypes.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('itourism::roomtypes.title.roomtypes')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  RoomTypes $roomtypes
     * @return Response
     */
    public function edit(RoomTypes $roomtypes)
    {
        return view('itourism::admin.roomtypes.edit', compact('roomtypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoomTypes $roomtypes
     * @param  UpdateRoomTypesRequest $request
     * @return Response
     */
    public function update(RoomTypes $roomtypes, UpdateRoomTypesRequest $request)
    {
        $this->roomtypes->update($roomtypes, $request->except(['_method','_token']));

        return redirect()->route('admin.itourism.roomtypes.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('itourism::roomtypes.title.roomtypes')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  RoomTypes $roomtypes
     * @return Response
     */
    public function destroy(RoomTypes $roomtypes)
    {
        $this->roomtypes->destroy($roomtypes);

        return redirect()->route('admin.itourism.roomtypes.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('itourism::roomtypes.title.roomtypes')]));
    }
}
