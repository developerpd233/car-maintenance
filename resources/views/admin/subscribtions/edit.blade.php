@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.subscribtion.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.subscribtions.update", [$subscribtion->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="users">{{ trans('cruds.subscribtion.fields.user') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('users') ? 'is-invalid' : '' }}" name="users[]" id="users" multiple required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ (in_array($id, old('users', [])) || $subscribtion->users->contains($id)) ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('users'))
                    <span class="text-danger">{{ $errors->first('users') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscribtion.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="transactions">{{ trans('cruds.subscribtion.fields.transaction') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('transactions') ? 'is-invalid' : '' }}" name="transactions[]" id="transactions" multiple required>
                    @foreach($transactions as $id => $transaction)
                        <option value="{{ $id }}" {{ (in_array($id, old('transactions', [])) || $subscribtion->transactions->contains($id)) ? 'selected' : '' }}>{{ $transaction }}</option>
                    @endforeach
                </select>
                @if($errors->has('transactions'))
                    <span class="text-danger">{{ $errors->first('transactions') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscribtion.fields.transaction_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.subscribtion.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Subscribtion::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $subscribtion->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscribtion.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.subscribtion.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $subscribtion->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscribtion.fields.description_helper') }}</span>
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