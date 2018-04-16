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

/**
 * Verify Service
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
class Verify extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     Recaptcha::$plugin->verify->exampleService()
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
     * This function verify captcha
     */
    public function verify($data)
    {
        $base = "https://www.google.com/recaptcha/api/siteverify";

        $settings = Recaptcha::$plugin->getSettings();

        $ip = $_SERVER['REMOTE_ADDR'];

        $params = [
            'form_params' => [
                'secret'   => $settings['secretKey'],
                'response' => $data,
                'remoteip' => $ip,
            ]
        ];

        $client = new \GuzzleHttp\Client($params);

        try {
            $request = $client->post($base, $params);
            if($request->getStatusCode() === 200)
            {
                $json = json_decode($request->getBody(), true);
                if($json['success'])
                {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch(\Exception $e) {
            return [
                'error' => true,
                'reason' => $e->getMessage()
            ];
        }


    }
}