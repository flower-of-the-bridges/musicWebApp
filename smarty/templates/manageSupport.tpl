
<form method="post" action="supInfo.php">

	<div class="col-sm-4">
		<label for="inputState">Contribute</label> <select name="contribute"
			id="inputState" class="form-control">
			<option value="1 $" {if $cont eq "1 $"}selected{/if}>$1</option>
			<option value="5 $" {if $cont eq "5 $"}selected{/if}>$5</option>
			<option value="10 $"{if $cont eq "10 $"}selected{/if}>$10</option>

		</select>
	</div>
	<div class="col-sm-4">
		<label for="inputState">Period</label> <select name="period"
			id="inputState" class="form-control">
			<option value="7" {if $per eq 7}selected{/if}>weekly</option>
			<option value="30" {if $per eq 30}selected{/if}>monthly</option>
			<option value="365" {if $per eq 365}selected{/if}>annual</option>
		</select>
	</div>
	<div class="col-sm-4">
		<label for="inputState">Confirm Changes</label>
		<button type="submit" id="inputState" class="btn btn-primary">Submit</button>
	</div>


</form>
<br></br>
<br>

<h4 id="important">Supporters</h4>
<table class="table table-responsive">
	<tbody>
	</tbody>
</table>