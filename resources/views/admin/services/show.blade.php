@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.service.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.services.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.id') }}
                        </th>
                        <td>
                            {{ $service->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.name') }}
                        </th>
                        <td>
                            {{ $service->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.price') }}
                        </th>
                        <td>
                            {{ $service->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.address') }}
                        </th>
                        <td>
                            {{ $service->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.type') }}
                        </th>
                        <td>
                            {{ $service->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Service::STATUS_SELECT[$service->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.user') }}
                        </th>
                        <td>
                            @foreach($service->users as $key => $user)
                                <span class="label label-info">{{ $user->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.services.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection