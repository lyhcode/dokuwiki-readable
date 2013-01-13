<?php
if (!defined('DOKU_INC'))
	die();
@require_once(dirname(__FILE__).'/tpl_functions.php'); /* include hook for template functions */

$title = tpl_pagetitle(null, true);
$description = tpl_getConf('tagline');
if (count($tokens = explode('(', $title)) > 1) {
	$title = $tokens[0];
	$description = str_replace(')', '', $tokens[1]);
}
?>
<!DOCTYPE html>
<html lang="<?php echo $conf['lang'] ?>">
	<head>
		<meta charset="utf-8">
		<title><?php echo $title; ?> - <?php echo strip_tags($conf['title']) ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta name="description" content="<?php echo $description ?>">
		<meta name="author" content="">
		<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<?php tpl_metaheaders() ?>
		<?php echo tpl_favicon(array('favicon', 'mobile')) ?>
	</head>
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="<?php echo wl() ?>"><?php echo strip_tags($conf['title']) ?></a>
					<div class="nav-collapse">
						<ul class="nav">
							<li><a class="brand" href="<?php echo wl() ?>"><?php echo tpl_getLang('home') ?></a></li>
							<li><?php tpl_action('admin', 1) ?></li>
							<li><?php tpl_action('index', 1) ?></li>
							<li><?php tpl_action('profile', 1) ?></li>
							<li><?php tpl_action('login', 1) ?></li>
						</ul>
						<?php amdy_tpl_searchform() ?>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row-fluid">
				<!--div class="span2">
					<div class="well sidebar-nav">
						<ul class="nav nav-list">
							<li class="nav-header">Page</li>
							<li><a href="">Href 1</a></li>
							<li><a href="">Href 2</a></li>
						</ul>
					</div>
				</div-->
			<header class="jumbotron subhead" id="overview">
				<h1><?php echo $title ?></h1>
				<p><?php echo $description ?></p>
				<div class="subnav">
					<ul class="nav nav-pills">
						<li><a class="toggle-toc" href="#content"><?php echo tpl_getLang('toc') ?></a></li>
						<li><?php tpl_action('backlink', 1) ?></li>
						<li><?php tpl_action('edit', 1) ?></li>
						<li><?php tpl_action('recent', 1) ?></li>
						<li><?php tpl_action('history', 1) ?></li>
						<li><?php tpl_action('revert', 1) ?></li>
					</ul>
				</div>
			</header>
					<?php html_msgarea() ?>
					<div class="row-fluid">
						<div class="span10">
							<?php html_msgarea() ?>
						</div>
					</div>
					<?php if ($conf['breadcrumbs']) { ?>
						<?php amdy_tpl_breadcrumbs() ?>
					<?php } ?>
					<?php if ($conf['youarehere']) { ?>
						<div class="row-fluid">
							<div class="span10">
								<?php tpl_youarehere() ?>
							</div>
						</div>
					<?php } ?>
					<section id="content">
						<!-- wikipage start -->
						<?php tpl_content() ?>
						<!-- wikipage stop -->
					</section>
					
					<hr class="soften" />
					
					<div class="alert alert-info">
						<button class="close" data-dismiss="alert">×</button>
						<strong>Page Info</strong>
						<?php tpl_pageinfo() ?>
					</div>
			</div>
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container">
							<ul class="nav">
								<li><?php tpl_action('edit', 1) ?></li>
								<li><?php tpl_action('history', 1) ?></li>
								<li><?php tpl_action('revert', 1) ?></li>
								<li><?php tpl_action('media', 1) ?></li>
								<li><?php tpl_action('subscribe', 1) ?></li>
							</ul>
							<ul class="nav pull-right">
								<li><?php tpl_action('top', 1) ?></li>
							</ul>
					</div>
					<p><?php tpl_license(false); ?></p>
				</div><!-- /navbar-inner -->
			</div>
		</div>
		<div class="no"><?php /* provide DokuWiki housekeeping, required in all templates */ tpl_indexerWebBug() ?></div>
		<!--jQuery from Google CDN-->
		<script type="text/javascript" charset="utf-8" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
		<!--bootstrap scripts-->
		<script type="text/javascript" charset="utf-8" src="<?php echo DOKU_TPL?>bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$(function() {
				$('a.toggle-toc').toggle(function() {
					$('div#dw__toc').show();
				}, function() {
					$('div#dw__toc').hide();
				});

				$('input.button').addClass('btn');
			});
		</script>
	</body>
</html>
