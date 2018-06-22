{if $array}
<!-- Table che mostra le canzoni -->
<table class="table table-responsive">
	<tbody>					
	{foreach $array as $song}

		<tr>
			{if !$song->isHidden()} 
			<!-- Nome canzone -->
			<td><a href="/deepmusic/song/show/{$song->getId()}">{$song->getName()}</a></td>
			{if isset($key)}
			<!-- Artista canzone (se la table e' richiamata nella ricerca )-->
			<td><a href="/deepmusic/user/profile/{$song->getArtist()->getId()}">{$song->getArtist()->getNickname()}</a></td>
			{/if} 
			<!-- Genere della canzone -->
			<td>{$song->getGenre()}</td> 
			{elseif $song->getArtist()->getId()==$uId}
			<td><a href="/deepmusic/song/show/{$song->getId()}">{$song->getName()}</a></td>
			<td>{$song->getGenre()}</td> 
			{/if}
		</tr>
	{/foreach}
	</tbody>
</table>
{else}
<p>No song has been found!</p>
{/if}
		
