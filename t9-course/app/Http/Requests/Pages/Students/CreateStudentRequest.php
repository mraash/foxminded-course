<?php

declare(strict_types=1);

namespace App\Http\Requests\Pages\Students;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
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
            'first-name' => 'required|string|max:255',
            'last-name' => 'required|string|max:255',
        ];
    }

    /**
     * @return array<string,string>
     */
    public function attributes(): array
    {
        return [
            'first-name' => 'first name',
            'last-name' => 'last name',
        ];
    }

    public function getFirstNameInput(): string
    {
        return (string)$this->input('first-name');
    }

    public function getLastNameInput(): string
    {
        return (string)$this->input('last-name');
    }
}
