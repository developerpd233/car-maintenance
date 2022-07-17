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
                            ID
                        </th>
                        <td>
                            {{ $service->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Servie Title
                        </th>
                        <td>
                            {{ $service->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Service description
                        </th>
                        <td>
                            {{ $service->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Service time after last appointment
                        </th>
                        <td>
                            {{ App\Models\Service::LAST_APPOINTMENT_SELECT[$service->last_appointment] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Branches Name
                        </th>
                        <td>
                            @foreach($service->branches as $key => $branch)
                                <span class="label label-info">{{ $branch->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Brand Name
                        </th>
                        <td>
                            @foreach($service->brands as $key => $brand)
                                <span class="label label-info">{{ $brand->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Car model & year
                        </th>
                        <td>
                            {{ $service->model_year }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Mileage
                        </th>
                        <td>
                            {{ $service->mileage }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Working time
                        </th>
                        <td>
                            {{ $service->working_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Price
                        </th>
                        <td>
                            {{ $service->price }}
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