<?php

declare(strict_types=1);

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Database\Factories\GroupFactory;

/**
 * @property-read int $id
 * @property string $name
 * @property Collection<Student> $students
 * @property int|null $students_count
 */
class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return HasMany<Student>
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /** @phpstan-ignore-next-line */
    protected static function newFactory()
    {
        return GroupFactory::new();
    }
}
