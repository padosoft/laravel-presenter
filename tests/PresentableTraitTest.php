<?php

use Illuminate\Database\Eloquent\Model;
use Laracodes\Presenter\Presenter;
use Laracodes\Presenter\Traits\Presentable;
use Laracodes\Presenter\Exceptions\PresenterException;

class PresentableTraitTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ModelExample
     */
    protected $model;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->model = new ModelExample();
    }

    /**
     * @test
     */
    public function exceptionIfPresenterPropertyNotExists()
    {
        $this->expectException(PresenterException::class);

        $this->getMockForTrait(Presentable::class)->present();
    }

    /**
     * @test
     */
    public function returnValidPresenterClass()
    {
        $this->assertInstanceOf(Presenter::class, $this->model->present());
    }

    /**
     * @test
     */
    public function cachePresenterInstanceIsWorking()
    {
        $call1 = $this->model->present();
        $call2 = $this->model->present();

        $this->assertSame($call1, $call2);
        $this->assertNotSame($call1, (new ModelExample())->present());
    }

    /**
     * @test
     */
    public function checkPresenterInstanceValidValues()
    {
        $this->assertIsObject($this->model->present());
        $this->assertTrue(is_a($this->model->present(),Presenter::class));
    }
}

class ModelExample extends Model
{
    use Presentable;

    protected $presenter = ModelPresenter::class;
}

class ModelPresenter extends Presenter
{
    //
}
