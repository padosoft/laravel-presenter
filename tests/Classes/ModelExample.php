<?php

namespace Laracodes\Presenter\Test\Classes;

use Illuminate\Database\Eloquent\Model;
use Laracodes\Presenter\Traits\Presentable;

class ModelExample extends Model
{
    use Presentable;

    protected $presenter = ModelPresenter::class;
}
