<?php

namespace BinaryBuilds\LaravelMailManager\Listeners;

use BinaryBuilds\LaravelMailManager\Managers\MailableManager;
use BinaryBuilds\LaravelMailManager\Managers\MailManager;

/**
 * Class MailSentListener
 */
class MailSentListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        MailManager::handleMailSentEvent(new MailableManager, $event);
    }
}
