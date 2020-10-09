<html>
	<head>
		<title>
			Aanmelden bij meemoo
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
										<label for="inputUsername">Gebruikersnaam</label><input type="text" name="username" class="form-control" id="inputUsername" placeholder="Gebruikersnaam" autofocus>
									</div>
									<div class="form-group">
										<label for="inputPassword">Wachtwoord</label><input type="password" name="password" class="form-control" id="inputPassword" placeholder="Wachtwoord">
									</div>
									<?php
									foreach ($this->data['stateparams'] as $name => $value) {
									        echo('<input type="hidden" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '" />');
									}
									?>
									<button type="submit" name="wp-submit" id="wp-submit" class="btn btn--meemoo flt--right my1" style="padding:0rem 1rem;">Login</button>
									<p class="my2 small">
										<span><a href="%%SSUM_URL%%">Wachtwoord vergeten?</a></span>
									</p>
								</form>
							</div>
							<div class="txt--center mb1">
								<span class="small fnt--mid-gray">© 2020 / <a href="http://www.meemoo.be">www.meemoo.be</a></span>
							</div>
						</div>
						<div class="grd-row-col-1-5"></div>
					</div>
				</div>
			</div>
		</div>

	<?php $this->includeAtTemplateBase('includes/footer-embed.php'); ?>
