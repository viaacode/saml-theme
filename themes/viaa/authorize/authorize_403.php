<?php

// original file:  /var/www/simplesaml/modules/authorize/www/authorize_403.php

header('HTTP/1.0 403 Forbidden');

if (!array_key_exists('StateId', $_REQUEST)) {
        throw new SimpleSAML\Error\BadRequest('Missing required StateId query parameter.');
}

$id = $_REQUEST['StateId'];

// sanitize the input
$sid = SimpleSAML\Utilities::parseStateID($id);
if (!is_null($sid['url'])) {
        SimpleSAML\Utilities::checkURLAllowed($sid['url']);
}

?>

<html>
  <head>
    <title>
      Aanmelden bij meemoo - Toegang verboden
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/css/furtive.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/css/app-ab44afa1-f3b3-4249-b294-1bb638329f5a.css') ?>">
    <link rel="icon" type="image/png" href="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/img/meemoo_favicon-306d29737c36438ecc5387780be080cc0516d0e71774edb3a47a62ef5a7a00cd.png') ?>" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/img/meemoo_favicon-306d29737c36438ecc5387780be080cc0516d0e71774edb3a47a62ef5a7a00cd.png') ?>" sizes="16x16" />
  </head>
  <body>
    <div class="container">
      <div class="measure p2">
        <div class="grd">
          <div class="grd-row">
            <div class="grd-row-col-1-5"></div>
            <div class="grd-row-col-3-5 bg--off-white brdr--light-gray">
              <div class="p2 py3 pb1 mb1 txt--center">
                <img src="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/img/30c6269d-8c77-4be1-987b-260620de88b0.png') ?>" alt="Logo meemoo" style="width:75%">
              </div>
	      <div class="alert alert-danger fnt--red mx2 bg--white" role="alert">
                 <?php
                 if (isset($this->data['reject_msg'])) {
                   echo $this->data['reject_msg']['nl'];
                 } else {
                   echo 'Toegang geweigerd';
		 }?>
	      </div>
              <div class="my2 small txt--center">
                <p>Vragen? Contacteer <a href="mailto:support@viaa.be?subject=Toegang%20met%20VIAA-account">support@meemoo.be</a></p>
              </div>
              <div class="txt--center mb1">
                <span class="small fnt--mid-gray">© 2020 / <a href="http://www.viaa.be">www.meemoo.be</a></span>
              </div>
            </div>
            <div class="grd-row-col-1-5"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Start of viaa Zendesk Widget script -->
    <script>/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(c){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var o=this.createElement("script");n&&(this.domain=n),o.id="js-iframe-async",o.src=e,this.t=+new Date,this.zendeskHost=t,this.zEQueue=a,this.body.appendChild(o)},o.write('<body onload="document._l();">'),o.close()}("https://assets.zendesk.com/embeddable_framework/main.js","viaa.zendesk.com");/*]]>*/</script>
    <script>
    zE(function() {
    zE.setLocale('nl');
    });
    </script>
    <!-- End of viaa Zendesk Widget script -->
    <script>
      let xhr = new XMLHttpRequest();
      xhr.open('GET', "<?php echo $this->data['logoutURL']?>");
      xhr.send();
    </script>
  </body>
</html>
