<?php

// this namespace is a suggestion. you can put these anywhere you like in your app
namespace App\Mail\Filters;

// filters must extend FilterAbstract, just in case we add something to it later
use Maileable\Mail\Filters\FilterAbstract;

// this filter modifies the swift message
// change this to Illuminate\Mail\Mailable, make $modifies = 'mailable', and also update the $message parameter type hint for filter()
use \Swift_Message;

class CleanUpFromAddressSwift extends FilterAbstract
{
    // this filter modifies the swift message, which is the FilterAbstract::modifies default
    // change this to 'mailable' and make the $message parameter type hint for filter() Illuminate\Mail\Mailable
    //public $modifies = 'swift';

    /**
     * @param Swift_Message $message
     */
    public function filter($message)
    {
        $froms = $message->getFrom();

        foreach ($froms as $email => &$name) {
            if ('contact@mycompany.com' != $email || !empty($name)) {
                continue;
            }

            $name = 'My Company';
        }

        $message->setFrom($froms);
    }
}
