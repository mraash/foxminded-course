<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Students;

use App\Http\Requests\Api\V1\ApiRequest;

class StoreStudentRequest extends ApiRequest
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

    public function firstNameInput(): string
    {
        /** @var string */
        return $this->input('first-name');
    }

    public function lastNameInput(): string
    {
        /** @var string */
        return $this->input('last-name');
    }
}
