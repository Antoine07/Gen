<?php namespace Gentesting\Syntax;

use Gen\Compiler\Factory;
use Gen\MakeMigration;
use GenTesting\AbstractTestCase;

/**
 * test syntax Migration only
 *
 * Class MigrationTest
 */

class MigrationTest extends AbstractTestCase
{


    public function setUp()
    {
        parent::setUp();
        $this->makeMigration = new MakeMigration(new Factory);
    }

    /**
     * test instance of class Migration exist
     */
    public function testGenModel()
    {
        $this->assertInstanceOf('Gen\Commands\Migration', $this->migration);
    }

    /**
     * test syntax
     */
    public function testSyntax()
    {
        $option = 's:title200';
        $solve[] = "string";
        $solve[] = "('title',200)";
        $Solve = $this->syntaxMigration->syntax($option);
        $this->assertEquals($solve, $Solve);
    }

    /**
     *
     * @return array
     */
    public function listSimple()
    {
        return [
            ['s:title200', ['string', "('title',200)"]],
            ['e:status(pu,up,tr)>d(up)', ['enum', "('status',['publish','unpublish','trash'])->default('unpublish')"]],
            ['i:note>default(20)', ['integer', "('note')->default(20)"]],
            ['i:note>d(0)', ['integer', "('note')->default(0)"]],
            ['s:title200ppppp', ['string', "('title',200)"]],
            ['s:email200', ['string', "('email',200)"]],
            ['i:user_id>opt(nullable,unsigned)', ['integer', "('user_id')->nullable()->unsigned()"]],
        ];
    }

    /**
     * @test test simple syntax with method syntax class SyntaxMigration
     *
     * @dataProvider listSimple
     */
    public function testSyntaxWithMethodSyntax($option, $excepted)
    {
        $Solve = $this->syntaxMigration->syntax($option);
        $this->assertEquals($Solve, $excepted);

    }

    /**
     * @return array
     */
    public function listFull()
    {
        return [
            [
                's:title200;e:status(pu,up,tr)>default(up);i:note>d(0);i:user_id>opt(nullable,unsigned)',
                [
                    "\$table->string('title',200);",
                    "\$table->enum('status',['publish','unpublish','trash'])->default('unpublish');",
                    "\$table->integer('note')->default(0);",
                    "\$table->integer('user_id')->nullable()->unsigned();",
                ]
            ],
            [
                's:title100;e:status(pu,up,tr,draft)>d(up);i:note>d(20);i:category_id>option(unsigned)',
                [
                    "\$table->string('title',100);",
                    "\$table->enum('status',['publish','unpublish','trash','draft'])->default('unpublish');",
                    "\$table->integer('note')->default(20);",
                    "\$table->integer('category_id')->unsigned();",
                ]
            ]
        ];
    }

    /**
     * @test syntax full test
     *
     * @dataProvider listFull
     */
    public function testFull($option, $excepted)
    {
        $getSyntax = self::getMethod('getSyntax', 'Gen\MakeMigration');
        $Solve = $getSyntax->invokeArgs($this->makeMigration, [['schema' => $option]]);
        $this->assertEquals($Solve, $excepted);
    }


    /**
     * @return array
     */
    public function listForeign()
    {
        return [
            [
                'user_id:null',
                [
                    "\$table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');"
                ],
                'user_id:cascade',
                [
                    "\$table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');"
                ],
                'user_id',
                [
                    "\$table->foreign('user_id')->references('id')->on('users');"
                ]
            ]
        ];
    }

    /**
     * @test test foreign key
     *
     * @dataProvider listForeign
     */
    public function testForeignKey($option, $excepted)
    {
        $getSyntax = self::getMethod('getSyntax', 'Gen\MakeMigration');
        $Solve = $getSyntax->invokeArgs($this->makeMigration, [['foreign' => $option]]);

        $this->assertEquals($Solve, $excepted);
    }


    /**
     * @return array
     */
    public function listBadInvalidArg()
    {
        return [
            ['lskdlqsdkl:~'],
            ['inoted~20'],
        ];
    }

    /**
     * @expectedException InvalidArgumentException
     *
     * @dataProvider listBadInvalidArg
     */
    public function testInvalidExceptionArg($opt)
    {
        $this->syntaxMigration->syntax($opt);
    }

}