<?php namespace Gen\Compiler;

trait PathCompiler
{
    /**
     * @param string $name
     * @return string
     */
    protected function templatePath($name)
    {
        return __DIR__ . '/../templates/' .
        $this->compilePath($name) . ".txt";
    }

    /**
     * @param $name
     * @param string $prefix
     * @return string
     */
    protected function basePath($name, $prefix = '')
    {
        $prefix = $prefix ? $this->compilePath($prefix) . DIRECTORY_SEPARATOR : '';

        return base_path($prefix . $this->compilePath($name));
    }

    /**
     * @param $name
     * @return mixed
     */
    protected function compilePath($name)
    {
        return preg_replace('/\./', DIRECTORY_SEPARATOR, $name);
    }

    /**
     * @param $className
     * @return string
     */
    protected function normalizeClassName($className)
    {
        return ucwords(str_singular(camel_case(strtolower($className))));
    }

    /**
     * @param $resource
     * @return string
     */
    protected function normalizeTableName($resource)
    {
        return str_plural(strtolower($resource));
    }

}