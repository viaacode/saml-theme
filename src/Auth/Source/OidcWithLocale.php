<?php
// modules/meemoo/src/Auth/Source/OidcWithLocale.php
// Extracts the locale from the saml RelayState and adds it as oidc parameter
// to the state by overriding the authoauth2:OpenIDConnect authorize function
//
// At meemoo, a SAML SP provider may pass the language chosen by the user as a
// value to the key 'language' in the json formated RelayState of the SAML
// Login Request.
// This function puts this language in the state parameters oidc:ui_locale and
// oidc:kc_locale.
// In combination with the authoauth2:OpenIDConnect authentication source, which
// converts values from the state parameters prefixed with oidc: into url parameters
// to the authorization request (without the prefix)
// see function getAuthorizeOptionsFromState in src/Auth/Source/OpenIDConnect.php

namespace SimpleSAML\Module\meemoo\Auth\Source;

use SimpleSAML\Logger;
use SimpleSAML\Module\authoauth2\Auth\Source\OpenIDConnect;

class OidcWithLocale extends OpenIDConnect
{
    public function authenticate(array &$state): void
    {
        $relayState = $state['saml:RelayState'] ?? null;

        if ($relayState !== null) {
            $decoded = json_decode(urldecode($relayState), true);

            if (!empty($decoded['language'])) {
                $language = $decoded['language'];
                Logger::debug('OidcWithLocale: injecting locale' . $language);

                // getAuthorizeOptionsFromState() will pick up any key
                // prefixed with 'oidc:' and pass it to the authorization URL
                $state['oidc:ui_locales'] = $language;
                $state['oidc:kc_locale'] = $language;
            }
        }

        parent::authenticate($state);
    }
}
