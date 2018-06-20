{profile->getUserInfo assign='pInfo'}
{profile->getImage assign='pImage'}
<div class="well">				
	<p id="important">{$pName}</p>
	<img src="data:{$pImage->getType()};base64,{$pImage->getImg(true)}" class="img-circle" alt="Avatar" width="165" height="150">
</div>
{if pType eq 'musician'}
<div class="well">
	<p id="important">Genre</p>
	<p>	<span class="label label-primary">{if $pInfo->getGenre()}{$pInfo->getGenre}{else}Undefined{/if}</span> </p>
</div>
{/if}
<div class="well">
	<p id="important">Info</p>
	<p>{if $pInfo->getBio()}{$pInfo->getBio}{/if}</p>
</div>
{if $uName == $pName}
<div class="well">
	<p> <a href="/deepmusic/userInfo/editInfo">Modifica profilo </a> </p>
</div>
{/if}
