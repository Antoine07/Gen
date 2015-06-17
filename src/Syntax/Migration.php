<?php namespace Gen\Syntax;

class Migration implements iSyntax
{

    use Word, Join;

    public function foreign($options)
    {
        $options = explode(':', $options);

        $id = $options[0];

        $pos = strpos($id, '_');

        $table = str_plural(substr($id, 0, $pos));

        $syntax[] = 'foreign';

        $syntax[] = sprintf("('%s')->references('id')->on('%s')",
            $options[0],
            $table
        );

        if (count($options) > 1) {

            $opt = $options[1] == 'null' ? 'SET NULL' : 'CASCADE';

            $syntax[1] .= sprintf("->onDelete('%s')",
                $opt
            );
        }

        return $syntax;

    }

    /**
     * @param $matches
     * @return array
     * @throws GenException
     */
    public function syntax($matches)
    {
        $matches = explode(':', $matches);

        if (count($matches) != 2)
            throw new \InvalidArgumentException("wrong syntax, must be like this type:syntax");

        $solve[] = $this->longWord($matches[0]);
        $solve[] = $this->analyse($matches[1]);

        return $solve;
    }

    /**
     * analyse syntax and transform into right syntax migration
     *
     * @param $word
     * @return string
     */
    public function analyse($word)
    {

        preg_match('/(?<name>[a-z_]{1,}[0-9]*)(\((?<val>[a-z_,]{1,})\))?((>d\(|>default\()(?<default>[a-z_0-9]{1,})\))?((>opt\(|>option\()(?<opt>[a-z_,]{1,})\))?/', $word, $m);

        if (empty($m))
            throw new \InvalidArgumentException(sprintf('the %s regular expression no matches', $word));

        $val = (!empty($m['val'])) ? $m['val'] : [];

        $syntax = '(' . $this->join($m['name']) . $this->join($val) . ')';

        if (isset($m['default']) && (($default = $m['default']) != '')) {
            $syntax .= "->default({$this->wrapper($this->longWord($default))})";
        }

        if (!empty($m['opt'])) {
            foreach (explode(',', $m['opt']) as $opt)
                $syntax .= "->{$this->longWord($opt)}()";
        }

        return $syntax;

    }

}