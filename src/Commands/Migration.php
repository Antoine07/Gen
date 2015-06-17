<?php namespace Gen\Commands;

use Gen\Exception\GenException;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Gen\MakeMigration;

class Migration extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'gen:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generator migration by Antoine07';

    protected $makeMigration;

    /**
     * @param MakeMigration $makeMigration
     */
    public function __construct(
        MakeMigration $makeMigration

    )
    {
        parent::__construct();
        $this->makeMigration = $makeMigration;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        try {

            $resource = $this->argument('resource');
            $options = [];

            if ($schema = $this->option('schema')) {
                $options['schema'] = $schema;
            }

            if ($foreign = $this->option('foreign')) {
                $options['foreign'] = $foreign;
            }

            $this->makeMigration->make($resource, $options);

            $this->info('created migration successfully');

        } catch (GenException $e) {
            $this->info($e->getMessage());
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['resource', InputArgument::REQUIRED, 'the name of resource is required'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['schema', null, InputOption::VALUE_OPTIONAL, 'type:name and options, name(value) or mane and option >d(up) >opt(nullable, unique) ', null],
            ['foreign', null, InputOption::VALUE_OPTIONAL, 'relation with another table'],
        ];
    }

}
