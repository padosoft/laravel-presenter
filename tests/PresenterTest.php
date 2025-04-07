<?php
namespace Laracodes\Presenter\Test;

use Laracodes\Presenter\Test\Classes\Product;
use Orchestra\Testbench\TestCase as Orchestra;

class PresenterTest extends Orchestra
{
    /**
     * @var Product
     */
    protected $model;

    /**
     * @return void
     */
    public function setUp() : void
    {
        $this->model = new Product();
    }

    /**
     * @test
     */
    public function presenterModifyCorrectlyProperty()
    {
        $this->assertEquals('Product 1', $this->model->present()->name);
        $this->assertStringStartsWith('$', $this->model->present()->price);
    }

    /**
     * @test
     */
    public function callPropertyInModelIfNotExistsInPresenter()
    {
        $this->assertEquals('description of product 1', $this->model->present()->description);
    }

    /**
     * @test
     */
    public function propertyIssetInPresenterClass()
    {
        $this->assertTrue(isset($this->model->present()->name));
        $this->assertTrue(isset($this->model->present()->short_name));
        $this->assertTrue(isset($this->model->present()->shortName));
        $this->assertFalse(isset($this->model->present()->description));
    }

    /**
     * @test
     */
    public function propertyInSnakeCaseConvertedToCamelCase()
    {
        $this->assertEquals('Product...', $this->model->present()->short_name);
    }

    /**
     * @test
     */
    public function callPropertyInModelIfNotExistsInPresenterWithConversionToSnakeCase()
    {
        $expected = 'testing';

        $this->assertEquals($expected, $this->model->present()->property_test);
        $this->assertEquals($expected, $this->model->present()->propertyTest);
    }
}


