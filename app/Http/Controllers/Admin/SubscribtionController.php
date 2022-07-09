<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySubscribtionRequest;
use App\Http\Requests\StoreSubscribtionRequest;
use App\Http\Requests\UpdateSubscribtionRequest;
use App\Models\Subscribtion;
use App\Models\Transaction;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SubscribtionController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('subscribtion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Subscribtion::with(['users', 'transactions'])->select(sprintf('%s.*', (new Subscribtion())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'subscribtion_show';
                $editGate = 'subscribtion_edit';
                $deleteGate = 'subscribtion_delete';
                $crudRoutePart = 'subscribtions';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('user', function ($row) {
                $labels = [];
                foreach ($row->users as $user) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $user->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('transaction', function ($row) {
                $labels = [];
                foreach ($row->transactions as $transaction) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $transaction->amount);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Subscribtion::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'transaction']);

            return $table->make(true);
        }

        $users        = User::get();
        $transactions = Transaction::get();

        return view('admin.subscribtions.index', compact('users', 'transactions'));
    }

    public function create()
    {
        abort_if(Gate::denies('subscribtion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id');

        $transactions = Transaction::pluck('amount', 'id');

        return view('admin.subscribtions.create', compact('transactions', 'users'));
    }

    public function store(StoreSubscribtionRequest $request)
    {
        $subscribtion = Subscribtion::create($request->all());
        $subscribtion->users()->sync($request->input('users', []));
        $subscribtion->transactions()->sync($request->input('transactions', []));

        return redirect()->route('admin.subscribtions.index');
    }

    public function edit(Subscribtion $subscribtion)
    {
        abort_if(Gate::denies('subscribtion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id');

        $transactions = Transaction::pluck('amount', 'id');

        $subscribtion->load('users', 'transactions');

        return view('admin.subscribtions.edit', compact('subscribtion', 'transactions', 'users'));
    }

    public function update(UpdateSubscribtionRequest $request, Subscribtion $subscribtion)
    {
        $subscribtion->update($request->all());
        $subscribtion->users()->sync($request->input('users', []));
        $subscribtion->transactions()->sync($request->input('transactions', []));

        return redirect()->route('admin.subscribtions.index');
    }

    public function show(Subscribtion $subscribtion)
    {
        abort_if(Gate::denies('subscribtion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subscribtion->load('users', 'transactions');

        return view('admin.subscribtions.show', compact('subscribtion'));
    }

    public function destroy(Subscribtion $subscribtion)
    {
        abort_if(Gate::denies('subscribtion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subscribtion->delete();

        return back();
    }

    public function massDestroy(MassDestroySubscribtionRequest $request)
    {
        Subscribtion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
