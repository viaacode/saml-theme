<?php
$env = "production";
switch ($env) {
  case "integration":
      $prefix= "int.";
      break;
  case "development":
      $prefix= "tst.";
      break;
  case "staging":
      $prefix= "qas.";
      break;
  case "production":
      $prefix= "";
      break;
}

$state = isset($_REQUEST["AuthState"]) ? ($_REQUEST["AuthState"]) : NULL;

// sanitize the input
$sid = SimpleSAML\Utilities::parseStateID($state);
if (!is_null($sid['url'])) {
  SimpleSAML\Utilities::checkURLAllowed($sid['url']);
  }
?>
<!DOCTYPE html>
<html dir="ltr" lang="nl">
<head>
  <title>
    Inloggen - Het Archief
  </title>
  <meta charset="utf-8">
  <meta name="application-name" content="idp<?php echo " ".$env;?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
  <link rel="stylesheet" href="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/css/hetarchief-full.css?55709da8-69ee-4d77-a574-ebc56a5c5bf1') ?>">
  <link rel="stylesheet" href="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/css/eye.css') ?>">
  <script src="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/js/app.js') ?>"></script>
  <?php $this->includeAtTemplateBase('includes/google-tag-manager.head.php');?>
</head>

<body>
<?php $this->includeAtTemplateBase('includes/google-tag-manager.body.php');?>
<script>
<?php echo "console.log(".json_encode(get_defined_vars(), JSON_HEX_TAG).");"; ?>
<?php echo "console.log(".json_encode($this->data, JSON_HEX_TAG).");"; ?>
</script>
  <div class="o-container-vertical" style="margin-top:2em;">
    <div class="o-container o-container--small">
      <div class="u-spacer-bottom-l">
        <div class="o-flex o-flex--align-baseline o-flex--justify-between">
          <div>
            <img src="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/img/logo-meemoo.svg')?>" alt="Logo meemoo - Vlaams Instituut voor het Archief" title="Logo meemoo" class="logo--meemoo" />
          </div>
          <div>
            <img src="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/img/logo-hetarchief.svg')?>" alt="Logo Het Archief - Een initiatief van meemoo" title="Logo Het Archief" class="logo--hetarchief" />
          </div>
        </div>
      </div>
      <hr class="c-hr">
      <?php if ($this->data['errorcode'] !== NULL) { ?>
      <div class="c-alert c-alert--danger">
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
      <?php if ($this->data['errorcode'] == "WRONGUSERPASS" && preg_match('/avo2/', $this->data['SPMetadata']['entityid']))  { ?>
      <div class="u-spacer-top-l">
        <div class="c-alert c-alert--info">
	        <div class="o-flex o-flex--vertical" style="margin: 0 auto;">
	          <p class="o-flex__item u-text-center">Is dit de eerste keer dat je je aanmeldt met je 'Het Archief'-account?<br />Stel dan eerst je wachtwoord in.</p>
	          <p class="o-flex__item u-spacer-s u-text-center">
              <button class="c-button c-button--link">
                <div class="c-button__content">
		              <div class="c-button__label">
                    <a href="https://account.hetarchief.be/users/password/new?redirect_to=<?php echo urlencode($sid['url']); ?>">Een nieuw wachtwoord instellen</a>
                  </div>
                </div>
              </button>
            </p>
          </div>
        </div>
      <hr class="c-hr">
      <?php } ?>
      <h1 class="c-h2">Inloggen</h1>
      <form name="loginform" id="loginform" action="?" method="post">
        <div class="u-spacer-bottom-l">
          <div class="o-form-group-layout o-form-group-layout--standard">
            <div class="o-form-group">
              <label class="o-form-group__label" for="emailId">E-mailadres</label>
              <div class="o-form-group__controls">
                <input name="username" class="c-input" id="emailId" type="text">
              </div>
            </div>
            <div class="o-form-group">
              <label class="o-form-group__label" for="passwordId">
                Wachtwoord
                <img id="eye-open" onclick="toggleShowPassword('passwordId')" src="data:image/svg+xml;base64,PHN2ZyBhcmlhLWhpZGRlbj0idHJ1ZSIgZm9jdXNhYmxlPSJmYWxzZSIgZGF0YS1wcmVmaXg9ImZhcyIgZGF0YS1pY29uPSJleWUiIHJvbGU9ImltZyIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgNTc2IDUxMiIgY2xhc3M9InN2Zy1pbmxpbmUtLWZhIGZhLWV5ZSBmYS13LTE4IGZhLTJ4Ij48cGF0aCBmaWxsPSIjMjVhNGNmIiBkPSJNNTcyLjUyIDI0MS40QzUxOC4yOSAxMzUuNTkgNDEwLjkzIDY0IDI4OCA2NFM1Ny42OCAxMzUuNjQgMy40OCAyNDEuNDFhMzIuMzUgMzIuMzUgMCAwIDAgMCAyOS4xOUM1Ny43MSAzNzYuNDEgMTY1LjA3IDQ0OCAyODggNDQ4czIzMC4zMi03MS42NCAyODQuNTItMTc3LjQxYTMyLjM1IDMyLjM1IDAgMCAwIDAtMjkuMTl6TTI4OCA0MDBhMTQ0IDE0NCAwIDEgMSAxNDQtMTQ0IDE0My45MyAxNDMuOTMgMCAwIDEtMTQ0IDE0NHptMC0yNDBhOTUuMzEgOTUuMzEgMCAwIDAtMjUuMzEgMy43OSA0Ny44NSA0Ny44NSAwIDAgMS02Ni45IDY2LjlBOTUuNzggOTUuNzggMCAxIDAgMjg4IDE2MHoiIGNsYXNzPSIiPjwvcGF0aD48L3N2Zz4K" />
                <img id="eye-closed" onclick="toggleShowPassword('passwordId')" src="data:image/svg+xml;base64,PHN2ZyBhcmlhLWhpZGRlbj0idHJ1ZSIgZm9jdXNhYmxlPSJmYWxzZSIgZGF0YS1wcmVmaXg9ImZhcyIgZGF0YS1pY29uPSJleWUtc2xhc2giIGNsYXNzPSJzdmctaW5saW5lLS1mYSBmYS1leWUtc2xhc2ggZmEtdy0yMCIgcm9sZT0iaW1nIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2NDAgNTEyIj48cGF0aCBmaWxsPSIjMjVhNGNmIiAgZD0iTTMyMCA0MDBjLTc1Ljg1IDAtMTM3LjI1LTU4LjcxLTE0Mi45LTEzMy4xMUw3Mi4yIDE4NS44MmMtMTMuNzkgMTcuMy0yNi40OCAzNS41OS0zNi43MiA1NS41OWEzMi4zNSAzMi4zNSAwIDAgMCAwIDI5LjE5Qzg5LjcxIDM3Ni40MSAxOTcuMDcgNDQ4IDMyMCA0NDhjMjYuOTEgMCA1Mi44Ny00IDc3Ljg5LTEwLjQ2TDM0NiAzOTcuMzlhMTQ0LjEzIDE0NC4xMyAwIDAgMS0yNiAyLjYxem0zMTMuODIgNTguMWwtMTEwLjU1LTg1LjQ0YTMzMS4yNSAzMzEuMjUgMCAwIDAgODEuMjUtMTAyLjA3IDMyLjM1IDMyLjM1IDAgMCAwIDAtMjkuMTlDNTUwLjI5IDEzNS41OSA0NDIuOTMgNjQgMzIwIDY0YTMwOC4xNSAzMDguMTUgMCAwIDAtMTQ3LjMyIDM3LjdMNDUuNDYgMy4zN0ExNiAxNiAwIDAgMCAyMyA2LjE4TDMuMzcgMzEuNDVBMTYgMTYgMCAwIDAgNi4xOCA1My45bDU4OC4zNiA0NTQuNzNhMTYgMTYgMCAwIDAgMjIuNDYtMi44MWwxOS42NC0yNS4yN2ExNiAxNiAwIDAgMC0yLjgyLTIyLjQ1em0tMTgzLjcyLTE0MmwtMzkuMy0zMC4zOEE5NC43NSA5NC43NSAwIDAgMCA0MTYgMjU2YTk0Ljc2IDk0Ljc2IDAgMCAwLTEyMS4zMS05Mi4yMUE0Ny42NSA0Ny42NSAwIDAgMSAzMDQgMTkyYTQ2LjY0IDQ2LjY0IDAgMCAxLTEuNTQgMTBsLTczLjYxLTU2Ljg5QTE0Mi4zMSAxNDIuMzEgMCAwIDEgMzIwIDExMmExNDMuOTIgMTQzLjkyIDAgMCAxIDE0NCAxNDRjMCAyMS42My01LjI5IDQxLjc5LTEzLjkgNjAuMTF6Ij48L3BhdGg+PC9zdmc+Cg==" />
              </label>
              <div class="o-form-group__controls">
                <input name="password" class="c-input" id="passwordId" type="password">
              </div>
            </div>
            <?php
              foreach ($this->data['stateparams'] as $name => $value) {
	              echo('<input type="hidden" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '" />');
              }
						?>
            <div class="o-flex o-form-group o-flex--justify-between">
              <button type="submit" name="wp-submit" id="wp-submit" class="c-button c-button--primary">
                <div class="c-button__content">
                  <div class="c-button__label">Inloggen</div>
                </div>
              </button>
              <div class="c-content">
                <button class="c-button c-button--link">
                  <div class="c-button__content">
                    <div class="c-button__label">
                      <a href="https://account.hetarchief.be/users/password/new?redirect_to=<?php echo urlencode($sid['url']); ?>">Wachtwoord vergeten?</a>
                    </div>
                  </div>
                </button>
              </div>
            </div>
          </div>
          <hr class="c-hr">
          <div class="o-flex o-flex--vertical">
            <p class="o-flex__item u-text-center u-text-muted">
              Met dit account kan je aanmelden bij diensten van <a href="https://meemoo.be">meemoo</a> (&copy; 2023).
            </p>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php $this->includeAtTemplateBase('includes/zendesk.php');?>
</body>
</html>
