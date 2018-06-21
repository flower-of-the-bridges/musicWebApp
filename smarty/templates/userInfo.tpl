{profile->getUserInfo assign='pInfo'}
{profile->getImage assign='pImage'}
<div class="well">				
	<p id="important">{$pName}</p>
	<img src="data:{$pImage->getType()};base64,{$pImage->getImg(true)}" class="img-circle" alt="Avatar" width="165" height="150">
</div>

<div class="well">
{if $pType eq 'musician'}
	<p id="important">Genre</p>
	<p>	<span class="label label-primary">{if $pInfo->getGenre()}{$pInfo->getGenre()}{else}Undefined{/if}</span> </p>
{else}
	<p id="important"> First Name: </p> <span>{if $pInfo->getFirstName()} {$pInfo->getFirstName()}{/if}</span>
	<p id="important"> Last Name: </p> <span> {if $pInfo->getLastName()} {$pInfo->getLastName()}{/if} </span>
{/if}
</div>

<div class="well">
	<p id="important">Info</p>
	<p>{if $pInfo->getBio()}{$pInfo->getBio()}{/if}</p>
</div>
{if $uName == $pName}
<div class="well">
	<p> <a href="/deepmusic/userInfo/editInfo">Modifica profilo </a> </p>
</div>
{/if}
