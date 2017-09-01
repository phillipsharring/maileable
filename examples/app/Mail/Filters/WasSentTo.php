<?php

// this namespace is a suggestion. you can put these anywhere you like in your app
namespace App\Mail\Filters;

// filters must extend FilterAbstract, just in case we add something to it later
use Maileable\Mail\Filters\FilterAbstract;

// this filter modifies the swift message
// change this to Illuminate\Mail\Mailable, make $modifies = 'mailable', and also update the $message parameter type hint for filter() 
use \Swift_Message;

class WasSentTo extends FilterAbstract
{
    // this filter modifies the swift message, which is the FilterAbstract::modifies default
    // change this to 'mailable' and make the $message parameter type hint for filter() Illuminate\Mail\Mailable
    //public $modifies = 'swift';

    /**
     * @param Swift_Message $message
     */
    public function filter($message)
    {
        // copy this view to your app if you want to use this filter
        // we don't publish it because it's just an example
        $disclaimer = view('mail.was-sent-to', ['tos' => collect($message->getTo())])->render();
        $message->setBody(str_replace('</body>', $disclaimer . '</body>', $message->getBody()));
    }
}
