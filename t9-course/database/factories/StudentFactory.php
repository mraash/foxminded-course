<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Models\Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;

    private $isNamesFilled = false;

    private array $firstNames = [];
    private array $lastNames = [];

    public function fillNames()
    {
        $this->isNamesFilled = true;

        for ($i = 0; $i < 20; $i++) {
            $this->firstNames[] = $this->faker->unique()->firstName();
            $this->lastNames[] = $this->faker->unique()->lastName();
        }
    }

    /**
     * Define the model's default state.
     *
     * @return array<string,mixed>
     */
    public function definition(): array
    {
        if (!$this->isNamesFilled) {
            $this->fillNames();
        }

        return [
            'group_id' => null,
            'first_name' => $this->faker->randomElement($this->firstNames),
            'last_name' => $this->faker->randomElement($this->lastNames),
        ];
    }
}
