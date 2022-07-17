<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyServiceRequest;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\Service;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Service::with(['branches', 'brands'])->select(sprintf('%s.*', (new Service())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'service_show';
                $editGate = 'service_edit';
                $deleteGate = 'service_delete';
                $crudRoutePart = 'services';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('last_appointment', function ($row) {
                return $row->last_appointment ? Service::LAST_APPOINTMENT_SELECT[$row->last_appointment] : '';
            });
            $table->editColumn('branch', function ($row) {
                $labels = [];
                foreach ($row->branches as $branch) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $branch->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('brand', function ($row) {
                $labels = [];
                foreach ($row->brands as $brand) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $brand->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('model_year', function ($row) {
                return $row->model_year ? $row->model_year : '';
            });
            $table->editColumn('mileage', function ($row) {
                return $row->mileage ? $row->mileage : '';
            });
            $table->editColumn('working_time', function ($row) {
                return $row->working_time ? $row->working_time : '';
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'branch', 'brand']);

            return $table->make(true);
        }

        return view('admin.services.index');
    }

    public function create()
    {
        abort_if(Gate::denies('service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $branches = Branch::pluck('name', 'id');

        $brands = Brand::pluck('title', 'id');

        return view('admin.services.create', compact('branches', 'brands'));
    }

    public function store(StoreServiceRequest $request)
    {
        $service = Service::create($request->all());
        $service->branches()->sync($request->input('branches', []));
        $service->brands()->sync($request->input('brands', []));

        return redirect()->route('admin.services.index');
    }

    public function edit(Service $service)
    {
        abort_if(Gate::denies('service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $branches = Branch::pluck('name', 'id');

        $brands = Brand::pluck('title', 'id');

        $service->load('branches', 'brands');

        return view('admin.services.edit', compact('branches', 'brands', 'service'));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $service->update($request->all());
        $service->branches()->sync($request->input('branches', []));
        $service->brands()->sync($request->input('brands', []));

        return redirect()->route('admin.services.index');
    }

    public function show(Service $service)
    {
        abort_if(Gate::denies('service_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service->load('branches', 'brands');

        return view('admin.services.show', compact('service'));
    }

    public function destroy(Service $service)
    {
        abort_if(Gate::denies('service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service->delete();

        return back();
    }

    public function massDestroy(MassDestroyServiceRequest $request)
    {
        Service::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
