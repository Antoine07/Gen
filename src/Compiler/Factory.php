<?php namespace Gen\Compiler;

use Gen\File\File;

class Factory
{
    /**
     * create migration
     * @param $schema
     * @param $resource
     */
    public function createMigration($schema, $resource)
    {
        (new Migration(new File))->create($schema, $resource);
    }

}