<div class="well">
	{if $uName != $pName}
	<h4>{if $pType eq 'musician'}Do you like my music?{else}Do you like what am i listening?{/if}</h4>
	<br></br>
	<button type="button" class="btn btn-primary">Follow</button>
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

