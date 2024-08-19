<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Domain\Repositories\StudentsRepository;
use App\Exceptions\EntityNotFoundException;
use App\Http\Requests\Api\V1\Students\StoreStudentRequest;
use App\Http\Resources\V1\StudentResource;
use App\Http\Responses\Api\V1\ApiSuccesResponse;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function __construct(
        private StudentsRepository $studentsRepository
    ) {
    }

    public function index(Request $request): ApiSuccesResponse
    {
        $students = $this->studentsRepository->getAll();

        $resources = StudentResource::collection($students);

        return $this->makeSuccessResponse((array)$resources->toArray($request));
    }

    public function show(Request $request, int $id): ApiSuccesResponse
    {
        try {
            $student = $this->studentsRepository->getById($id);
        }
        catch (EntityNotFoundException) {
            $this->throwResponseException('Not found', 404);
        }

        $resource = new StudentResource($student);

        return $this->makeSuccessResponse($resource->toArray($request));
    }

    public function store(StoreStudentRequest $request): ApiSuccesResponse
    {
        $firstName = $request->firstNameInput();
        $lastName = $request->lastNameInput();

        $this->studentsRepository->create($firstName, $lastName);

        return $this->makeSuccessResponse();
    }

    public function destroy(int $id): ApiSuccesResponse
    {
        try {
            $this->studentsRepository->delete($id);
        }
        catch (EntityNotFoundException) {
            $this->throwResponseException('Not found', 404);
        }

        return $this->makeSuccessResponse();
    }
}
