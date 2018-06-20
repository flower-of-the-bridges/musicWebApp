{if $array}
<table class="table table-responsive">
	<tbody>					
	{foreach $array as $user}
		<tr>
			<td><a href="/deepmusic/user/profile/{$user->getId()}">{$user->getNickName()}</a></td>
			<td>{substr(get_class($user),1)}</td>
		</tr>
	{/foreach}
	</tbody>
</table>
{else}
<p>There is no user in this list!</p>
{/if}