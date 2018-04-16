<?php
/**
 * recaptcha plugin for Craft CMS 3.x
 *
 * recaptcha
 *
 * @link      https://github.com/OybekMamatkhanov/
 * @copyright Copyright (c) 2018 OybekMamatkhanov
 */

namespace recaptcha\recaptcha\controllers;

use craft\helpers\UrlHelper;
use recaptcha\recaptcha\Recaptcha;
use craft\elements\User;
use Craft;
use craft\web\Controller;

/**
 * Recaptcha Controller
 *
 * Generally speaking, controllers are the middlemen between the front end of
 * the CP/website and your plugin’s services. They contain action methods which
 * handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering
 * post data, saving it on a model, passing the model off to a service, and then
 * responding to the request appropriately depending on the service method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what
 * the method does (for example, actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 *
 * @author    OybekMamatkhanov
 * @package   Recaptcha
 * @since     1.0.0
 */
class RecaptchaController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['index', 'do-something', 'save'];

    // Public Methods
    // =========================================================================

    /**
     * Handle a request going to our plugin's index action URL,
     * e.g.: actions/recaptcha/recaptcha
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $result = 'Welcome to the RecaptchaController actionIndex() method';

        return $result;
    }

    /**
     * Handle a request going to our plugin's actionDoSomething URL,
     * e.g.: actions/recaptcha/recaptcha/do-something
     *
     * @return mixed
     */
    public function actionDoSomething()
    {
        $result = 'Welcome to the RecaptchaController actionDoSomething() method';

        return $result;
    }

    /**
     * Handle captcha
     */
    public function actionSave()
    {
        $this->requirePostRequest();
        $captcha =  Craft::$app->request->post('g-recaptcha-response');

        $verified = Recaptcha::getInstance()->verify->verify($captcha);

        if (!$verified) {
            $user = new User();
            $user->addError('recaptcha', Craft::t('app',"Failed reCAPTCHA validation."));
            $user->username = $request->getBodyParam('username');
            $user->email = $request->getBodyParam('email');

            Craft::$app->getUrlManager()->setRouteParams([
                'account' => $user
            ]);
        } else {
            $this->redirect('users/saveUser');
        }
    }
}
