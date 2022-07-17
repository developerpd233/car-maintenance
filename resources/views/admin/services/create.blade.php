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
            <div class="form-group">
                <label class="required" for="brands">Select Brand</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('brands') ? 'is-invalid' : '' }}" name="brands[]" id="brands" multiple required>
                    @foreach($brands as $id => $brand)
                        <option value="{{ $id }}" {{ in_array($id, old('brands', [])) ? 'selected' : '' }}>{{ $brand }}</option>
                    @endforeach
                </select>
                @if($errors->has('brands'))
                    <span class="text-danger">{{ $errors->first('brands') }}</span>
                @endif
            </div>
            <div class="main_inline">
            <div class="form-group inline">
                <label class="required" for="model_year">Car model & year</label>
                <input class="form-control {{ $errors->has('model_year') ? 'is-invalid' : '' }}" type="text" name="model_year" id="model_year" value="{{ old('model_year', '') }}" placeholder="Add model & year" required>
                @if($errors->has('model_year'))
                    <span class="text-danger">{{ $errors->first('model_year') }}</span>
                @endif
            </div>
            <div class="form-group inline">
                <label class="required" for="mileage">Mileage</label>
                <input class="form-control {{ $errors->has('mileage') ? 'is-invalid' : '' }}" type="number" name="mileage" id="mileage" value="{{ old('mileage', '') }}" step="1" placeholder="Add mileage" required>
                @if($errors->has('mileage'))
                    <span class="text-danger">{{ $errors->first('mileage') }}</span>
                @endif
            </div>
            <div class="form-group inline">
                <label class="required" for="working_time">Working time</label>
                <input class="form-control {{ $errors->has('working_time') ? 'is-invalid' : '' }}" type="number" name="working_time" id="working_time" value="{{ old('working_time', '') }}" step="1" placeholder="Add time" required>
                @if($errors->has('working_time'))
                    <span class="text-danger">{{ $errors->first('working_time') }}</span>
                @endif
            </div>
            <div class="form-group inline">
                <label for="price">Price</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01" placeholder="Add price">
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.service.fields.price_helper') }}</span>
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



@endsection