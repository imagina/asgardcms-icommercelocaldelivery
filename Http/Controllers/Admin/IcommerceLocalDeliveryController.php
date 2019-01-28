<?php

namespace Modules\Icommercelocaldelivery\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Icommercelocaldelivery\Entities\IcommerceLocalDelivery;
use Modules\Icommercelocaldelivery\Http\Requests\CreateIcommerceLocalDeliveryRequest;
use Modules\Icommercelocaldelivery\Http\Requests\UpdateIcommerceLocalDeliveryRequest;
use Modules\Icommercelocaldelivery\Repositories\IcommerceLocalDeliveryRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class IcommerceLocalDeliveryController extends AdminBaseController
{
    /**
     * @var IcommerceLocalDeliveryRepository
     */
    private $icommercelocaldelivery;

    public function __construct(IcommerceLocalDeliveryRepository $icommercelocaldelivery)
    {
        parent::__construct();

        $this->icommercelocaldelivery = $icommercelocaldelivery;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$icommercelocaldeliveries = $this->icommercelocaldelivery->all();

        return view('icommercelocaldelivery::admin.icommercelocaldeliveries.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('icommercelocaldelivery::admin.icommercelocaldeliveries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateIcommerceLocalDeliveryRequest $request
     * @return Response
     */
    public function store(CreateIcommerceLocalDeliveryRequest $request)
    {
        $this->icommercelocaldelivery->create($request->all());

        return redirect()->route('admin.icommercelocaldelivery.icommercelocaldelivery.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('icommercelocaldelivery::icommercelocaldeliveries.title.icommercelocaldeliveries')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  IcommerceLocalDelivery $icommercelocaldelivery
     * @return Response
     */
    public function edit(IcommerceLocalDelivery $icommercelocaldelivery)
    {
        return view('icommercelocaldelivery::admin.icommercelocaldeliveries.edit', compact('icommercelocaldelivery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  IcommerceLocalDelivery $icommercelocaldelivery
     * @param  UpdateIcommerceLocalDeliveryRequest $request
     * @return Response
     */
    public function update(IcommerceLocalDelivery $icommercelocaldelivery, UpdateIcommerceLocalDeliveryRequest $request)
    {
        $this->icommercelocaldelivery->update($icommercelocaldelivery, $request->all());

        return redirect()->route('admin.icommercelocaldelivery.icommercelocaldelivery.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('icommercelocaldelivery::icommercelocaldeliveries.title.icommercelocaldeliveries')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  IcommerceLocalDelivery $icommercelocaldelivery
     * @return Response
     */
    public function destroy(IcommerceLocalDelivery $icommercelocaldelivery)
    {
        $this->icommercelocaldelivery->destroy($icommercelocaldelivery);

        return redirect()->route('admin.icommercelocaldelivery.icommercelocaldelivery.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('icommercelocaldelivery::icommercelocaldeliveries.title.icommercelocaldeliveries')]));
    }
}
