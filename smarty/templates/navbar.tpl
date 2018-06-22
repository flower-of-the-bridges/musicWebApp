<nav class="navbar navbar-inverse-dark">
	<div class="container-fluid">
		<div class="navbar-header">
			<!-- Button per dispositivi mobili per aprire / collassare il menu -->
			<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#myNavbar">
			<span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/deepmusic/">Deep Music</a>
			</div>
			<!-- Opzioni della Navbar -->
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					{if $uType eq 'guest'}
					<!-- Login (se guest) -->
					<li><a href="/deepmusic/user/login"><span
							class="glyphicon glyphicon-log-in"></span> Log In</a></li>
					<!-- SignUp (se guest) -->
					<li><a href="/deepmusic/user/signup"><span
							class="glyphicon glyphicon-plus"></span> Sign Up</a></li>
				    {else}
				    <!-- Profilo (se loggato) -->
					<li><a href="/deepmusic/user/profile/{$uId}"><span
							class="glyphicon glyphicon-user"></span> {$uName}'s Account </a></li>
					{if $uType eq 'musician'}
					<!-- Carica canzone (se musicista) -->
					<li><a href="/deepmusic/song/load"><span
							class="glyphicon glyphicon-cd"></span> Add Song </a></li> 
					{/if}
					{if $uType eq 'moderator'}
					<!-- Link all'hub dei report (se moderatore) -->
					<li><a href="/deepmusic/manageReport/show"><span
							class="glyphicon glyphicon-warning-sign"></span> Report Hub </a></li> 
					{/if}
					<!-- Logout (se logged) -->
					<li><a href="/deepmusic/user/logout"><span
							class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
					{/if} 
					
				</ul>
				<!-- Form per la barra di ricerca -->
				<form class="navbar-form navbar-right" role="search" action="/deepmusic/search/simple">
					<div class="form-group input-group">
						<input type="text" class="form-control" name="str"  placeholder="Search Song's Genre...">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div>
				</form>
				{if $uType != "guest"}
				<!-- Button per la ricerca avanzata (se loggato) -->
				<ul class="nav navbar-nav navbar-right">
					<li><a href="/deepmusic/search/advanced">Advanced Search</a></li>
				</ul>
				{/if}
			</div>
		</div>
	</div>
</nav>
