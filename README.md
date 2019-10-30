# saml-theme
Custom look and feel for the viaa simplesamlphp idp

## Usage within VIAA

Currently there are two IDP realms within VIAA: 'viaa' and 'hetarchief'. For each realm, different IDP instances are deployed for the different environments: production, staging, ... 

Each IDP is configured to use the theme in the `.<realm>-<environment>`directory, for example `.hetarchief-staging` or `.viaa-production` (`theme.use` setting in `config.php`). These realm and environment specific themes directories are generated from the templates by the script `update.sh`. Make sure to run this script *before* committing changes to the templates.

The templates for each realm are located in the `viaa` and `hetarchief` subdirectories in the `themes' directory.
