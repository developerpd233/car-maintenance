@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.subscribtion.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.subscribtions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.subscribtion.fields.id') }}
                        </th>
                        <td>
                            {{ $subscribtion->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subscribtion.fields.user') }}
                        </th>
                        <td>
                            @foreach($subscribtion->users as $key => $user)
                                <span class="label label-info">{{ $user->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subscribtion.fields.transaction') }}
                        </th>
                        <td>
                            @foreach($subscribtion->transactions as $key => $transaction)
                                <span class="label label-info">{{ $transaction->amount }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subscribtion.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Subscribtion::STATUS_SELECT[$subscribtion->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subscribtion.fields.description') }}
                        </th>
                        <td>
                            {{ $subscribtion->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.subscribtions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection