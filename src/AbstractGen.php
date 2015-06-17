<?php namespace Gen;

use Gen\Compiler\Factory;

abstract class AbstractGen
{
    protected $compiler;

    public function __construct(Factory $compiler)
    {
        $this->compiler = $compiler;
    }

}