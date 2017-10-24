<?php
/**
 * The Main Maileable Class
 *
 * PHP version 5
 *
 * @category Maileable\Mail
 * @package  Maileable
 * @author   Phillip Harrington <phillip@phillipharrington.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/philsown/maileable
 */

namespace Maileable\Mail;

use Maileable\Mail\Filters\Filter;
use Illuminate\Container\Container;
use Illuminate\Mail\Mailable as IlluminateMailable;
use Illuminate\Contracts\Mail\Mailer as MailerContract;

/**
 * Mailable main class
 *
 * @category Class
 * @package  Maileable\Mail
 * @author   Phillip Harrington <phillip@phillipharrington.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/philsown/maileable
 */
class Mailable extends IlluminateMailable
{
    /**
     * This overrides the IlluminateMailable send command, then calls it.
     *
     * @param \Illuminate\Contracts\Mail\Mailer $mailer The mailer instance
     *
     * @return void
     */
    public function send(MailerContract $mailer)
    {
        Container::getInstance()->call([$this, 'build']);

        $filter = app()->make(Filter::class);
        $filter->filter($this);

        return parent::send($mailer);
    }
}
