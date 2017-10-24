<?php
/**
 * The Main Maileable Filter
 *
 * PHP version 5
 *
 * @category Filter
 * @package  Maileable\Mail\Filters
 * @author   Phillip Harrington <phillip@phillipharrington.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/philsown/maileable
 */


namespace Maileable\Mail\Filters;

/**
 * The Main Maileable Filter
 *
 * This calls all of the filters you have configured.
 *
 * @category Class
 * @package  Maileable\Mail\Filters
 * @author   Phillip Harrington <phillip@phillipharrington.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/philsown/maileable
 */
class Filter
{
    /**
     * The configuration array
     *
     * @var array $config
     */
    protected $config = ['filters' => ''];

    /**
     * An array of filters we instantiate
     *
     * @var array $filters
     */
    protected $filters = [];

    /**
     * Filter constructor
     *
     * @param array $config A config array
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * The main filter function.
     *
     * @param Swift_Message|Mailable $mailable The message object you are modifying
     *
     * @return void
     *
     * This calls all of the filters you have configured
     */
    public function filter($mailable)
    {
        $this->checkForFilters($mailable, $this->config['filters']);
    }

    /**
     * This checks for filters
     *
     * @param object $mailable The mailable instance
     * @param array  $filters  An array of configured filter patterns & filters
     *
     * @return void
     */
    protected function checkForFilters($mailable, $filters)
    {
        foreach ($filters as $pattern => $filters) {
            if (!preg_match(
                '#' . str_replace('\\', '\\\\', $pattern) . '#',
                get_class($mailable)
            )
            ) {
                continue;
            }

            $this->applyFilters($mailable, $filters);
        }
    }

    /**
     * This applies any filters that were found
     *
     * @param object $mailable The mailable instance
     * @param array  $filters  An array of filters to apply
     *
     * @return void
     */
    protected function applyFilters($mailable, $filters)
    {
        foreach ($filters as $class) {
            $filter = app()->make($class);

            if ('mailable' == $filter->modifies) {
                // do stuff with the mailable now
                $filter->filter($mailable);
            } elseif ('swift' == $filter->modifies) {
                // do stuff with the raw swift message at send time,
                // using Mailable::runCallbacks
                $mailable->callbacks[] = [$filter, 'filter'];
            }
        }
    }
}
