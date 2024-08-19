<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Pages;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\Feature\TestCase;
use App\Domain\Models\Student;

class StudentsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testRedirect(): void
    {
        $response = $this->get('/');
        $response->assertRedirect('/students');
    }

    public function testIndex(): void
    {
        DB::table('students')->insert([
            ['first_name' => 'A', 'last_name' => 'A'],
            ['first_name' => 'B', 'last_name' => 'B'],
        ]);

        $response = $this->get('/students');
        $response->assertViewHas('students');

        $students = $response->viewData('students');
        $this->assertContainsOnlyInstancesOf(Student::class, $students);
        $this->assertCount(2, $students);
        $this->assertEquals(1, $students[0]->id);
        $this->assertEquals(2, $students[1]->id);
    }

    public function testSingle(): void
    {
        DB::table('students')->insert([
            ['first_name' => 'A', 'last_name' => 'A'],
            ['first_name' => 'B', 'last_name' => 'B'],
        ]);

        $response = $this->get('/students/1');
        $response->assertViewHas('student');

        $student = $response->viewData('student');
        $this->assertInstanceOf(Student::class, $student);
        $this->assertEquals(1, $student->id);
    }

    public function testCreateForm(): void
    {
        $this->get('/students/add')->assertStatus(200);
    }

    public function testDeleteForm(): void
    {
        $this->get('/students/delete')->assertStatus(200);
    }

    public function testCreateAction(): void
    {
        $request = $this->post('/students/add', ['first-name' => 'First', 'last-name' => 'Last']);
        $request->assertStatus(302);
        $request->assertSessionHas('success');

        $this->assertDatabaseCount('students', 1);
    }

    public function testDeleteAction(): void
    {
        DB::table('students')->insert([
            ['first_name' => 'A', 'last_name' => 'A'],
        ]);

        $request = $this->delete('/students/delete', ['id' => 1]);
        $request->assertStatus(302);
        $request->assertSessionHas('success');

        $this->assertDatabaseCount('students', 0);
    }

    public function testAddCourseAction(): void
    {
        DB::table('students')->insert([
            ['first_name' => 'A', 'last_name' => 'B'],
        ]);

        DB::table('courses')->insert([
            ['name' => 'A', 'description' => 'AAA'],
        ]);

        $response = $this->put('students/1/courses/add', ['course-id' => 1]);
        $response->assertStatus(302);
        $response->assertSessionHas('success');

        $this->assertDatabaseCount('course_student', 1);
    }

    public function testRemoveCourseAction(): void
    {
        DB::table('students')->insert([
            ['first_name' => 'A', 'last_name' => 'B'],
        ]);

        DB::table('courses')->insert([
            ['name' => 'A', 'description' => 'AAA'],
        ]);

        DB::table('course_student')->insert([
            ['student_id' => 1, 'course_id' => 1],
        ]);

        $response = $this->delete('students/1/courses/remove', ['course-id' => 1]);
        $response->assertStatus(302);
        $response->assertSessionHas('success');

        $this->assertDatabaseCount('course_student', 0);
    }
}
