<?php
/**
 * The Filter Abstract
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

use \Swift_Message;
use Illuminate\Mail\Mailable;

/**
 * Maileable Filter Abstract.
 *
 * Extend this abstract for your Filters.
 * This is done automatically if you use the generator.
 *
 * @category Class
 * @package  Maileable\Mail\Filters
 * @author   Phillip Harrington <phillip@phillipharrington.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/philsown/maileable
 */
abstract class FilterAbstract
{
    /**
     * Modifies
     *
     * @var string $modifies
     *
     * Can be 'swift' or 'mailable', depending on
     * which level you want to do your filtering at.
     */
    public $modifies = 'swift';

    /**
     * Your filter's filter function.
     *
     * @param Swift_Message|Mailable $message The message object you are modifying
     *
     * @return void
     */
    function filter($message)
    {
    }
}
