<?php

class HomeController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    public function Login() {
        $credentials = Input::only('email', 'password');
        try {
            $user = Sentry::authenticate($credentials, false);
            return $user;
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            echo 'Login field is required.';
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            echo 'Password field is required.';
        } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
            echo 'Wrong password, try again.';
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            echo 'User was not found.';
        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            echo 'User is not activated.';
        } catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            echo 'User is suspended.';
        } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
            echo 'User is banned.';
        }
    }

    public Function Logout() {
        Sentry::logout();
        return array('success' => TRUE);
    }

}
