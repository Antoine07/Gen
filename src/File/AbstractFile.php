<?php namespace Gen\File;


abstract class AbstractFile
{
    protected $file;

    public function __construct(File $file)
    {
        $this->file = $file;
    }

}