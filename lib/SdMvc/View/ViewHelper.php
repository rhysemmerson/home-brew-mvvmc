<?php

namespace SdMvc\View;

/**
 * Description of ViewHelper
 *
 * @author Rhys
 */
class ViewHelper implements ViewHelperInterface {

    public $view;

    public function __construct(\SdMvc\View\View $view) {
        $this->view = $view;
    }

}
