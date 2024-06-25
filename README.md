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


4. Now copy the meemoo module with themed files and stylesheets to the modules inside the simplesampl deployed application:
```
cp -r saml-theme/saml_v2/modules/meemoo /usr/local/idp-tst.hetarchief.be/simplesamlphp-2.2.2/modules/
```


### Future more advanced core overrides
To override core templates like the login page located at simplesamlphp-2.2.2/modules/core/templates we can put a modified/custom version in
the theme's core directory. For example we have done this already to add a password forget link into the loginuserpass.twig template (and most likely more changes soon).

```
saml_v2/modules/meemoo/themes/meemootheme/core/loginuserpass.twig
```
Since this is also part of the saml_v2/modules/meemoo directory it already gets activated with the copy command in step 4.


5. Copy the locales folder to get correct english and dutch translation strings
Inside the saml_v2/locales dir there are two folders nl and en that should be used to override and extend the default simple saml translation strings.
```
cp -r samle-theme/saml_v2/locales/* /usr/local/idp-tst.hetarchief.be/simplesamlphp-2.2.2/locales
```
