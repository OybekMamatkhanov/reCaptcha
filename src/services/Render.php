<?php
/**
 * recaptcha plugin for Craft CMS 3.x
 *
 * recaptcha
 *
 * @link      https://github.com/OybekMamatkhanov/
 * @copyright Copyright (c) 2018 OybekMamatkhanov
 */

namespace recaptcha\recaptcha\services;

use recaptcha\recaptcha\Recaptcha;

use Craft;
use craft\base\Component;
use craft\web\View;

/**
 * Render Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    OybekMamatkhanov
 * @package   Recaptcha
 * @since     1.0.0
 */
class Render extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     Recaptcha::$plugin->render->exampleService()
     *
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';
        // Check our Plugin's settings for `someAttribute`
        if (Recaptcha::$plugin->getSettings()->someAttribute) {
        }

        return $result;
    }

       /**
     * This function renders captcha
     */
    public function render()
    {
        $settings = Recaptcha::$plugin->getSettings();

        $oldMode = Craft::$app->view->getTemplateMode();
        
        Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);
        
        $variables = [
            'id' => 'gRecaptchaContainer',
            'siteKey' => $settings['siteKey']
        ];

        $html = Craft::$app->view->renderTemplate("recaptcha/captcha", $variables);

        Craft::$app->view->setTemplateMode($oldMode);

        Craft::$app->view->registerJs('https://www.google.com/recaptcha/api.js');

        return $html;
    }
}
