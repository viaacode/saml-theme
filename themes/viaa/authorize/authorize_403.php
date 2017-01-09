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
    <title>
      Aanmelden bij VIAA - Toegang verboden
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo SimpleSAML_Module::getModuleURL('themeviaa/css/furtive.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo SimpleSAML_Module::getModuleURL('themeviaa/css/app.css') ?>">
  </head>
  <body>
    <div class="container">
      <div class="measure p2">
        <div class="grd">
          <div class="grd-row">
            <div class="grd-row-col-1-5"></div>
            <div class="grd-row-col-3-5 bg--off-white brdr--light-gray">
              <div class="p2 py3 pb1 mb1 txt--center">
                <img src="<?php echo SimpleSAML_Module::getModuleURL('themeviaa/img/Logo_Viaa_RGB_orange_kl.png') ?>" alt="Logo VIAA" style="width:120px">
              </div>
              <div class="alert alert-danger fnt--red mx2 bg--white" role="alert">
                <p>Je hebt met jouw VIAA-account geen toegang tot deze toepassing.</p>
              </div>
              <div class="my2 small txt--center">
                <p>Vragen? Contacteer <a href="mailto:support@viaa.be?subject=Toegang%20met%20VIAA-account">support@viaa.be</a></p>
              </div>
              <div class="txt--center mb1">
                <p><code class="small fnt--mid-gray">© 2017 / <a href="http://www.viaa.be">www.viaa.be</a></code>
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
  </body>
</html>