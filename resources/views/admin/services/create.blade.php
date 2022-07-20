@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Add new servie
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.services.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">Servie Title</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" placeholder="Write Title" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="description">Service description</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" placeholder="Write description" required>{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required">Service time after last appointment</label>
                <select class="form-control {{ $errors->has('last_appointment') ? 'is-invalid' : '' }}" name="last_appointment" id="last_appointment" placeholder="Select Service" required>
                    <option value disabled {{ old('last_appointment', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Service::LAST_APPOINTMENT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('last_appointment', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('last_appointment'))
                    <span class="text-danger">{{ $errors->first('last_appointment') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="branches">Select Branch</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('branches') ? 'is-invalid' : '' }}" name="branches[]" id="branches" multiple required>
                    @foreach($branches as $id => $branch)
                        <option value="{{ $id }}" {{ in_array($id, old('branches', [])) ? 'selected' : '' }}>{{ $branch }}</option>
                    @endforeach
                </select>
                @if($errors->has('branches'))
                    <span class="text-danger">{{ $errors->first('branches') }}</span>
                @endif
            </div>
            <div class="form-group carlabel" style="margin-top: 50px">
                <h3><label>Accepted cars</label></h3>
            </div>


            <div id="brand-car-parent">

              <div class="row_brand" id="row_brand_first">
                <div class="form-group">
              
                  <div class="col-md-10 dynamic-field_brand" id="dynamic-field-1_brand">

                    <div class="row_brand">
                        <label class="required" for="brands">Car Brand</label>
                        <!-- <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div> -->
                        @php
                            $brand_count = 0;
                        @endphp
                        <select class="form-control brands {{ $errors->has('brands') ? 'is-invalid' : '' }}" name="brands[]" id="brands" required>
                            @foreach($brands as $key => $brand)
                              @php
                                  $brand_count += 1;
                              @endphp    
                              <option value="{{ $brand['id'] }}" {{ $key == 0 ? 'selected' : '' }}>{{ $brand['title'] }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('brands'))
                            <span class="text-danger">{{ $errors->first('brands') }}</span>
                        @endif
                    </div>

                    <div class="car_model_main">
                      <div class="col-md-10 car_model" id="car_model">
                        <div class="row car-row mt-2">
                            <div class="form-group">
                                <label class="required" for="model_year">Car model & year</label>
                                <input class="form-control {{ $errors->has('model_year') ? 'is-invalid' : '' }}" type="text" name="model_year[]" id="model_year" value="{{ old('model_year', '') }}" placeholder="Add model & year" required>
                                @if($errors->has('model_year'))
                                    <span class="text-danger">{{ $errors->first('model_year') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="required" for="mileage">Mileage</label>
                                <input class="form-control {{ $errors->has('mileage') ? 'is-invalid' : '' }}" type="number" name="mileage[]" id="mileage" value="{{ old('mileage', '') }}" step="1" placeholder="Add mileage" required>
                                <span>km</span>
                                @if($errors->has('mileage'))
                                    <span class="text-danger">{{ $errors->first('mileage') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="required" for="working_time">Working time</label>
                                <input class="form-control {{ $errors->has('working_time') ? 'is-invalid' : '' }}" type="number" name="working_time[]" id="working_time" value="{{ old('working_time', '') }}" step="1" placeholder="Add time" required>
                                @if($errors->has('working_time'))
                                    <span class="text-danger">{{ $errors->first('working_time') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price[]" id="price" value="{{ old('price', '') }}" step="0.01" placeholder="Add price">
                                @if($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.service.fields.price_helper') }}</span>
                            </div>
                            <input type="hidden" name="hidden_brand[]" class="hidden_brand" value="{{ count($brands) > 0 ? $brands[0]['id'] : '' }}">
                        </div>
                      </div>
                      <div class="col-md-2 mt-30 append-buttons">
                        <div class="clearfix">
                            <button type="button" id="add-car-button" class="btn btn-secondary float-left text-uppercase shadow-sm add-car-button"><i class="fa fa-plus fa-fw"></i>Add more car models
                            </button>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

            </div>
            

            <div class="col-md-2 mt-30 append-buttons_brand mt-5">
                <div class="clearfix">
                    <button type="button" id="add-brand-button" class="btn btn-secondary float-left text-uppercase shadow-sm add-brand-button"><i class="fa fa-plus fa-fw"></i>Add another car brand</button>
                    {{-- <button type="button" id="remove-button_brand" class="btn btn-secondary float-left text-uppercase ml-1" disabled="disabled"><i class="fa fa-minus fa-fw"></i></button> --}}
                </div>
            </div>


            <div class="form-group mt-5">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>

        </form>
    </div>
</div>

@endsection

@section('scripts')

<script>

    $(document).ready(function() {

      const brand_html = '<div class="row_brand">'+$('#row_brand_first').html()+'</div>';
      
      // console.log(brand_html);

      $('body').on('change','.brands',function(){
        $(this).parent().next().find('.hidden_brand').val(this.value);
      });

      $('body').on('click','.add-brand-button',function(){
        $('#brand-car-parent').append(brand_html);
      });

      $('body').on('click','.add-car-button',function(){

        var brand_id = $(this).parent().parent().parent().prev().find('option:selected').val();
        console.log(brand_id);
        var carmodel = $(`<div class="row car-row mt-2">
                                    <div class="form-group">
                                        <label class="required" for="model_year">Car model &amp; year</label>
                                        <input class="form-control " type="text" name="model_year[]" id="model_year" value="" placeholder="Add model &amp; year" required="">
                                                                            </div>
                                    <div class="form-group">
                                        <label class="required" for="mileage">Mileage</label>
                                        <input class="form-control " type="number" name="mileage[]" id="mileage" value="" step="1" placeholder="Add mileage" required="">
                                        <span>km</span>
                                                                            </div>
                                    <div class="form-group">
                                        <label class="required" for="working_time">Working time</label>
                                        <input class="form-control " type="number" name="working_time[]" id="working_time" value="" step="1" placeholder="Add time" required="">
                                                                            </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input class="form-control " type="number" name="price[]" id="price" value="" step="0.01" placeholder="Add price">
                                                                                <span class="help-block"> </span>
                                    </div>
                                    <div class="form-group mt-4">
                                      <button type="button" id="remove-button" class="btn btn-secondary float-left text-uppercase ml-1 remove-car-button"><i class="fa fa-minus fa-fw"></i>
                                      </button>
                                    </div>
                                    <input type="hidden" name="hidden_brand[]" class="hidden_brand" value="${brand_id}">
                                </div>`);
        $(this).parent().parent().prev().append(carmodel);
      });

      $('body').on('click','.remove-car-button',function(){
        $(this).parent().parent().remove();
      });

    });

</script>


@endsection