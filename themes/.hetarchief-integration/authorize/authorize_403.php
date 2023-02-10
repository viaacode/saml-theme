<?php
// original file:  /var/www/simplesaml/modules/authorize/www/authorize_403.php
header('HTTP/1.0 403 Forbidden');

// $this->includeAtTemplateBase('includes/env.php');
$env = "integration";
switch ($env) {
  case "integration":
    $prefix= "-int";
  break;
  case "development":
    $prefix= "-tst";
  break;
  case "staging":
    $prefix= "-qas";
  break;
  case "production":
    $prefix= "";
  break;
}

echo "<!--". ($env) .": ".$prefix." -->";
if (!array_key_exists('StateId', $_REQUEST)) {
        throw new SimpleSAML\Error\BadRequest('Missing required StateId query parameter.');
}

$id = $_REQUEST['StateId'];

// sanitize the input
$sid = SimpleSAML\Utilities::parseStateID($id);
if (!is_null($sid['url'])) {
        SimpleSAML\Utilities::checkURLAllowed($sid['url']);
}

if (isset($this->data['logoutURL'])) {
  $logoutURL = $this->data['logoutURL'];
} else {
  $logoutURL = 'logout.php';
}

$reconfirm_URL = "https://account".$prefix.".hetarchief.be/account/herconfirmeer?redirect_to=";

$message = "<p>";

if (isset($this->data['reject_msg'])) {
  $message .= $this->data['reject_msg']['nl'];
  $message .= "<br /><br />";
  $message .= "Geen bevestigingsmail ontvangen? Check je spamfolder of <a href=\"".$reconfirm_URL.urlencode($sid['url'])."\">vraag een nieuwe mail aan.</a>";
} else {
  $message = 'Sorry, je hebt geen toegang tot deze toepassing.';
}

$message .= "<br /><br />";
$message .= "Hulp nodig? Neem contact op via de feedback-knop rechtsonder deze pagina.";
$message .= "</p>";

?>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
  <title>
    Geen toegang - Het Archief
  </title>
  <link rel="stylesheet" href="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/css/hetarchief-full.css?8a9d42b0-de14-4dc1-b301-de8b251fe84c') ?>">
  <meta name="robots" content="noindex">
</head>

<body>
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
      <h1 class="c-h2">Toegang geweigerd</h1>
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
          <?php echo $message;?>
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
  fetch('<?php echo $logoutURL; ?>')
  .then(
    function(response) {
      console.log(response.headers.get('Content-Type'));
      console.log(response.headers.get('Date'));
      console.log(response.status);
      console.log(response.statusText);
      console.log(response.type);
      console.log(response.url);
      if (response.status !== 200) {
        console.log('Logout failed with status ' + response.status)
        return;
      }
    }
  )
  .catch(function(err) {
    console.log('Fetch Logout Error :-S', err);
  });
</script>

<?php $this->includeAtTemplateBase('includes/zendesk.php');?>
</body>
</html>
