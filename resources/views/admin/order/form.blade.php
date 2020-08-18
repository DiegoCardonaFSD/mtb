 <div class="form-group">
    {{ Form::label('document_type',__('FormDocumentType')) }}
    {!! Form::select('document_type', array('CC' => 'Cédula de ciudadania', 'CE' => 'Cédula extranjeria', 'TI' => 'Tarjeta de identidad', 'Registro Civil' => 'RC', 'NIT' => 'NIT', 'RUT' => 'RUT'),null,['class' => 'form-control '.($errors->has('document_type') ? 'border-danger':''), 'placeholder' => __('FormQuantityPlaceHolder')]); !!}
  </div>
  <div class="form-group">
    {{ Form::label('document',__('FormDocument')) }}
    {{ Form::number('document', null, ['class' => 'form-control '.($errors->has('document') ? 'border-danger':'')]) }}
  </div>
  <div class="form-group">
    {{ Form::label('customer_name',__('FormName')) }}
    {{ Form::text('customer_name', null, ['class' => 'form-control '.($errors->has('customer_name') ? 'border-danger':'')]) }}
  </div>
  <div class="form-group">
    {{ Form::label('customer_lastname',__('FormLastName')) }}
    {{ Form::text('customer_lastname', null, ['class' => 'form-control '.($errors->has('customer_lastname') ? 'border-danger':'')]) }}
  </div>
  <div class="form-group">
    {{ Form::label('customer_email',__('FormEmail')) }}
    {{ Form::email('customer_email', null, ['class' => 'form-control '.($errors->has('customer_email') ? 'border-danger':'')]) }}
  </div>
  <div class="form-group">
    {{ Form::label('customer_mobile',__('FormMobile')) }}
    {{ Form::number('customer_mobile', null, ['class' => 'form-control '.($errors->has('customer_mobile') ? 'border-danger':'')]) }}
  </div>

  <div class="form-group">
    {{ Form::label('address',__('FormAddress')) }}
    {{ Form::text('address', null, ['class' => 'form-control '.($errors->has('address') ? 'border-danger':'')]) }}
    <small id="emailHelp" class="form-text text-muted">{{__('FormAddressSuggest')}}</small>
  </div>

  <div class="form-group">
    {{ Form::label('quantity',__('FormQuantity')) }}
    {!! Form::select('quantity', array('1' => '1', '2' => '2', '3' => '3'),null,['class' => 'form-control '.($errors->has('quantity') ? 'border-danger':''), 'placeholder' => __('FormQuantityPlaceHolder')]); !!}
  </div>
  <hr>

  {{ Form::hidden('product_id', $product->id) }}

