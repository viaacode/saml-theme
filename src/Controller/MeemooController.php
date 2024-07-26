<?php

namespace SimpleSAML\Module\meemoo\Controller;

use Twig\Environment;
use SimpleSAML\XHTML\TemplateControllerInterface;

class MeemooController implements TemplateControllerInterface
{
    /**
     * These language detections are called seperately before this controller is instantiated (using a public static for this)
     * Set following in the config/config.php so that this method is called:
     * 'language.get_language_function' => array('\SimpleSAML\Module\meemoo\Controller\MeemooController', 'detectRelayLanguage'),
     *
     * @param 
     * @return locale as string or null for default (locale format is 'en', 'nl')
     */

    public static function getRelayLanguage($lang, $state_key, $form_query) {
        $auth_state = $form_query[$state_key];
        $auth_parts = explode('https://', $auth_state);
        if (count($auth_parts) != 2) return $lang;
        
        # now fetch platform language from RelayState if its supplied
        $redirect_url = "https://".$auth_parts[1];
        $redir_parts = parse_url($redirect_url);
        parse_str($redir_parts['query'], $redir_query);
        if (!array_key_exists('RelayState', $redir_query)) return $lang; 

        $relay_state = $redir_query['RelayState'];
        $relay_data = json_decode($relay_state);
        if ($relay_data == null) return $lang;

        // check for language property in relay state
        if (property_exists($relay_data, 'language')) {
          $platform_language = $relay_data->{'language'};
          if ($platform_language != null) $lang = $platform_language;
        }

        return $lang;
    }

    public static function detectRelayLanguage($language_module) 
    {
        // we use the getDefaultLanguage() which is the language.default specified in config.php as safe fallback
        $lang = $language_module->getDefaultLanguage();

        // get language from relay state in our request_uri
        $request_uri = $_SERVER['REQUEST_URI'];
        $form_parts = parse_url($request_uri);

        if (!array_key_exists('query', $form_parts)) return $lang; 
        parse_str($form_parts['query'], $form_query);


        // fetch language from AuthState or StateId if available
        if (array_key_exists('AuthState', $form_query)){
          $lang = MeemooController::getRelayLanguage($lang, 'AuthState', $form_query);
        } 
        else if (array_key_exists('StateId', $form_query)){
          $lang = MeemooController::getRelayLanguage($lang, 'StateId', $form_query);
        } 

        return $lang;
    }

    /**
     * Modify the twig environment after its initialization (e.g. add filters or extensions).
     *
     * @param \Twig\Environment $twig The current twig environment.
     * @return void
     */
    public function setUpTwig(Environment &$twig): void
    {
    }

    private function get_logout_link(): string {
      $request_uri = $_SERVER['REQUEST_URI'];

      // custom logout fallback shows a static logout page
      $defaultLogoutPage = "/module.php/meemoo/assets/logout_nl.html";
      $customLogoutUrl = '/module.php/core/logout/viaa-ldap-people?ReturnTo='.$defaultLogoutPage;


      // check for returnToUrl so we can redirect back to platform after logging out
      $logout_uri_parts = parse_url($request_uri);
      if (!array_key_exists('query', $logout_uri_parts)) return $customLogoutUrl;
      parse_str($logout_uri_parts['query'], $uri_query);
     
      if (!array_key_exists('StateId', $uri_query)) return $customLogoutUrl;
      $logout_state = $uri_query['StateId'];
     
      $state_parts = explode('https://', $logout_state);
      if (count($state_parts) != 2) return $customLogoutUrl;

      $logout_redir = parse_url('https://'.$state_parts[1]);
      parse_str($logout_redir['query'], $logout_params);
      
      if (!array_key_exists('RelayState', $logout_params)) return $customLogoutUrl;
      $logout_relay = $logout_params['RelayState'];

      $logout_data = json_decode($logout_relay);
      if ($logout_data == null) return $customLogoutUrl;

      # use platform chosen language if available
      if (property_exists($logout_data, 'language')) {
        $lang = $logout_data->{'language'};
        if ($lang != null) {
          $defaultLogoutPage = "/module.php/meemoo/assets/logout_".$lang.".html";
          $customLogoutUrl = '/module.php/core/logout/viaa-ldap-people?ReturnTo='.$defaultLogoutPage;
         }
      }

      # use platform returnToUrl if available
      if (property_exists($logout_data, 'returnToUrl')) {
        $logoutReturnTo = $logout_data->{'returnToUrl'};
        if ($logoutReturnTo != null) {
          $customLogoutUrl = '/module.php/core/logout/viaa-ldap-people?ReturnTo='.$logoutReturnTo;
        }
      }

      return $customLogoutUrl;
    }

    private function get_redirect_link(array &$data) {
      // default fallback redirectTo
      $redirectTo = urlencode("/"); // set default in case no formUrl or AuthState is found

      // compute redirectTo in case we have AuthState data in the url 
      if (!array_key_exists('formURL', $data)) return $redirectTo;

      $form_parts = parse_url($data['formURL']);
      parse_str($form_parts['query'], $form_query);

      if (!array_key_exists('AuthState', $form_query)) return $redirectTo;

      $auth_state = $form_query['AuthState'];
      $auth_parts = explode('https://', $auth_state);
      if (count($auth_parts) == 2 ) {
        $redirectTo = urlencode("https://".$auth_parts[1]);
      }

      return $redirectTo;
    }

    /**
     * Add, delete or modify the data passed to the template.
     *
     * This method will be called right before displaying the template.
     *
     * @param array $data The current data used by the template.
     * @return void
     */
    public function display(array &$data): void
    {
        // use SSUM_ENV var
        $ssum_url = getenv('SSUM_URL');
        if ($ssum_url == false) {
            $ssum_url = "https://ssum-tst-iam.private.cloud.meemoo.be";
        }

        // added for having a redirectTo on the password forget link
        $data['ssumUrl'] = $ssum_url;

        // customLogoutUrl is used in authorize/authorize_403.twig
        $data['customLogoutUrl'] = $this->get_logout_link();
        
        // The redirectTo is used in core/loginuserpass.twig for the password forget link
        $data['redirectTo'] = $this->get_redirect_link($data);
    }
}
