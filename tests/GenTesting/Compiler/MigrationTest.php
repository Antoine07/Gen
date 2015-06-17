<?php namespace Gentesting\Compiler;

use Gen\Compiler\Migration;
use Gen\Compiler\PathCompiler;
use GenTesting\AbstractTestCase;

class MigrationTest extends AbstractTestCase
{

    use PathCompiler;

    /**
     * @test trait PathCompiler
     */
    public function testPathCompilerTrait()
    {

        $timestamp = date('Y_m_d_His');
        $name = $timestamp . '_create_posts_table';
        $excepted = base_path('database') . '/migrations/' . $timestamp . '_create_posts_table';

        $this->assertEquals($excepted, $this->basePath($name, 'database.migrations'));

        $this->assertEquals('posts', $this->normalizeTableName('post'));
        $this->assertEquals('categories', $this->normalizeTableName('category'));

        $this->assertEquals('Post', $this->normalizeClassName('post'));
        $this->assertEquals('PostCategory', $this->normalizeClassName('post_category'));

    }


    /**
     * @test method get and put testing into class Migration compiler and create method
     */
    public function testCompilerMigration()
    {
        $this->mockFile->shouldReceive('get')
            ->once()
            ->andReturn('template');

        $this->mockFile->shouldReceive('put')
           ->times(1);

        $compilerMigration = new Migration($this->mockFile);

        $schema[] = "";
        $compilerMigration->create($schema, 'posts');

    }

}