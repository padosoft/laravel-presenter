<?php

namespace Laracodes\Presenter\Test\Classes;

use Illuminate\Database\Eloquent\Model;
use Laracodes\Presenter\Test\Classes\ProductPresenter;
use Laracodes\Presenter\Traits\Presentable;

class Product extends Model
{
    use Presentable;

    protected $presenter = ProductPresenter::class;

    protected $attributes = [
        'name' => 'product 1',
        'description' => 'description of product 1',
        'price' => 9.90,
        'property_test' => 'testing',
    ];
}
