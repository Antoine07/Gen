<?php  namespace Gen\File;

use Gen\Exception\GenException;

class File {

    /**
     * @param $path
     * @param $content
     * @return int
     * @throws GenException
     */
    public function put($path, $content)
    {
        return file_put_contents($path, $content);
    }

    /**
     * @param $path
     * @return string
     * @throws GenException
     */
    public function get($path)
    {
        if(!file_exists($path))
            throw new GenException(sprintf('get method, no file exists %s', $path));

        return file_get_contents($path);

    }
}