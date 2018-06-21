{if $array}
<table class="table table-responsive">
	<tbody>					
	{foreach $array as $user}
		<tr>
			<td><a href="/deepmusic/user/profile/{$user->getId()}">{$user->getNickName()}</a></td>
			{if isset($value)}
			{if $value eq 'Genre'}
			<td>{$user->getUserInfo()->getGenre()}</td>
			{/if}
			{/if}
			<td>{substr(get_class($user),1)}</td>
		</tr>
	{/foreach}
	</tbody>
</table>
{else}
<p>There is no user in this list!</p>
{/if}