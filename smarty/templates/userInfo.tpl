{profile->getUserInfo assign='pInfo'}
{profile->getImage assign='pImage'}
<div class="well">				
	<p id="important">{$pName}</p>
	<img src="data:{$pImage->getType()};base64,{$pImage->getImg(true)}" class="img-circle" alt="Avatar" width="165" height="150">
</div>

<div class="well">
	<p id="important">{if pType eq 'listener'}Favourite{/if} Genre</p>
	<p>	<span class="label label-primary">{if $pInfo->getGenre()}{$pInfo->getGenre}{else}Undefined{/if}</span> </p>
</div>

<div class="well">
	<p id="important">Info</p>
	<p>{if $pInfo->getBio()}{$pInfo->getBio}{/if}</p>
</div>
<div class="well">
	<button type="button" class="btn btn-primary">Follower</button>
	<button type="button" class="btn btn-primary">Following</button>
	<br></br> 
	{if $uName == $pName}
	<p> <a href="/deepmusic/userInfo/editInfo">Modifica profilo </a> </p>
	{/if}
</div>
