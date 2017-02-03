<?php

namespace TypiCMS\Modules\Currencies\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Shells\Repositories\RepositoriesAbstract;

class EloquentCurrency extends RepositoriesAbstract implements CurrencyInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
