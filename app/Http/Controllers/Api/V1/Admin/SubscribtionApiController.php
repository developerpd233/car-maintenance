<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscribtionRequest;
use App\Http\Requests\UpdateSubscribtionRequest;
use App\Http\Resources\Admin\SubscribtionResource;
use App\Models\Subscribtion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscribtionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('subscribtion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubscribtionResource(Subscribtion::with(['users', 'transactions'])->get());
    }

    public function store(StoreSubscribtionRequest $request)
    {
        $subscribtion = Subscribtion::create($request->all());
        $subscribtion->users()->sync($request->input('users', []));
        $subscribtion->transactions()->sync($request->input('transactions', []));

        return (new SubscribtionResource($subscribtion))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Subscribtion $subscribtion)
    {
        abort_if(Gate::denies('subscribtion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubscribtionResource($subscribtion->load(['users', 'transactions']));
    }

    public function update(UpdateSubscribtionRequest $request, Subscribtion $subscribtion)
    {
        $subscribtion->update($request->all());
        $subscribtion->users()->sync($request->input('users', []));
        $subscribtion->transactions()->sync($request->input('transactions', []));

        return (new SubscribtionResource($subscribtion))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Subscribtion $subscribtion)
    {
        abort_if(Gate::denies('subscribtion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subscribtion->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
