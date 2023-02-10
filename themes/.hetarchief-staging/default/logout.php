
<!DOCTYPE html>
<html dir="ltr" lang="nl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
  <title>Inloggen - VIAA
  </title>
  <link rel="stylesheet" href="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/css/hetarchief-full.css?8a9d42b0-de14-4dc1-b301-de8b251fe84c') ?>">
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
            <img src="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/img/logo-meemoo.svg')?>" height="90" alt="Logo meemoo - Vlaams Instituut voor het Archief" title="Logo meemoo" />
          </div>
          <div class="">
            <img src="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/img/logo-hetarchief.svg')?>" height="40" alt="Logo Het Archief - Een initiatief van meemoo" title="Logo Het Archief" />
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
    </div>
  </div>
</body>
</html>
