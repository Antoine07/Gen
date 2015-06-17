<?php namespace Gen\Syntax;

class Seed implements iSyntax
{

    use Word, Join;

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

        $solve[] = $this->analyse($matches[0]);
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

        preg_match('/(?<name>[a-z_ ]{1,})?(?<date>(\d{4})-(\d{2})-(\d{2}))?((?<val>[0-9]{1,}))?/', $word, $m);

        if (empty($m))
            throw new \InvalidArgumentException(sprintf('the %s regular expression no matches', $word));

        if (!empty($m['name']) && $m['name'] == 'lorem' && isset($m['val'])) return $this->wrapper($this->getLorem($m['val']));

        if (!empty($m['name'])) return $this->wrapper($m['name']);

        if (!empty($m['date'])) return $m['date'];

    }

    /**
     * @param $val lorem generator
     * @return string
     */
    protected function getLorem($val)
    {
        if (empty($val))
            throw new \InvalidArgumentException('zero lorem impossible');

        $lorem = '';
        for ($i = 0; $i < $val; $i++) $lorem .= $this->words['lorem'];

        return $lorem;
    }

}