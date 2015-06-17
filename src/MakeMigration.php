<?php namespace Gen;

use Gen\Syntax\Migration as Syntax;

class MakeMigration extends AbstractGen implements iMake
{

    protected $syntax = [];

    /**
     * build partial migration
     *
     * @param $options
     * @return string
     */
    protected function getSyntax($options)
    {

        $syntax = [];

        if (!empty($options['schema'])) {
            foreach (explode(';', $options['schema']) as $option) {
                $solve = (new Syntax)->syntax($option);
                $syntax[] = sprintf("\$table->%s%s", $solve[0], $solve[1]) . ";";
            }
        }

        if (!empty($options['foreign'])) {
            $solve = (new Syntax)->foreign($options['foreign']);
            $syntax[] = sprintf("\$table->%s%s", $solve[0], $solve[1]) . ";";
        }

        return $syntax;
    }

    /**
     * create file migration
     *
     * @param $resource
     * @param $options
     */
    public function make($resource, $options)
    {
        $this->compiler->createMigration($this->getSyntax($options), $resource);
    }


}