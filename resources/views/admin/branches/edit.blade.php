@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Branch
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.branches.update", [$branch->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">Branch Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $branch->name) }}" placeholder="Write Name" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="address">Branch Address</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $branch->address) }}" placeholder="Write address" required>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="bays_jacks">Number of buys/jacks</label>
                <input class="form-control {{ $errors->has('bays_jacks') ? 'is-invalid' : '' }}" type="number" name="bays_jacks" id="bays_jacks" value="{{ old('bays_jacks', $branch->bays_jacks) }}" step="1" placeholder="Write number" required>
                @if($errors->has('bays_jacks'))
                    <span class="text-danger">{{ $errors->first('bays_jacks') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required">Booking capability</label>
                <select class="form-control {{ $errors->has('booking_capability') ? 'is-invalid' : '' }}" name="booking_capability" id="booking_capability" required>
                    <option value disabled {{ old('booking_capability', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Branch::BOOKING_CAPABILITY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('booking_capability', $branch->booking_capability) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('booking_capability'))
                    <span class="text-danger">{{ $errors->first('booking_capability') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required">Status</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Branch::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $branch->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
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