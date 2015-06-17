<?php namespace Gen\Compiler;

trait ReplaceString
{

    /**
     * Get the stored template, and insert into the given wrapper.
     *
     * @param  string $data
     * @param string $template file template
     * @return mixed
     */
    protected function insertInto($template, $data)
    {
        $content = '';
        foreach ($data as $placeholder => $value) {
            $content = empty($content) ? $template : $content;
            $content = str_replace('{{' . $placeholder . '}}', $value, $content);
        }

        return $content;
    }

}