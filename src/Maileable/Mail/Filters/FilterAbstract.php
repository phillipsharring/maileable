<?php

namespace Maileable\Mail\Filters;

use \Swift_Message;
use Illuminate\Mail\Mailable;

abstract class FilterAbstract
{
    /** @var string $modifies can be 'swift' or 'mailable', depending on which level you want to do your filtering at */
    public $modifies = 'swift';

    /**
     * @param Swift_Message|Mailable $message
     */
    function filter($message) {
    }
}
