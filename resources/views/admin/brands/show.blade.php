@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Show Brand
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.brands.index') }}">
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
                            {{ $brand->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Brand Title
                        </th>
                        <td>
                            {{ $brand->title }}
                        </td>
                    </tr>
                    <!-- <tr>
                        <th>
                            {{ trans('cruds.brand.fields.image') }}
                        </th>
                        <td>
                            @if($brand->image)
                                <a href="{{ $brand->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $brand->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr> -->
                    <tr>
                        <th>
                            Brand description
                        </th>
                        <td>
                            {!! $brand->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.brands.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection