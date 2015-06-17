<?php namespace Gen;

use Gen\Syntax\Seed as Syntax;

class MakeSeed extends AbstractGen implements iMake
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

        if (!empty($options['data'])) {
            foreach (explode(';', $options['data']) as $option) {
                $solve = (new Syntax)->syntax($option);
                $syntax[] = sprintf("%s=>%s", $solve[0], $solve[1]) . ",";
            }
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
        $this->compiler->createSeed($this->getSyntax($options), $resource);
    }


}