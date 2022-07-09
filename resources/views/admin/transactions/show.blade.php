@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.transaction.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transactions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.id') }}
                        </th>
                        <td>
                            {{ $transaction->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.order') }}
                        </th>
                        <td>
                            @foreach($transaction->orders as $key => $order)
                                <span class="label label-info">{{ $order->amount }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.transaction') }}
                        </th>
                        <td>
                            {{ $transaction->transaction }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.amount') }}
                        </th>
                        <td>
                            {{ $transaction->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction.fields.payment_method') }}
                        </th>
                        <td>
                            {{ App\Models\Transaction::PAYMENT_METHOD_SELECT[$transaction->payment_method] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transactions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#transaction_subscribtions" role="tab" data-toggle="tab">
                {{ trans('cruds.subscribtion.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="transaction_subscribtions">
            @includeIf('admin.transactions.relationships.transactionSubscribtions', ['subscribtions' => $transaction->transactionSubscribtions])
        </div>
    </div>
</div>

@endsection