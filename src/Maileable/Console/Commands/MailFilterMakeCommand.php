<?php
/**
 * The Maileable Filter Generator
 *
 * PHP version 5
 *
 * @category Generators
 * @package  Maileable
 * @author   Phillip Harrington <phillip@phillipharrington.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/philsown/maileable
 */

namespace Maileable\Console\Commands;

use Illuminate\Console\GeneratorCommand;

/**
 * Mail Filter Make Command make:mailfilter
 *
 * @category Class
 * @package  Maileable\Console\Commands
 * @author   Phillip Harrington <phillip@phillipharrington.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/philsown/maileable
 */
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
     * @param string $rootNamespace The root namespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Mail\Filters';
    }
}
