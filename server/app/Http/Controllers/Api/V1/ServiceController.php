<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pagination\PaginationRequest;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Http\Resources\Service\ServiceCollection;
use App\Http\Resources\Service\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
public function index(PaginationRequest $request): JsonResponse
    {

        $query = Service::query()
            ->search($request->input('search'))
            ->sort(
                $request->input('sortBy.sort', 'id'),
                $request->input('sortBy.order', 'asc')
            );

        $result = $query->paginate(
            $request->input('limit', 10),
            ['*'],
            'page',
            $request->input('page', 1)
        );

        return (new ServiceCollection($result))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function show($id): JsonResponse
    {

        $service = Service::with('category')->findOrFail($id);

        return (new ServiceResource($service))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function store(StoreServiceRequest $request): JsonResponse
    {

        $service = Service::create($request->validated());

        return (new ServiceResource($service->load('category')))
            ->additional([
                'success' => true,
                'message' => 'Servicio creado satisfactoriamente',
            ])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateServiceRequest $request, $id): JsonResponse
    {

        $service = Service::findOrFail($id);
        $service->update($request->validated());

        return (new ServiceResource($service->load('category')))
            ->additional([
                'success' => true,
                'message' => 'Servicio actualizado satisfactoriamente',
            ])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy($id): JsonResponse
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Servicio eliminado satisfactoriamente',
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function all(): JsonResponse
    {
        $result = Service::with('category')->get();

        return (ServiceResource::collection($result))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
