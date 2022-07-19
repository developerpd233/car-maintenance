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




            <div class="row_brand">
                <div class="form-group">
                    <div class="col-md-10 dynamic-field_brand" id="dynamic-field-1_brand">
                        <div class="row_brand">

                            <label class="required" for="brands">Car Brand</label>
                            <!-- <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div> -->
                            <select class="form-control {{ $errors->has('brands') ? 'is-invalid' : '' }}" name="brands[]" id="brands" required>
                                @foreach($brands as $id => $brand)
                                    <option value="{{ $id }}">{{ $brand }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('brands'))
                                <span class="text-danger">{{ $errors->first('brands') }}</span>
                            @endif
                        </div>
                        <div class="main_inline row">
                            <div class="col-md-10 dynamic-field" id="dynamic-field-1">
                                <div class="row" >
                                    <div class="form-group inline">
                                        <label class="required" for="model_year">Car model & year</label>
                                        <input class="form-control {{ $errors->has('model_year') ? 'is-invalid' : '' }}" type="text" name="model_year[]" id="model_year" value="{{ old('model_year', '') }}" placeholder="Add model & year" required>
                                        @if($errors->has('model_year'))
                                            <span class="text-danger">{{ $errors->first('model_year') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group inline">
                                        <label class="required" for="mileage">Mileage</label>
                                        <input class="form-control {{ $errors->has('mileage') ? 'is-invalid' : '' }}" type="number" name="mileage[]" id="mileage" value="{{ old('mileage', '') }}" step="1" placeholder="Add mileage" required>
                                        <span>km</span>
                                        @if($errors->has('mileage'))
                                            <span class="text-danger">{{ $errors->first('mileage') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group inline">
                                        <label class="required" for="working_time">Working time</label>
                                        <input class="form-control {{ $errors->has('working_time') ? 'is-invalid' : '' }}" type="number" name="working_time[]" id="working_time" value="{{ old('working_time', '') }}" step="1" placeholder="Add time" required>
                                        @if($errors->has('working_time'))
                                            <span class="text-danger">{{ $errors->first('working_time') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group inline">
                                        <label for="price">Price</label>
                                        <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price[]" id="price" value="{{ old('price', '') }}" step="0.01" placeholder="Add price">
                                        @if($errors->has('price'))
                                            <span class="text-danger">{{ $errors->first('price') }}</span>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.service.fields.price_helper') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mt-30 append-buttons">
                                <div class="clearfix">
                                    <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm"><i class="fa fa-plus fa-fw"></i>Add more car models
                                    </button>
                                    <button type="button" id="remove-button" class="btn btn-secondary float-left text-uppercase ml-1" disabled="disabled"><i class="fa fa-minus fa-fw"></i>
                                    </button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-md-2 mt-30 append-buttons_brand">
                    <div class="clearfix">
                        <button type="button" id="add-button_brand" class="btn btn-secondary float-left text-uppercase shadow-sm"><i class="fa fa-plus fa-fw"></i>Add another car brand</button>
                        <button type="button" id="remove-button_brand" class="btn btn-secondary float-left text-uppercase ml-1" disabled="disabled"><i class="fa fa-minus fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>




            







            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>






<!-- 
          	 <div class="row" style="align-items: center;">
  <div class="col-md-10 dynamic-field" id="dynamic-field-1">
    <div class="row" >
        
      <div class="col-md-4">
        <div class="form-group">
          <label for="field" class="hidden-md">Name*</label>
          <input type="text" id="field" class="form-control" name="field[]" />
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Designation</label>
          <input type="text" class="form-control" name="">
        </div>
       </div>
    </div>
  </div>
  <div class="col-md-2 mt-30 append-buttons">
    <div class="clearfix">
      <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm"><i class="fa fa-plus fa-fw"></i>
      </button>
      <button type="button" id="remove-button" class="btn btn-secondary float-left text-uppercase ml-1" disabled="disabled"><i class="fa fa-minus fa-fw"></i>
      </button>
    </div>
  </div>
</div> -->


         

@endsection





@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<script>

$(document).ready(function() {
    
    var buttonAdd = $("#add-button");
    var buttonRemove = $("#remove-button");
    var className = ".dynamic-field";
    var count = 0;
    var field = "";
    var maxFields =50;
  
    function totalFields() {
      return $(className).length;
    }
  
    function addNewField() {
      count = totalFields() + 1;
      field = $("#dynamic-field-1").clone();
      field.attr("id", "dynamic-field-" + count);
      field.children("label").text("Field " + count);
      field.find("input").val("");
      $(className + ":last").after($(field));
    }
  
    function removeLastField() {
      if (totalFields() > 1) {
        $(className + ":last").remove();
      }
    }
  
    function enableButtonRemove() {
      if (totalFields() === 2) {
        buttonRemove.removeAttr("disabled");
        buttonRemove.addClass("shadow-sm");
      }
    }
  
    function disableButtonRemove() {
      if (totalFields() === 1) {
        buttonRemove.attr("disabled", "disabled");
        buttonRemove.removeClass("shadow-sm");
      }
    }
  
    function disableButtonAdd() {
      if (totalFields() === maxFields) {
        buttonAdd.attr("disabled", "disabled");
        buttonAdd.removeClass("shadow-sm");
      }
    }
  
    function enableButtonAdd() {
      if (totalFields() === (maxFields - 1)) {
        buttonAdd.removeAttr("disabled");
        buttonAdd.addClass("shadow-sm");
      }
    }
  
    buttonAdd.click(function() {
      addNewField();
      enableButtonRemove();
      disableButtonAdd();
    });
  
    buttonRemove.click(function() {
      removeLastField();
      disableButtonRemove();
      enableButtonAdd();
    });
  });
</script>


<script>

$(document).ready(function() {
 
    var buttonAdd_brand = $("#add-button_brand");
    var buttonRemove_brand = $("#remove-button_brand");
    var className_brand = ".dynamic-field_brand";
    var count_brand = 0;
    var field_brand = "";
    var maxFields_brand =50;
  
    function totalFields() {
      return $(className_brand).length;
    }
  
    function addNewField() {
      count_brand = totalFields() + 1;
      field_brand = $("#dynamic-field-1_brand").clone();
      field_brand.attr("id", "dynamic-field-" + count_brand);
      field_brand.children("label").text("Field " + count_brand);
      field_brand.find("input").val("");
      $(className_brand + ":last").after($(field_brand));
    }
  
    function removeLastField() {
      if (totalFields() > 1) {
        $(className_brand + ":last").remove();
      }
    }
  
    function enableButtonRemove() {
      if (totalFields() === 2) {
        buttonRemove_brand.removeAttr("disabled");
        buttonRemove_brand.addClass("shadow-sm");
      }
    }
  
    function disableButtonRemove() {
      if (totalFields() === 1) {
        buttonRemove_brand.attr("disabled", "disabled");
        buttonRemove_brand.removeClass("shadow-sm");
      }
    }
  
    function disableButtonAdd() {
      if (totalFields() === maxFields_brand) {
        buttonAdd_brand.attr("disabled", "disabled");
        buttonAdd_brand.removeClass("shadow-sm");
      }
    }
  
    function enableButtonAdd() {
      if (totalFields() === (maxFields_brand - 1)) {
        buttonAdd_brand.removeAttr("disabled");
        buttonAdd_brand.addClass("shadow-sm");
      }
    }
  
    buttonAdd_brand.click(function() {
      addNewField();
      enableButtonRemove();
      disableButtonAdd();
    });
  
    buttonRemove_brand.click(function() {
      removeLastField();
      disableButtonRemove();
      enableButtonAdd();
    });
  });
</script>
@endsection