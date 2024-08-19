<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Domain\Models\Student;
use App\Exceptions\EntityNotFoundException;

/**
 * @extends Repository<Student>
 *
 * @method Student model()
 * @method Builder<Student> query()
 */
class StudentsRepository extends Repository
{
    public function __construct(Student $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection<int,Student>
     */
    public function getAll(): Collection
    {
        return $this->model()->all();
    }

    public function getPaginated(int $prePage): LengthAwarePaginator
    {
        return $this->query()
            ->orderBy('id')
            ->paginate($prePage)
        ;
    }

    public function getPaginatedFromCourse(int $courseId, int $prePage): LengthAwarePaginator
    {
        return $this->query()
            ->select(['students.*'])
            ->leftJoin('course_student', 'course_student.student_id', '=', 'students.id')
            ->where('course_student.course_id', $courseId)
            ->groupBy('students.id')
            ->orderBy('students.id')
            ->paginate($prePage)
        ;
    }

    public function getById(int $id): Student
    {
        $student = $this->model()
            ->query()
            ->where('id', $id)
            ->with(['courses'])
            ->first()
        ;

        if ($student === null) {
            throw new EntityNotFoundException();
        }

        return $student;
    }

    public function create(string $firstName, string $lastName): Student
    {
        $student = $this->model();

        $student->first_name = $firstName;
        $student->last_name = $lastName;

        $student->save();

        return $student;
    }

    public function delete(int $id): void
    {
        $this->getById($id)->delete();
    }

    public function addCourse(int $id, int $courseId): void
    {
        $this->getById($id)
            ->courses()
            ->sync([$courseId], false)
        ;
    }

    public function removeCourse(int $id, int $courseId): void
    {
        $this->getById($id)
            ->courses()
            ->detach($courseId)
        ;
    }
}
