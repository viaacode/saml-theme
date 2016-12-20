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


?>
<html>
    <head>
        <title>VIAA SSO SERVER</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="<?php echo SimpleSAML_Module::getModuleURL('themeviaa/css/bootstrap.min.css') ?>">
    </head>
</head>
<body class="logon_page">
    <div class="container">
        <img src="http://viaa.be/assets/img/logo.jpg" style="width: 30%; height: 30%;" />

<br>
<h1>Access forbidden</h1>
<br>
You don't have the needed privileges to access this application. Please contact the administrator if you find this to be incorrect.
<br><br>

   </div>
 </body>
</html>
