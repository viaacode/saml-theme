# saml-theme
Custom look and feel for the viaa simplesamlphp idp

## SimpleSamlPhp v2 : Custom meemoo theme

Configure the new meemoo theme by making following changes to /usr/local/idp-tst.hetarchief.be/simplesamlphp/config/config.php:

1. Add meemoo module to the module.enable section (last line is added)

```
  'module.enable' => [
    'idp' => true,
    'core' => true,
    'admin' => true,
    'saml' => true,
    'ldap' => true,
    'saml-idp' => true,
    'authorize' => true,
    'meemoo' => true
  ],
```

2. Change available languages and remove all entries except english and dutch:

```
    'language.available' => array(
        'en', 'nl' 
    ),
```

3. Set the correct theme (remove current line 'theme.use' => 'themeviaa:.hetarchief...) and add:
```
  'theme.use' => 'meemoo:meemootheme',
```

4. Add headers.security with less strict csp headers so that google tag manager and zendesk javascript can be loaded (external source):
```
    'headers.security' => array(
        'X-Frame-Options' => 'SAMEORIGIN',
        'X-Content-Type-Options' => 'nosniff',
        'Referrer-Policy' => 'origin-when-cross-origin',
    ),
```

5. Now copy the meemoo module with themed files and stylesheets to the modules inside the simplesampl deployed application:
```
cp -r saml-theme/saml_v2/modules/meemoo /usr/local/idp-tst.hetarchief.be/simplesamlphp-2.2.2/modules/
```

6. Copy the locales folder to get correct english and dutch translation strings
Inside the saml_v2/locales dir there are two folders nl and en that should be used to override and extend the default simple saml translation strings.
```
cp -r saml-theme/saml_v2/locales/* /usr/local/idp-tst.hetarchief.be/simplesamlphp-2.2.2/locales
```

7. Copy the customized controller that adds returnTo variable and SSUM_URL env var for customization.
(we might refactor this later to use a module controller instead).
```
cp saml-theme/saml_v2/Login.php  /usr/local/idp-tst.hetarchief.be/simplesamlphp-2.2.2/modules/core/src/Controller/
```

Set SSUM_URL environment variable to correct SSUM base url. This can be "https://account-qas.hetarchief.be" or "https://account.hetarchief.be"
if this is not set the fallback is "https://account-qas.hetarchief.be". This will be used as the base url for the ssum server.

This can be done in the docker environment or you can directly use an apache config directive:
```
SetEnv SSUM_URL "https://account.hetarchief.be"
```

