@php
    $options = array('required' =>'required');
    $formID = uniqid("form_id");
@endphp

{!! Form::open(['route' => ['admin.icommerce.shippingmethod.update',$method->id], 'method' => 'put','name' => $formID]) !!}

<div class="col-xs-12 col-sm-9">

    <div class="row">

        <div class="nav-tabs-custom">
            @include('partials.form-tab-headers')
            <div class="tab-content">
                <?php $i = 0; ?>
                @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                    <?php $i++; ?>
                    <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="{{$method->name}}_tab_{{ $i }}">
                        
                        {!! Form::i18nInput('title', '* '.trans('icommerce::paymentmethods.table.title'), $errors, $locale, $method) !!}
                        {!! Form::i18nInput('description', '* '.trans('icommerce::paymentmethods.table.description'), $errors, $locale, $method) !!}
                    
                    </div>
                @endforeach
            </div>
        </div>
        
    </div>

    <div class="row">
    <div class="col-xs-12">

        @php
            $feetypes = new \Modules\Icommercelocaldelivery\Entities\FeeTypes();
        @endphp

        <div class="form-group">
            <label for="status">* {{trans('icommercelocaldelivery::icommercelocaldeliveries.table.feetype')}}</label>
            <select class="form-control" id="feetype" name="feetype" required>
                @foreach ($feetypes->lists() as $index => $ts)
                    <option value="{{$index}}" @if($index==$method->options->feetype) selected @endif >{{$ts}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group ">
            <label for="deliveryfee">* {{trans('icommercelocaldelivery::icommercelocaldeliveries.table.deliveryfee')}}</label>
            <input placeholder="{{trans('icommercelocaldelivery::icommercelocaldeliveries.table.deliveryfee')}}" required="required" name="deliveryfee" type="number" step='0.01' min='0' id="deliveryfee" class="form-control" value="{{$method->options->deliveryfee}}">
        </div>

        <div class="form-group">
            <div>
                <label class="checkbox-inline">
                    <input name="status" type="checkbox" @if($method->status==1) checked @endif>{{trans('icommerce::paymentmethods.table.activate')}}
                </label>
            </div>   
        </div>

    </div>
    </div>

</div>


<div class="clearfix"></div>   

<div class="box-footer">
    <button type="submit" class="btn btn-primary btn-flat">{{ trans('icommerce::paymentmethods.button.save configuration') }} {{$method->title}}</button>
</div>


{!! Form::close() !!}