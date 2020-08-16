 <div class="form-group">
    {{ Form::label('customer_name',__('FormName')) }}
    {{ Form::text('customer_name', null, ['class' => 'form-control '.($errors->has('name') ? 'border-danger':'')]) }}
  </div>
  <div class="form-group">
    {{ Form::label('customer_email',__('FormEmail')) }}
    {{ Form::email('customer_email', null, ['class' => 'form-control '.($errors->has('name') ? 'border-danger':'')]) }}
  </div>
  <div class="form-group">
    {{ Form::label('customer_mobile',__('FormMobile')) }}
    {{ Form::number('customer_mobile', null, ['class' => 'form-control '.($errors->has('name') ? 'border-danger':'')]) }}
  </div>

  <div class="form-group">
    {{ Form::label('address',__('FormAddress')) }}
    {{ Form::text('address', null, ['class' => 'form-control '.($errors->has('name') ? 'border-danger':'')]) }}
    <small id="emailHelp" class="form-text text-muted">{{__('FormAddressSuggest')}}</small>
  </div>

  <div class="form-group">
    {{ Form::label('quantity',__('FormQuantity')) }}
    {!! Form::select('quantity', array('1' => '1', '2' => '2', '3' => '3'),null,['class' => 'form-control '.($errors->has('name') ? 'border-danger':''), 'placeholder' => __('FormQuantityPlaceHolder')]); !!}
  </div>
  <hr>

  {{ Form::hidden('product_id', $product->id) }}

  <button type="submit" class="btn btn-success">{{__('FormSendBtn')}}</button>
  <button class="btn btn-primary">{{__('BackBtn')}}</button>
  <hr>