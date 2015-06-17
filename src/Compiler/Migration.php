<?php namespace Gen\Compiler;

use Gen\File\AbstractFile;

class Migration extends AbstractFile implements iCompiler
{
    use PathCompiler, ReplaceString;

    protected $databasePath = 'database.migrations';

    /**
     * @param $schema
     * @param $resource
     * @throws GenException
     */
    public function create($schema, $resource)
    {
        $table = $this->normalizeTableName($resource);
        $fileName = $this->basePath(date('Y_m_d_His') . '_create_' . $table . '_table', $this->databasePath).".php";
        $content = $this->compileTemplate($schema, $resource);
        $this->file->put($fileName, $content);
    }

    /**
     * @param $schema
     * @param $resource
     * @return string
     */
    protected function compileTemplate($schema, $resource)
    {
        $data['table'] = $this->normalizeTableName($resource);
        $data['class'] = 'Create' . str_plural($this->normalizeClassName($resource)) . 'Table';
        $data['schema'] = "\t\t\t".implode(PHP_EOL . "\t\t\t", $schema);
        $template = $this->file->get($this->templatePath('migrations'));

        return $this->insertInto($template, $data);
    }

}