

					<h4 id="important">Songs List</h4>
					<table class="table table-responsive">
						<tbody>
							{foreach $songs as $song}
							<tr>
								<td><a href="song.php?id={$song->getId()}">{$song->getName()}</a></td>
								<td>{$song->getGenre()}</td> 
								{if $pName==$uName}
								<td><a href="#"><span
										class="glyphicon glyphicon-pencil"></span> Edit Song </a></td> 
							    {/if}
							</tr>
							{/foreach}
						</tbody>
					</table>
		
