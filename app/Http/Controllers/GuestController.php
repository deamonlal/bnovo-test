<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexGuestRequest;
use App\Http\Requests\StoreGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
use App\Http\Resources\GuestResource;
use App\Models\Guest;
use App\Services\PhoneService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class GuestController extends Controller
{
    public const DEFAULT_INDEX_LIMIT = 100;
    public const DEFAULT_INDEX_OFFSET = 0;

    public function __construct(private readonly PhoneService $phoneService)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(IndexGuestRequest $request): JsonResponse
    {
        $data = $request->validated();
        $guests = Guest::getGuests(
            $data['limit'] ?? self::DEFAULT_INDEX_LIMIT,
            $data['offset'] ?? self::DEFAULT_INDEX_OFFSET
        );

        return GuestResource::collection($guests)
            ->response()
            ->setStatusCode(ResponseAlias::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuestRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (!isset($data['country'])) {
            $data['country'] = $this->phoneService->getCountryByPhone($data['phone']);
        }

        $guest = Guest::create($data);

        return GuestResource::make($guest)
            ->response()
            ->setStatusCode(ResponseAlias::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest): JsonResponse
    {
        return GuestResource::make($guest)
            ->response()
            ->setStatusCode(ResponseAlias::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuestRequest $request, Guest $guest): JsonResponse
    {
        $data = $request->validated();
        $guest->update($data);

        return GuestResource::make($guest)
            ->response()
            ->setStatusCode(ResponseAlias::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest): JsonResponse
    {
        $guest->delete();

        return response()->json(['status' => true, 'message' => 'The guest was deleted successfully']);
    }
}
