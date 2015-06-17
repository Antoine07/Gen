<?php namespace Gen\Syntax;
trait Join
{

    /**
     * join helper
     *
     * @return string
     */
    protected function join($val)
    {

        if (empty($val))
            return '';

        $val = explode(',', $val);

        if (count($val) > 1) {

            $val = array_map(function ($v) {

                return "{$this->wrapper($this->longWord($v))}";

            }, $val);

            return ',[' . implode(',', $val) . ']';

        }

        // email200 => 'email', 200
        if (preg_match('/(?<name>[a-z]{1,})(?<val>[0-9]+)/', $val[0], $m)) {
            return "'{$this->longWord($m['name'])}',{$m['val']}";
        }

        return "{$this->wrapper($this->longWord($val[0]))}";

    }


    /**
     * wrapper
     *
     * @param $word
     * @param string $w default "'"
     * @return string
     */
    protected function wrapper($word, $w="'")
    {
        $w = (is_numeric($word)) ? '' : "'";
        return $w . $word . $w;

    }


}