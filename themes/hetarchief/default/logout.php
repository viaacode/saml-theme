
<!DOCTYPE html>
<html dir="ltr" lang="nl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
  <title>Inloggen - VIAA
  </title>
  <link rel="stylesheet" href="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/css/hetarchief-full.css?73d06637-c0fd-4810-a5b0-1b83847ee305') ?>">
  <meta name="robots" content="noindex">
  <?php $this->includeAtTemplateBase('includes/google-tag-manager.head.php');?>
</head>

<body>
<?php $this->includeAtTemplateBase('includes/google-tag-manager.body.php');?>
<div class="o-container-vertical" style="margin-top:2em;">
    <div class="o-container o-container--small">
      <div class="u-spacer-bottom-l">
        <div class="o-flex o-flex--align-baseline o-flex--justify-between">
          <div class="">
            <img src="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/img/logo-meemoo.svg')?>" alt="Logo meemoo - Vlaams Instituut voor het Archief" title="Logo meemoo" />
          </div>
          <div class="">
            <img src="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/img/logo-hetarchief.svg')?>" alt="Logo Het Archief - Een initiatief van meemoo" title="Logo Het Archief" />
          </div>
        </div>
      </div>
      <hr class="c-hr">
      <div class="c-content">
        <h1 class="c-h2">Je bent uitgelogd</h1>
        <p>
          Bedankt voor je bezoek en tot gauw!
        </p>
      </div>
      <hr class="c-hr">
      <div class="o-flex o-flex--vertical">
        <p class="o-flex__item u-text-center u-text-muted">
          Met dit account krijg je toegang tot services van <a href="https://meemoo.be">meemoo</a> (&copy; 2023).
        </p>
      </div>
    </div>
  </div>
</body>
</html>
