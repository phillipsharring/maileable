<?php

// this namespace is a suggestion. you can put these anywhere you like in your app
namespace App\Mail\Filters;

// filters must extend FilterAbstract, just in case we add something to it later
use Maileable\Mail\Filters\FilterAbstract;

// this filter modifies the mailable object
// change this to \Swift_Message, make $modifies = 'mailable', and also update the $message parameter type hint for filter()
use Illuminate\Mail\Mailable;

class CleanUpFromAddress extends FilterAbstract
{
    public $modifies = 'mailable';

    /**
     * Filter
     *
     * @param Mailable $message
     *
     * @return void
     */
    public function filter($message)
    {
        $froms = $message->from;

        foreach ($froms as &$from) {
            if ('contact@mycompany.com' != $from['address'] || !empty($from['name'])) {
                continue;
            }

            $from['name'] = 'My Company';
        }

        $message->from = $froms;
    }
}
