<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Domain\Repositories\CoursesRepository;
use App\Domain\Repositories\StudentsRepository;
use App\Exceptions\EntityNotFoundException;
use App\Http\Requests\Pages\Students\AddCourseRequest;
use App\Http\Requests\Pages\Students\DeleteStudentRequest;
use App\Http\Requests\Pages\Students\ShowIndexStudentsRequest;
use App\Http\Requests\Pages\Students\CreateStudentRequest;
use App\Http\Requests\Pages\Students\RemoveCourseRequest;

class StudentsController extends Controller
{
    private const INDEX_PAGINATION = 20;

    public function __construct(
        private StudentsRepository $studentsRepository
    ) {
    }

    public function showIndex(ShowIndexStudentsRequest $request, CoursesRepository $coursesRepository): View
    {
        $selectedCourseId = $request->getCourseIdInputOrNull();

        $courses = $coursesRepository->getAll();
        $students = $selectedCourseId === null
            ? $this->studentsRepository->getPaginated(self::INDEX_PAGINATION)
            : $this->studentsRepository->getPaginatedFromCourse($selectedCourseId, self::INDEX_PAGINATION)
        ;

        $students->appends($_GET);

        return $this->makeView('pages/students/index',compact('courses', 'students'));
    }

    public function showSingle(CoursesRepository $coursesRepository, int $id): View
    {
        $courses = $coursesRepository->getAll();

        try {
            $student = $this->studentsRepository->getById($id);
        }
        catch (EntityNotFoundException $err) {
            abort(404);
        }

        return $this->makeView('pages/students/single', compact('student', 'courses'));
    }

    public function showCreateForm(): View
    {
        return $this->makeView('pages/students/add');
    }

    public function create(CreateStudentRequest $request): RedirectResponse
    {
        $firstName = $request->getFirstNameInput();
        $lastName = $request->getLastNameInput();

        $student = $this->studentsRepository->create($firstName, $lastName);

        return $this->makeRedirector()->back()->with(
            'success',
            "Successfully created student (with id $student->id)"
        );
    }

    public function showDeleteForm(): View
    {
        return $this->makeView('pages/students/delete');
    }

    public function delete(DeleteStudentRequest $request): RedirectResponse
    {
        $id = $request->getIdInput();

        $this->studentsRepository->delete($id);

        return $this->makeRedirector()->back()->with(
            'success',
            "Successfully deleted student with id $id"
        );
    }

    public function addCourse(AddCourseRequest $request, int $id): RedirectResponse
    {
        $courseId = $request->getCourseIdInput();

        try {
            $this->studentsRepository->addCourse($id, $courseId);
        }
        catch (EntityNotFoundException) {
            return $this->makeRedirector()->back()->withErrors([
                "There is no student with id $id"
            ]);
        }

        return $this->makeRedirector()->back()->with(
            'success',
            "Successfully added course with id $courseId"
        );
    }

    public function removeCourse(RemoveCourseRequest $request, int $id): RedirectResponse
    {
        $courseId = $request->getCourseIdInput();

        try {
            $this->studentsRepository->removeCourse($id, $courseId);
        }
        catch (EntityNotFoundException) {
            return $this->makeRedirector()->back()->withErrors([
                "There is no student with id $id"
            ]);
        }

        return $this->makeRedirector()->back()->with(
            'success',
            "Successfully removed course with id $courseId"
        );
    }
}
