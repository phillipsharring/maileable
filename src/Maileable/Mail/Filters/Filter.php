<?php

namespace Maileable\Mail\Filters;

class Filter
{
    /** @var array $config */
    protected $config = ['filters' => ''];

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function filter($mailable)
    {
        foreach ($this->config['filters'] as $pattern => $filters) {
            if (!preg_match('#' . str_replace('\\', '\\\\', $pattern) . '#', get_class($mailable))) {
                continue;
            }

            foreach ($filters as $class) {
                $filter = app()->make($class);

                if ('mailable' == $filter->modifies) {
                    // do stuff with the mailable now
                    $filter->filter($mailable);
                } elseif ('swift' == $filter->modifies) {
                    // do stuff with the raw swift message at send time, using Mailable::runCallbacks
                    $mailable->callbacks[] = [$filter, 'filter'];
                }
            }
        }
    }
}
