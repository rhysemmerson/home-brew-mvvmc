<?php

namespace SdMvc\Mvc\Listener;

use SdMvc\Mvc\MvcEvent;

/**
 * Description of BeforeRedirectListener
 *
 * @author Rhys
 */
interface BeforeRedirectListener {
    /**
     * Fired after the controller is resolved and before the action 
     * is invoked.
     * 
     * @param \SdMvc\Mvc\MvcEvent $event
     */
    public function beforeRedirect(MvcEvent $event);
}
