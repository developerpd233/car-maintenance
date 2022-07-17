@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.branches.index') }}">
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
                            {{ $branch->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Name
                        </th>
                        <td>
                            {{ $branch->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Address
                        </th>
                        <td>
                            {{ $branch->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Bays/Jacks
                        </th>
                        <td>
                            {{ $branch->bays_jacks }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Booking Capability
                        </th>
                        <td>
                            {{ App\Models\Branch::BOOKING_CAPABILITY_SELECT[$branch->booking_capability] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Status
                        </th>
                        <td>
                            {{ App\Models\Branch::STATUS_SELECT[$branch->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.branches.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection