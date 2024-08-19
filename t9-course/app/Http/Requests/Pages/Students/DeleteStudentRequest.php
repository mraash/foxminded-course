<?php

declare(strict_types=1);

namespace App\Http\Requests\Pages\Students;

use Illuminate\Foundation\Http\FormRequest;

class DeleteStudentRequest extends FormRequest
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
            'id' => 'required|int|min:0|exists:students,id',
        ];
    }

    /**
     * @return array<string,string>
     */
    public function messages(): array
    {
        return [
            'id.required' => 'Id is required',
            'id.int' => 'Id shoud be an integer',
            'id.min' => 'Id shoud be positive',
            'id.exists' => 'There is no student with :attribute :input',
        ];
    }

    public function getIdInput(): int
    {
        return (int)$this->input('id');
    }
}
