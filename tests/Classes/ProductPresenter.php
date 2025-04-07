<?php

namespace Laracodes\Presenter\Test\Classes;

use Illuminate\Support\Str;
use Laracodes\Presenter\Presenter;

class ProductPresenter extends Presenter
{
    public function name()
    {
        return ucfirst($this->model->name);
    }

    public function shortName()
    {
        return Str::limit($this->name(), 7);
    }

    public function price()
    {
        return '$'.$this->model->price;
    }
}
