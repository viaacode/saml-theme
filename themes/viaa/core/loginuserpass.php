<html>
	<head>
		<title>
			Aanmelden bij VIAA
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?php echo SimpleSAML_Module::getModuleURL('themeviaa/css/furtive.min.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo SimpleSAML_Module::getModuleURL('themeviaa/css/app.css') ?>">
	</head>
	<body>
	<?php $this->includeAtTemplateBase('includes/GA-tracker.php'); ?>
		<div class="container">
			<div class="measure p2">
				<div class="grd">
					<div class="grd-row">
						<div class="grd-row-col-1-5"></div>
						<div class="grd-row-col-3-5 bg--off-white brdr--light-gray">
							<div class="p2 py3 pb1 mb1 txt--center">
								<img src="<?php echo SimpleSAML_Module::getModuleURL('themeviaa/img/Logo_Viaa_RGB_orange_kl.png') ?>" alt="Logo VIAA" style="width:120px">
							</div>
<?php
if ($this->data['errorcode'] !== NULL) {
?>
							<div class="alert alert-danger fnt--red mx2 bg--white" role="alert">
								<!--<h4 class="bold">
									<?php echo $this->t('{login:error_header}'); ?>
								</h4>-->
								<p>
									<?php echo $this->t('{errors:title_' . $this->data['errorcode'] . '}'); ?>
								</p>
								<!--<p class="italic">
									<?php echo $this->t('{errors:descr_' . $this->data['errorcode'] . '}'); ?>
								</p>-->
							</div>
<?php
} ?>
							<div class="p1 px2">
								<form name="loginform" id="loginform" action="?" method="post">
									<div class="form-group">
										<label for="inputUsername">Gebruikersnaam</label><input type="text" name="username" class="form-control" id="inputUsername" placeholder="Gebruikersnaam">
									</div>
									<div class="form-group">
										<label for="inputPassword">Wachtwoord</label><input type="password" name="password" class="form-control" id="inputPassword" placeholder="Wachtwoord">
									</div>
									<?php
									foreach ($this->data['stateparams'] as $name => $value) {
									        echo('<input type="hidden" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '" />');
									}
									?>
									<button type="submit" name="wp-submit" id="wp-submit" class="btn btn--blue flt--right my1" style="padding:0rem 1rem;">Login</button>
									<p class="my2 small">
										<code><a href="https://accounts.viaa.be/pwm/public/ForgottenPassword">Wachtwoord vergeten?</a></code>
									</p>
								</form>
							</div>
							<div class="txt--center mb1">
								<code class="small fnt--mid-gray">© 2016 / <a href="http://www.viaa.be">www.viaa.be</a></code>
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

