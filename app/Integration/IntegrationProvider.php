<?php

namespace App\Integration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IntegrationProvider
{
    /**
     * @param Model $model
     * @param array $fields
     * @return Model|null
     */
    public function saveModel(Model $model, array $fields): ?Model;
}
