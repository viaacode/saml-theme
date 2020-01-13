<html>
	<head>
		<title>
			Aanmelden bij VIAA
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/css/furtive.min.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/css/app.css') ?>">
		<link rel="icon" type="image/png" href="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/img/favicon-32x32.png') ?>" sizes="32x32" />
		<link rel="icon" type="image/png" href="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/img/favicon-16x16.png') ?>" sizes="16x16" />
	</head>
	<body>
		<div class="container">
			<div class="measure p2">
				<div class="grd">
					<div class="grd-row">
						<div class="grd-row-col-1-5"></div>
						<div class="grd-row-col-3-5 bg--off-white brdr--light-gray">
							<div class="p2 py3 pb1 mb1 txt--center">
								<img src="<?php echo SimpleSAML\Module::getModuleURL('themeviaa/img/Logo_Viaa_RGB_orange_kl.png') ?>" alt="Logo VIAA" style="width:120px">
                                                                <p>Je bent uitgelogd</p>
							</div>
						<div class="grd-row-col-1-5"></div>
					</div>
				</div>
			</div>
		</div>
	<?php $this->includeAtTemplateBase('includes/footer-embed.php'); ?>


