<h4 id="important">Songs List</h4>
{if $array}
<table class="table table-responsive">
	<tbody>					
	{foreach $array as $song}
		<tr>
			<td><a href="/deepmusic/song/show/{$song->getId()}">{$song->getName()}</a></td>
			<td>{$song->getGenre()}</td> 
			{if $pName==$uName}
			<td><a href="#"><span
				class="glyphicon glyphicon-pencil"></span> Edit Song </a></td> 
			{/if}
		</tr>
	{/foreach}
	</tbody>
</table>
{else}
<p>No song has been uploaded yet!</p>
{/if}
		
