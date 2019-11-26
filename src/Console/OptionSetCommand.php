<?php

namespace Reallyli\Options\Console;

use Illuminate\Console\Command;
use Reallyli\Options\Facade\Option;

class OptionSetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'option:set
                            {module : Option module}
                            {key : Option key}
                            {value : Option value}
                            {comment : Option comment}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an option.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Option::set(
            $this->argument('module'),
            $this->argument('key'),
            $this->argument('value'),
            $this->argument('comment')
        );

        $this->info('Option added.');
    }
}
