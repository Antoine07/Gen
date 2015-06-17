<?php namespace GenTesting;

use Gen\Compiler\Factory;
use Gen\MakeMigration;

use Gen\Syntax\Migration as SyntaxMigration;
use Gen\Syntax\Seed as SyntaxSeed;
use  Mockery as m;

use Gen\Commands\Migration;

use TestCase;

abstract class AbstractTestCase extends TestCase
{

    protected $migration;
    protected $syntaxMigration;
    protected $mockFile;

    public function setUp()
    {
        parent::setUp();
        $this->mockFile = $this->mock('Gen\File\File');
        $this->migration = new Migration(new MakeMigration(new Factory($this->mockFile)));
        $this->syntaxMigration = new SyntaxMigration();
        $this->syntaxSeed = new SyntaxSeed();
    }

    public function tearDown()
    {
        m::close();
    }

    protected function mock($class)
    {
        $mock = m::mock($class);
        $this->app->instance($class, $mock);

        return $mock;
    }

    /**
     * testing a protected method
     *
     * @param $name
     * @return ReflectionMethod
     */
    protected static function getMethod($name, $class)
    {
        $obj = new \ReflectionClass($class);
        $method = $obj->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }

}