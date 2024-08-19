<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 */
abstract class Repository
{
    /** @phpstan-var TModel */
    private Model $model;

    /**
     * @phpstan-param TModel $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Create new instance of repositories model.
     *
     * @phpstan-return TModel
     */
    protected function model(): Model
    {
        return new (get_class($this->model));
    }

    /**
     * Start building a query.
     *
     * @phpstan-return Builder<TModel>
     */
    protected function query(): Builder
    {
        return $this->model()->query();
    }
}
