<div class="container text-center">
		<br></br>
		<div class="row">
			<div class="col-sm-3 well">
				<div class="well" >
					<p id="important">
						{profile->getName}
					</p>
					<img
						src="https://vignette.wikia.nocookie.net/strangerthings8338/images/7/78/Image.jpg/revision/latest/scale-to-width-down/310?cb=20171113113237"
						class="img-circle" alt="Avatar" width="165" height="150">
				</div>
				{if $pType=='musician'}
				<div class="well">
					<p id="important">
						Genre 
					</p>
					<p>
						<span class="label label-primary">Rock n Roll</span>
					</p>
				</div>
				{/if}
				<div class="well">
					<p id="important">
						Info
					</p>
					<p>Sono un musicista, suono e produco canzoni perche mi piace</p>
				</div>
				<button type="button" class="btn btn-primary">Follower
					</button>
				<button type="button" class="btn btn-primary">Following
					</button>
				<br></br> 
				{if $uName == $pName}
				<p>
					<a href="#">Modifica profilo </a>
				</p>
				{/if}
			</div>
			<div class="container text-center">

				<div class="col-sm-7 well">

					<h4 id="important">Songs List</h4>
					<table class="table table-responsive">
						<tbody>
							{foreach $songs as $song}
							<tr>
								<td><a href="download.php?id={$song->getId()}">{$song->getName()}</a></td>
								<td>{$song->getGenre()}</td> 
								{if $pName==$uName}
								<td><a href="#"><span
										class="glyphicon glyphicon-pencil"></span> Edit Song </a></td> 
							    {/if}
							</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
				<div class="col-sm-2 well">

					<div class="container-fluid">
						<h4>Do you like my music?</h4>
						<br></br>
						<button type="button" class="btn btn-primary">Follow</button>
						<br></br>
						<button type="button" class="btn btn-primary">Support</button>
					</div>
					<br></br> 
					{if $uName == $pName && $uType == "musician"}
					<p>
						<a href="#">Gestione supporti </a>
					</p>
					{/if}
				</div>
			</div>

		</div>
	</div>
