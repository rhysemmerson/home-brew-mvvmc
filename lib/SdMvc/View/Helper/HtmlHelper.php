<?php

namespace SdMvc\View\Helper;

use SdMvc\View\ViewHelper;

/**
 * Description of HtmlHelper
 *
 * @author Rhys
 */
class HtmlHelper extends ViewHelper {

    public function unorderedList($items) {
        return '<ul><li>' .
                implode('</li><li>', $items) .
                '</li></ul>';
    }

}
