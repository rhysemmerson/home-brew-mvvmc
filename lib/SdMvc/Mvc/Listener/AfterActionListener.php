<?php

namespace SdMvc\Mvc\Listener;

use SdMvc\Mvc\MvcEvent;

/**
 * Description of BeforeRedirectListener
 *
 * @author Rhys
 */
interface AfterActionListener {
    /**
     * Fired after the acton is invoked.
     * 
     * @param \SdMvc\Mvc\MvcEvent $event
     */
    public function afterAction(MvcEvent $event);
}
