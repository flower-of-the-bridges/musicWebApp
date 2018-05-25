<div class="well">
	{if $uName != $pName}
	<h4>Do you like my music?</h4>
	<br></br>
	<button type="button" class="btn btn-primary">Follow</button>
	<br></br>
	<button type="button" class="btn btn-primary">Support</button>
	<br></br>
	{else}
		{if $uType == "musician"}
	<p>	<a href="#">Gestione supporti </a>	</p>
		{/if}
	{/if}
</div>

