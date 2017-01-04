<nav class="navbar navbar-default navbar-static-top" style="margin: 0px 0px 0px 0px;">
    <div class="container">
        <div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo ADRES_STRONY; ?>"><img src="<?php echo ADRES_STRONY; ?>/gr/logo30.png"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse" style="float:right; padding:0px 15px 0px 0px;">
			<ul class="nav navbar-nav">
				<li><p class="navbar-text"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $_SESSION['login']['nazwa'];?></p></li>
                <li onMouseOver="this.className='active'" onMouseOut="this.className=''"><a href="<?php echo ADRES_STRONY; ?>/wyloguj"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Wyloguj</a></li>
			</ul>
        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</nav><!-- /.navbar -->