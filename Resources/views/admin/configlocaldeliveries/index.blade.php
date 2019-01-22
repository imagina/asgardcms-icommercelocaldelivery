@php
    $configuration = icommercelocaldelivery_get_configuration();
    $options = array('required' =>'required','step' => '0.01','min' => 0);

    if($configuration==NULL){
        $cStatus = 0;
        $cfeeType = "";
    }else{
        $cfeeType = $configuration->feetype;
        $cStatus = $configuration->status;

    }
    
    $formID = uniqid("form_id");
    $feetypes = icommercelocaldelivery_get_feetypes();

@endphp

{!! Form::open(['route' => ['admin.icommercelocaldelivery.configlocaldelivery.update'], 'method' => 'put','name' => $formID]) !!}

<div class="col-xs-12">

    <div class="form-group">
        <label for="status">{{trans('icommercelocaldelivery::configlocaldeliveries.table.feetype')}}</label>
        <select class="form-control" id="feetype" name="feetype" required>
            <option value="">{{trans('icommercelocaldelivery::configlocaldeliveries.table.select')}}</option>
            @foreach ($feetypes->lists() as $index => $ts)
                <option value="{{$index}}" @if($index==$cfeeType) selected @endif >{{$ts}}</option>
            @endforeach
        </select>
    </div>

    {!! Form::normalInputOfType('number','deliveryfee', trans('icommercelocaldelivery::configlocaldeliveries.table.deliveryfee'), $errors,$configuration,$options) !!}

    <div class="form-group">
        <div>
            <label class="checkbox-inline">
                <input name="status" type="checkbox" @if($cStatus==1) checked @endif>{{trans('icommercelocaldelivery::configlocaldeliveries.table.activate')}}
            </label>
        </div>   
    </div>
   
    <div class="box-footer">
    <button type="submit" class="btn btn-primary btn-flat">{{ trans('icommercelocaldelivery::configlocaldeliveries.button.save configuration') }}</button>
    </div>

</div>

{!! Form::close() !!}