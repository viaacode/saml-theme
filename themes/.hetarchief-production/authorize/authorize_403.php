<?php
// original file:  /var/www/simplesaml/modules/authorize/www/authorize_403.php
header('HTTP/1.0 403 Forbidden');

if (!array_key_exists('StateId', $_REQUEST)) {
        throw new SimpleSAML_Error_BadRequest('Missing required StateId query parameter.');
}

$id = $_REQUEST['StateId'];

// sanitize the input
$sid = SimpleSAML_Utilities::parseStateID($id);
if (!is_null($sid['url'])) {
        SimpleSAML_Utilities::checkURLAllowed($sid['url']);
}

if (isset($this->data['logoutURL'])) {
  $logoutURL = htmlspecialchars($this->data['logoutURL']);
} else {
  $logoutURL = 'logout.php';
}

?>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
  <title>
    Geen toegang - Het Archief
  </title>
  <link rel="stylesheet" href="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/css/hetarchief.css') ?>">
  <meta name="robots" content="noindex">
</head>

<body>
  <div class="o-container-vertical">
    <div class="o-container o-container--small">
      <div class="u-spacer-bottom-l">
        <h1 class="c-brand c-brand--large">
          <img src="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/img/logo-algemeen.svg')?>" alt="Het Archief">
        </h1>
      </div>
      <hr class="c-hr">
      <h3 class="c-h2">Toegang geweigerd</h3>
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
          <p>
          <?php
                 if (isset($this->data['reject_msg'])) {
                   echo $this->data['reject_msg']['nl'];
                 } else {
                   echo 'Sorry, je hebt geen toegang tot deze toepassing.';
                 }?>
          <br />
          Vragen? Contacteer <a href="mailto:support@viaa.be?subject=Toegang%20met%20VIAA-account">support@viaa.be</a>
          </p>
        </div>
      </div>
      <hr class="c-hr">
      <div class="o-flex o-flex--justify-between" style="height: 100px;">
        <div style="width: 200px;">
          <p class="u-text-muted">
            &nbsp;
          </p>
        </div>
        <div style="width: 200px;">
          <p class="u-text-right u-text-muted">
            <a href="<?php echo $logoutURL; ?>">Afmelden</a></p>
        </div>
      </div>
    </div>
  </div>

  <script>
     let xhr = new XMLHttpRequest();
     xhr.open('GET', "<?php echo $logoutURL;?>");
     xhr.send();
  </script>
</body>
</html>
