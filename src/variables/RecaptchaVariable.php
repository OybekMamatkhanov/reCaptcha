<?php
/**
 * recaptcha plugin for Craft CMS 3.x
 *
 * recaptcha
 *
 * @link      https://github.com/OybekMamatkhanov/
 * @copyright Copyright (c) 2018 OybekMamatkhanov
 */

namespace recaptcha\recaptcha\variables;

use recaptcha\recaptcha\Recaptcha;

use Craft;

/**
 * recaptcha Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.recaptcha }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    OybekMamatkhanov
 * @package   Recaptcha
 * @since     1.0.0
 */
class RecaptchaVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.recaptcha.exampleVariable }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.recaptcha.exampleVariable(twigValue) }}
     *
     * @param null $optional
     * @return string
     */
    public function exampleVariable($optional = null)
    {
        $result = "And away we go to the Twig template...";
        if ($optional) {
            $result = "I'm feeling optional today...";
        }
        return $result;
    }
    
    public function render()
    {
        $result = Recaptcha::getInstance()->render->render();
        return $result;
    }
}
