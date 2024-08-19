<?php

declare(strict_types=1);

namespace App\Http\Requests\Pages\Students;

use Illuminate\Foundation\Http\FormRequest;

class ShowIndexStudentsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string,string>
     */
    public function rules(): array
    {
        return [
            'course-id' => 'nullable|int|min:0|exists:courses,id',
        ];
    }

    public function hasCourseIdInput(): bool
    {
        return $this->input('course-id') !== null;
    }

    public function getCourseIdInputOrNull(): int|null
    {
        if (!$this->hasCourseIdInput()) {
            return null;
        }

        return (int)$this->input('course-id');
    }
}
