# Command generator

[![Build Status](https://travis-ci.org/Antoine07/Gen.svg?branch=master)](https://travis-ci.org/Antoine07/Gen-database)

This Laravel package speed up development process to generate migration file:

- `gen:migration`

## Usage

### step 1: install with Composer

composer require antoine07/gen dev-master

### step 2: Add the service provider

For development only put in `app/Providers/AppServiceProvider.php`, like so:

```php
public function register()
{
	if ($this->app->environment() == 'local') {
		$this->app->register('Gen\GenServiceProvider');
	}
}
```

### Migrations With Schema

```
php artisan gen:migration post --schema="string:title200;enum:status(publish,unplish,trash)>default(up);integer:note>default(0);integer:user_id>option(nullable,unsigned)" 

```
Notice this example create file migration with schema

### Migrations With Schema and foreign key (table relation exists)

```
php artisan gen:migration post --schema="string:title200;enum:status(publish,unplish,trash)>default(up)" --foreign="user_id:cascade"

```
Notice this example create file migration with foreign key option cascade if you wont set null write "user_id:null"

### Example

```php
/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function(Blueprint $table) {
            $table->increments('id');
			$table->string('title',200);
			$table->enum('status',['publish','unpublish','trash'])->default('unpublish');
			$table->integer('note')->default(0);
			$table->integer('user_id')->nullable()->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::drop('posts');
    }

```