<?php

use Illuminate\Database\Seeder;

class {{class}} extends Seeder
{
    public function run()
    {
        DB::table('{{table}}')->insert([
{{seeds}}
        ]);
    }
}