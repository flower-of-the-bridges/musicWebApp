<div class="well">
	{if $uName != $pName}
	<h4>{if $pType eq 'musician'}Do you like my music?{else}Do you like what am i listening?{/if}</h4>
	<br></br>
	{if $isFollowing}
	<a href="/deepmusic/follower/unfollow/{$pId}" class="btn btn-danger active" role="button">UnFollow</a>
	{else}
	<a href="/deepmusic/follower/follow/{$pId}" class="btn btn-primary active" role="button">Follow</a>
	{/if}
	<br></br>
	{if $pType eq 'musician'}
	<button type="button" class="btn btn-primary">Support</button>
	<br></br>
	{/if}
	{else}
		{if $uType eq 'musician'}
	<p>	<a href="#">Gestione supporti </a>	</p>
		{/if}
	{/if}
</div>

