<nav class="navbar navbar-inverse-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#myNavbar">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/deepmusic/">Deep Music</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					{if $uType eq 'guest'}
					<li><a href="/deepmusic/user/login"><span
							class="glyphicon glyphicon-log-in"></span> Log In</a></li>
					<li><a href="/deepmusic/user/signup"><span
							class="glyphicon glyphicon-plus"></span> Sign Up</a></li>
				    {else}
					<li><a href="/deepmusic/user/profile/{$uId}&song"><span
							class="glyphicon glyphicon-user"></span> {$uName}'s Account </a></li>
					{if $uType eq 'musician'}
					<li><a href="/deepmusic/song/load"><span
							class="glyphicon glyphicon-cd"></span> Add Song </a></li> 
					{/if}
					<li><a href="/deepmusic/user/logout"><span
							class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
					{/if} 
					
				</ul>
				<form class="navbar-form navbar-right" role="search" action="search">
					<div class="form-group input-group">
						<input type="text" class="form-control" name="str"  placeholder="Search..">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div>
				</form>
				{if $uType != "guest"}
				<ul class="nav navbar-nav navbar-right">
					<li><a href="search/advanced">Advanced Search</a></li>
				</ul>
				{/if}
			</div>
		</div>
	</nav>
