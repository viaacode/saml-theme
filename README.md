# saml-theme
Custom look and feel for the viaa simplesamlphp idp

## Usage within VIAA

Currently there are two IDP realms within VIAA: 'viaa' and 'hetarchief'. For each realm, different IDP instances are deployed for the different environments: production, staging, ... 

Each IDP is configured to use the theme in the `.<realm>-<environment>`directory, for example `.hetarchief-staging` or `.viaa-production` (`theme.use` setting in `config.php`). These realm and environment specific themes directories are generated from the templates by the script `update.sh`. Make sure to run this script *before* committing changes to the templates.

The templates for each realm are located in the `viaa` and `hetarchief` subdirectories in the `themes' directory.


# SAML v2 Meemoo theme

Configure the new meemoo theme by following changes in /usr/local/idp-tst.hetarchief.be/simplesamlphp/config/config.php:

1. Add meemoo module to the module.enable section

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

3. Set the correct theme (remove 'theme.use' => 'themeviaa:.hetarchief-development',) and add:
```
  'theme.use' => 'meemoo:meemootheme',
```


Now copy the meemoo module with themed files and stylesheets:
```
cp -r saml-theme/saml_v2/modules/meemoo /usr/local/idp-tst.hetarchief.be/simplesamlphp-2.2.2/modules/
```


