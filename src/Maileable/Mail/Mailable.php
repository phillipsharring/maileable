<?php

namespace Maileable\Mail;

use Maileable\Mail\Filters\Filter;
use Illuminate\Container\Container;
use Illuminate\Mail\Mailable as IlluminateMailable;
use Illuminate\Contracts\Mail\Mailer as MailerContract;

class Mailable extends IlluminateMailable
{
    /**
     * @param  \Illuminate\Contracts\Mail\Mailer  $mailer
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
