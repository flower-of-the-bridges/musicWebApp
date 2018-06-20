<div class="well">
	<a href="/deepmusic/user/profile/{$pId}&followers" class="btn btn-primary active" role="button">Follower</a>
	<a href="/deepmusic/user/profile/{$pId}&following" class="btn btn-primary active" role="button">Following</a>
	{if $pType eq 'musician'}
	<a href="/deepmusic/user/profile/{$pId}&supporters" class="btn btn-primary active" role="button">Supporters</a>
	{/if}
	<a href="/deepmusic/user/profile/{$pId}&supporting" class="btn btn-primary active" role="button">Supporting</a>
	<br></br>
</div>
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
	{if $isSupporting}
	<a href="/deepmusic/supporter/unsupport/{$pId}" class="btn btn-danger active" role="button">UnSupport</a>
	{else}
	<a href="/deepmusic/supporter/support/{$pId}" class="btn btn-primary active" role="button">Support</a>
	{/if}
	<br></br>
	{/if}
	{else}
		{if $uType eq 'musician'}
	<p>	<a href="/deepmusic/supInfo/edit">Manage Support Info </a>	</p>
		{/if}
	{/if}
	 
</div>

