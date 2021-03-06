<?php 
function echo_game($game, $i = 1)
{
	$was_released = isset($game->original_release_date);
	echo '<tr>';
	echo '<td>' . $i . '</td>';
	echo '<td class="image-cell">';
	if ($game->image === FALSE)
		echo '<i class="icon-certificate icon-2x"></i>';
	else
		echo '<img class="thumb" src="' . $game->image . '" alt="' . $game->name . '">';
	echo '</td>';	
	echo '<td><div class="game-info">';
	if ($was_released)
	{
		$date = new DateTime($game->original_release_date);
		echo '<div class="pull-forward pull-right score"><strong>' . $game->score . '</strong></div>';
	}
	echo '<p><strong>' . $game->name . '</strong>';
	if ($was_released)
	{
		echo ' - <em>' . $date->format('M Y') .'</em></p>';
	}
	echo '<p class="game-deck">' . $game->deck . '<br /><a href="' . $game->site_detail_url . '">Full Wiki</a></p>';
	if ($was_released)
	{
		echo '<div class="input-append">';
		echo form_open('add');
		echo '<input class="span1" name="score" type="text">';
		echo '<input type="hidden" name="id" value="' . $game->id . '">';
		echo '<button class="btn btn-inverse" type="submit"><i class="icon-plus"></i> Add Score</button>';
		echo form_close();
		echo '</div></td>';
	}
	else
		echo '<strong>Game never released!</strong>';
	
	echo '</tr>';
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Start To Crate</title>
		<meta name="description" content="">
		<!-- <meta name="viewport" content="width=device-width"> -->
		<link href='http://fonts.googleapis.com/css?family=Quicksand:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<style>
			body {
				/*padding-top: 60px;*/
				padding-bottom: 40px;
			}
		</style>
		<!-- <link rel="stylesheet" href="css/bootstrap-responsive.min.css"> -->
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
		<link rel="stylesheet" href="css/main.css">

		<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
	</head>
	<body>
		<!--[if lt IE 7]>
			<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
		<![endif]-->

		<!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->
		<div id="top-box"></div>
		<div class="row row-header">
			<div class="container">
				<div id="header">
					<!-- <img src="img/training-center.png" alt="Training Center Logo"> -->
					<h1><a href="/starttocrate">Start To Crate</a></h1>
					<h3>Games. Crates. Explosions.</h3>
					<div class="icons">
						<i class="icon-play icon-4x"></i><i class="icon-exchange icon-2x"></i><i class="icon-truck icon-4x"></i><i class="icon-exchange icon-2x"></i><i class="icon-fire icon-4x"></i>
					</div>
				</div>
			</div>
		</div>

		<div class="navbar">
			<div class="navbar-inner">
				<div class="container">
					
					<span id="nav-social">
						<a href="/starttocrate"><i class="icon-home icon-4x"></i></a><i class="icon-twitter-sign icon-4x"></i>
					</span>
					<ul class="nav pull-right">
						from spawn till crate
					</ul>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="span6">
					<div class="input-append">
						<?php echo form_open('search'); ?>
						<input class="span4" id="query" name="search" type="text" placeholder="Search for games" <?php if (isset($search)) 
						echo 'value="' . $search . '"'; ?> >
						<button class="btn btn-inverse" type="submit"><i class="icon-search"></i></button>
						<?php echo form_close(); ?>
					</div>
				</div>
				<div class="span6">
					<div class="pull-right">
						<a href="#" class="btn btn-inverse"><i class="icon-plus"></i> Add Score</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<?php if ($games !== FALSE): ?>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Box Art</th>
									<th>Game</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (is_array($games))
								{
									$i = 1;
									foreach ($games as $game)
									{
										echo_game($game, $i);
										$i++;
									}
									unset($game);	
								}
								else
									echo_game($games);
								?>
							</tbody>
						</table>
					<?php else:
						echo '<h4>No games found!</h4>';
					endif; ?>	
				</div>
			</div>
		</div>
		
		

		<div class="row">
			<div class="container" id="calendar">
				<div class="span12">
					<h2>coming 2nd week of may</h2>
					<div class="text-center">
						origin: <a href="http://www.oldmanmurray.com/features/39.html">Old Man Murray</a>
					</div>
				</div>
			</div>
		</div>

		<!--<div class="row">
			<div class="container" id="calendar">
				<div class="offset1 span2">
					<h2 class="muted">mon</h2>
					<i class="icon-adjust icon-3x"></i>
				</div>
				<div class="span2">
					<h2 class="muted">tues</h2>
					<i class="icon-music icon-3x"></i>
				</div>
				<div class="span2">
					<h2 class="muted">wed</h2>
					<i class="icon-magic icon-3x"></i>
				</div>
				<div class="span2">
					<h2 class="muted">thurs</h2>
					<i class="icon-film icon-3x"></i>
				</div>
				<div class="span2">
					<h2 class="muted">fri</h2>
					<i class="icon-camera icon-3x"></i>
				</div>
			</div>
		</div> -->

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>

		<script src="js/vendor/bootstrap.min.js"></script>

		<script src="js/main.js"></script>

		<script>
			var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)}(document,'script'));
		</script>
	</body>
</html>
