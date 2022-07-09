<div class="m-3">
    @can('subscribtion_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.subscribtions.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.subscribtion.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.subscribtion.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-transactionSubscribtions">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.subscribtion.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.subscribtion.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.subscribtion.fields.transaction') }}
                            </th>
                            <th>
                                {{ trans('cruds.subscribtion.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.subscribtion.fields.description') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subscribtions as $key => $subscribtion)
                            <tr data-entry-id="{{ $subscribtion->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $subscribtion->id ?? '' }}
                                </td>
                                <td>
                                    @foreach($subscribtion->users as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($subscribtion->transactions as $key => $item)
                                        <span class="badge badge-info">{{ $item->amount }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ App\Models\Subscribtion::STATUS_SELECT[$subscribtion->status] ?? '' }}
                                </td>
                                <td>
                                    {{ $subscribtion->description ?? '' }}
                                </td>
                                <td>
                                    @can('subscribtion_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.subscribtions.show', $subscribtion->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('subscribtion_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.subscribtions.edit', $subscribtion->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('subscribtion_delete')
                                        <form action="{{ route('admin.subscribtions.destroy', $subscribtion->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('subscribtion_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.subscribtions.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-transactionSubscribtions:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection