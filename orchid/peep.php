<!DOCTYPE html>
<html lang="en">
    <head>
        		<title>腎藥蘭花管理系統</title>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Slicebox - 3D Image Slider with Fallback" />
        <meta name="keywords" content="jquery, css3, 3d, webkit, fallback, slider, css3, 3d transforms, slices, rotate, box, automatic" />
		<meta name="author" content="Pedro Botelho for Codrops" />
  		<!-- 最新編譯和最佳化的 CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
 	 	 <!-- 選擇性佈景主題 -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <!-- 最新編譯和最佳化的 JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

		<link rel="stylesheet" type="text/css" href="css/menu.css"><!--菜單CSS-->
		<link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/slicebox.css" />
		<link rel="stylesheet" type="text/css" href="css/custom.css" />
		<script type="text/javascript" src="js/modernizr.custom.46884.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-default" role="navigation">
		<div class="col-xs-12 container">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header"><!--col-xs-12會跑版-->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Orchid</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="col-xs-12 collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
        	<li><a href="#">Action</a></li>
        	<li><a href="#">Another action</a></li>
        	<li><a href="#">Something else here</a></li>
        	<li class="divider"></li><li class="dropdown-header">Nav header</li>
        	<li><a href="#">Separated link</a></li><li><a href="#">One more separated link</a></li></ul></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
			</div>
			<h1>Agricultural Production Management System <span>Welcome to Crop Management</span></h1>
			
			<div class="col-xs-12 more">

			</div>

			<div class="col-xs-12 wrapper">

				<ul id="sb-slider" class="sb-slider">
					<li>
						<a href="" target="_blank"><img src="img/images/1.jpg" alt="image1"/></a>
						<div class="sb-description">
							<h3>Creative Lifesaver</h3>
						</div>
					</li>
					<li>
						<a href="" target="_blank"><img src="img/images/2.jpg" alt="image2"/></a>
						<div class="sb-description">
							<h3>Honest Entertainer</h3>
						</div>
					</li>
					<li>
						<a href="" target="_blank"><img src="img/images/3.jpg" alt="image1"/></a>
						<div class="sb-description">
							<h3>Brave Astronaut</h3>
						</div>
					</li>
					<li>
						<a href="" target="_blank"><img src="img/images/4.jpg" alt="image1"/></a>
						<div class="sb-description">
							<h3>Affectionate Decision Maker</h3>
						</div>
					</li>
					<li>
						<a href="" target="_blank"><img src="img/images/5.jpg" alt="image1"/></a>
						<div class="sb-description">
							<h3>Faithful Investor</h3>
						</div>
					</li>
					<li>
						<a href="" target="_blank"><img src="img/images/6.jpg" alt="image1"/></a>
						<div class="sb-description">
							<h3>Groundbreaking Artist</h3>
						</div>
					</li>
					<li>
						<a href="" target="_blank"><img src="img/images/7.jpg" alt="image1"/></a>
						<div class="sb-description">
							<h3>Selfless Philantropist</h3>
						</div>
					</li>
				</ul>

				<div id="col-xs-12 shadow" class="shadow"></div>
				<div id="col-xs-12 nav-arrows" class="nav-arrows" style="display: block;">
					<a href="#">Next</a>
					<a href="#">Previous</a>
				</div>

			</div><!-- /wrapper -->
			
			<p align="center" background="images/album_r2_c1.jpg" class="trademark">© 2016 農業物聯生產管理系統 ©</p>

		</div>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.slicebox.js"></script>
		<script type="text/javascript">
			$(function() {
				
				var Page = (function() {

					var $navArrows = $( '#nav-arrows' ).hide(),
						$shadow = $( '#shadow' ).hide(),
						slicebox = $( '#sb-slider' ).slicebox( {
							onReady : function() {

								$navArrows.show();
								$shadow.show();

							},
							orientation : 'r',
							cuboidsRandom : true,
							disperseFactor : 30
						} ),
						
						init = function() {

							initEvents();
							
						},
						initEvents = function() {

							// add navigation events
							$navArrows.children( ':first' ).on( 'click', function() {

								slicebox.next();
								return false;

							} );

							$navArrows.children( ':last' ).on( 'click', function() {
								
								slicebox.previous();
								return false;

							} );

						};

						return { init : init };

				})();

				Page.init();

			});
		</script>
	</body>
</html>	