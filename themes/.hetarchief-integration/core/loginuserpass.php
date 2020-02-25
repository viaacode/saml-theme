<?php
$env = "integration";
switch ($env) {
  case "integration":
      $prefix= "tst.";
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

$query = isset($_GET["AuthState"]) ? ($_GET["AuthState"]) : NULL;

if (!empty($query)) {
  parse_str(urldecode($query),$params);
  if (!empty($params['RelayState'])) {
    $relay_state = json_decode($params['RelayState']);
    $redirect_to = $relay_state[0];
  }
} else {
  $redirect_to = "https://".$prefix."hetarchief.be";
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
  <meta name="description" content="<?php echo htmlspecialchars($_GET["returnToUrl"]); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
  <link rel="stylesheet" href="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/css/hetarchief.css') ?>">
  <link rel="stylesheet" href="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/css/eye.css') ?>">
  <script src="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/js/app.js') ?>"></script>
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
      <h3 class="c-h2">Inloggen</h3>
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
            <div class="o-form-group">
              <button type="submit" name="wp-submit" id="wp-submit" class="c-button c-button--primary">
                <div class="c-button__content">
                  <div class="c-button__label">Inloggen</div>
                </div>
              </button>
            </div>
          </div>
          <!--
          <hr class="c-hr">
          <div class="c-content">
            <p>Log in met:</p>
          </div>
          <div class="c-btn-toolbar">
            <a class="c-button c-button--secondary" href="#">
              <div class="c-button__content">
                <div class="o-svg-icon o-svg-icon-button-custom-klascement  ">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z"
                      fill="black" />
                    <path d="M7.39473 18.8682L4.6842 8.21035L7.8421 7.42088L8.92105 11.5788L10.4737 6.52614L13.421 6.47353L12.9737 7.89456C14.421 6.86824 16.4561 6.90333 17.5526 7.23667L17.0789 8.97351C15.921 8.89456 13.7684 9.30509 14.421 11.5788C15.0737 13.8525 17.1316 13.1051 18.0789 12.4472L19.1842 13.8946C18.9526 14.5051 17.1053 15.1489 16.2105 15.3946L16.7895 15.9998L13.7632 17.3419L9.21052 12.8946L10.4737 18.0788L7.39473 18.8682Z"
                      fill="black" />
                  </svg>
                </div>
                <div class="c-button__label">KlasCement</div>
              </div>
            </a>
            <a class="c-button c-button--secondary" href="#">
              <div class="c-button__content">
                <div class="o-svg-icon o-svg-icon-button-custom-smartschool  ">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.7091 7.11565C15.7592 6.97066 15.8037 6.87029 15.8371 6.76434C15.9707 6.31267 16.1043 5.85542 16.2323 5.40374C16.4271 4.70671 16.5829 4.83496 15.8093 4.53942C14.4791 4.03756 13.0988 3.89258 11.6795 4.07659C10.4383 4.2383 9.32518 4.65652 8.4124 5.53757C6.85399 7.04315 6.73154 9.78109 8.45136 11.3424C9.26396 12.0785 10.2213 12.5525 11.2342 12.9317C11.9967 13.2216 12.7704 13.4949 13.4049 14.0302C14.2843 14.7718 14.3678 16.1213 13.583 16.9019C13.1433 17.3369 12.5867 17.5376 11.98 17.599C10.5552 17.7551 9.21943 17.4484 7.93931 16.835C7.83356 16.7848 7.73338 16.7347 7.60536 16.6733C7.41056 17.3704 7.24359 18.0395 7.03766 18.6919C6.9486 18.9707 7.03766 19.0823 7.28255 19.1938C8.62946 19.8072 10.0432 20.0302 11.507 19.9968C12.481 19.9745 13.4271 19.8127 14.3177 19.4001C15.9039 18.6696 16.8445 17.4596 16.9837 15.6919C17.1172 13.98 16.466 12.625 15.0078 11.7328C14.262 11.2755 13.4271 10.9688 12.6424 10.5785C12.0079 10.2662 11.3456 9.99299 10.789 9.58034C9.72035 8.78852 9.93185 7.26063 11.1285 6.68627C11.6071 6.45765 12.1192 6.38516 12.6424 6.39073C13.7054 6.39631 14.7184 6.61936 15.7091 7.11565Z"
                      fill="black" />
                  </svg>
                </div>
                <div class="c-button__label">SmartSchool</div>
              </div>
            </a>
          </div>
          -->
          <hr class="c-hr">
          <div class="c-content">
            <p class="u-text-muted">
              <a href="http://account-tst.hetarchief.be/users/password/new?redirect_to=<?php echo $redirect_to; ?>">Wachtwoord vergeten?</a>
            </p>
          </div>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
