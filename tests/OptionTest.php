<?php

namespace Reallyli\Options\Test;

use Reallyli\Options\Facade\Option;

class OptionTest extends BaseTest
{
    /** @test */
    public function it_can_set()
    {
        Option::set('Example-1', 'foo-1', 'bar-1');

        $this->assertDatabaseHas('options', ['module' => 'Example-1', 'key' => 'foo-1', 'value' => 'bar-1']);
    }

    /** @test */
    public function it_can_get_default()
    {
        $this->assertEquals('bar-2', Option::get('Example-2', 'foo-2', 'bar-2'));
    }

    /** @test */
    public function it_can_get()
    {
        Option::set('Example-3', 'foo-3', 'bar-3');

        $this->assertEquals('bar-3', Option::get('Example-3', 'foo-3'));
    }

    /** @test */
    public function it_can_check_if_exists()
    {
        $this->assertFalse(Option::exists('Example-4', 'foo-4'));

        Option::set('Example-4', 'foo-4', 'bar-4');

        $this->assertTrue(Option::exists('Example-4', 'foo-4'));
    }

    /** @test */
    public function it_can_soft_remove()
    {
        Option::set('Example-5', 'foo-5', 'bar-5');

        Option::remove('Example-5', 'foo-5');

        $this->assertEquals(null, Option::get('Example-5', 'foo-5'));
    }

    /** @test */
    public function it_can_increase()
    {
        Option::set('Example-6', 'foo-6', 1);
        Option::increase('Example-6', 'foo-6');

        $this->assertEquals(2, Option::get('Example-6', 'foo-6'));
    }

    /** @test */
    public function it_can_decrease()
    {
        Option::set('Example-7', 'foo-7', 1);
        Option::decrease('Example-7', 'foo-7');

        $this->assertEquals(0, Option::get('Example-7', 'foo-7'));
    }
}
