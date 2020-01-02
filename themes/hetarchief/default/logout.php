
<!DOCTYPE html>
<html dir="ltr" lang="nl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
  <title>Inloggen - VIAA
  </title>
  <link rel="stylesheet" href="<?php echo SimpleSAML_Module::getModuleURL('themeviaa/css/hetarchief.css') ?>">
  <meta name="robots" content="noindex">
</head>

<body>
  <div class="o-container-vertical">
    <div class="o-container o-container--small">
      <div class="u-spacer-bottom-l">
        <h1 class="c-brand c-brand--large">
          <img src="<?php echo SimpleSAML_Module::getModuleURL('themeviaa/img/logo-algemeen.svg')?>" alt="Het Archief">
        </h1>
      </div>
      <hr class="c-hr">
      <?php if ($this->data['errorcode'] !== NULL) { ?>
      <div class="c-alert">
        <div class="c-alert__body">
          <div class="u-spacer-right-s">
            <div class="o-svg-icon o-svg-icon-button-multicolor-circle-warning  ">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="24" height="24" fill="black" fill-opacity="0"></rect>
                <path d="M2 12C2 6.48 6.48 2 12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12Z" fill="#FF1744"></path>
                <path d="M13 17H11V15H13V17ZM13 13H11V7H13V13Z" fill="white"></path>
              </svg>
            </div>
          </div>
          <p><?php echo $this->t('{errors:title_' . $this->data['errorcode'] . '}'); ?></p>
        </div>
      </div>
      <?php } ?>
          <div class="c-content">
            <p class="u-text-muted">
              Je bent uitgelogd.
            </p>
          </div>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
