<div class="well">				
	<p id="important">{profile->getName}</p>
	<img	src="https://vignette.wikia.nocookie.net/strangerthings8338/images/7/78/Image.jpg/revision/latest/scale-to-width-down/310?cb=20171113113237"
					class="img-circle" alt="Avatar" width="165" height="150">
</div>

<div class="well">
	<p id="important">{if pType eq 'Listener'}Favourite{/if} Genre</p>
	<p>	<span class="label label-primary">Genere</span> </p>
</div>

<div class="well">
	<p id="important">Info</p>
	<p>Sono un musicista, suono e produco canzoni perche mi piace</p>
</div>
<div class="well">
	<button type="button" class="btn btn-primary">Follower</button>
	<button type="button" class="btn btn-primary">Following</button>
	<br></br> 
	{if $uName == $pName}
	<p> <a href="#">Modifica profilo </a> </p>
	{/if}
</div>
