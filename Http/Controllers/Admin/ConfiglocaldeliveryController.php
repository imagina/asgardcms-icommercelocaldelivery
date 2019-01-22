<?php

namespace Modules\IcommerceLocaldelivery\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\IcommerceLocaldelivery\Entities\Configlocaldelivery;
use Modules\IcommerceLocaldelivery\Http\Requests\CreateConfiglocaldeliveryRequest;
use Modules\IcommerceLocaldelivery\Http\Requests\UpdateConfiglocaldeliveryRequest;
use Modules\IcommerceLocaldelivery\Repositories\ConfiglocaldeliveryRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Setting\Repositories\SettingRepository;

class ConfiglocaldeliveryController extends AdminBaseController
{
    /**
     * @var ConfiglocaldeliveryRepository
     */
    private $configlocaldelivery;

    public function __construct(ConfiglocaldeliveryRepository $configlocaldelivery,SettingRepository $setting)
    {
        parent::__construct();
        $this->setting = $setting;
        $this->configlocaldelivery = $configlocaldelivery;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateConfiglocaldeliveryRequest $request
     * @return Response
     */
    public function store(CreateConfiglocaldeliveryRequest $request)
    {

       
        $this->configlocaldelivery->create($request->all());

        return redirect()->route('admin.icommerce.shipping.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('icommercelocaldelivery::configlocaldeliveries.title.configlocaldeliveries')]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Configlocaldelivery $configlocaldelivery
     * @param  UpdateConfiglocaldeliveryRequest $request
     * @return Response
     */
    public function update(Configlocaldelivery $configlocaldelivery, UpdateConfiglocaldeliveryRequest $request)
    {

        if ($request->status == 'on')
          $request['status'] = "1";
        else
          $request['status'] = "0";
    
        $data = $request->all();
        $token = $data['_token'];

        unset($data['_token']);
        unset($data['_method']);

        $newData['_token'] = $token;

        foreach ($data as $key => $val)
            $newData['icommercelocaldelivery::' . $key] = $val;

        $this->setting->createOrUpdate($newData);

        return redirect()->route('admin.icommerce.shipping.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('icommercelocaldelivery::configlocaldeliveries.title.configlocaldeliveries')]));
    }

}