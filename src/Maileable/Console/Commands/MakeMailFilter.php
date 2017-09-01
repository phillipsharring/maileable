<?php

namespace Maileable\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MailFilterMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:mailfilter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a Maileable Mail Filter';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Mail Filter';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/mail-filter.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Mail\Filters';
    }
}
