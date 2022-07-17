@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
<<<<<<< HEAD
        Show Brand
=======
        {{ trans('global.show') }} {{ trans('cruds.brand.title') }}
>>>>>>> d0b1ee2421818d6b8739f224256661952cb06fb4
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
<<<<<<< HEAD
                            ID
=======
                            {{ trans('cruds.brand.fields.id') }}
>>>>>>> d0b1ee2421818d6b8739f224256661952cb06fb4
                        </th>
                        <td>
                            {{ $brand->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
<<<<<<< HEAD
                            Brand Title
=======
                            {{ trans('cruds.brand.fields.title') }}
>>>>>>> d0b1ee2421818d6b8739f224256661952cb06fb4
                        </th>
                        <td>
                            {{ $brand->title }}
                        </td>
                    </tr>
<<<<<<< HEAD
                    <!-- <tr>
=======
                    <tr>
>>>>>>> d0b1ee2421818d6b8739f224256661952cb06fb4
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
<<<<<<< HEAD
                    </tr> -->
                    <tr>
                        <th>
                            Brand description
=======
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.description') }}
>>>>>>> d0b1ee2421818d6b8739f224256661952cb06fb4
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

<<<<<<< HEAD
=======


>>>>>>> d0b1ee2421818d6b8739f224256661952cb06fb4
@endsection