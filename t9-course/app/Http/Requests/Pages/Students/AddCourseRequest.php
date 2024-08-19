<?php

declare(strict_types=1);

namespace App\Http\Requests\Pages\Students;

use Illuminate\Foundation\Http\FormRequest;

class AddCourseRequest extends FormRequest
{
    /**
     * @return array<string,string>
     */
    public function rules(): array
    {
        return [
            'course-id' => 'required|int|min:1|exists:courses,id'
        ];
    }

    public function getCourseIdInput(): int
    {
        return (int)$this->input('course-id');
    }
}
