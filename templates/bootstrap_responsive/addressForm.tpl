<form name="adressdatenForm" id="addressdatenForm" class="form-inline" onsubmit="return pawps_orderBasket();" method="POST">
	<div class="row">
		<div class="col-sm-2 text-right">
			<label>Name, Vorname:</label>
		</div>
		<div class="col-sm-8">
			<input class="form-control" type="text" id="lastname" name="lastname" size="20" maxlength="25" required /> <input class="form-control" type="text" id="firstname" name="firstname" size="20" maxlength="25" required />
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-2 text-right">
			<label>Strasse, Nr:</label>
		</div>
		<div class="col-sm-8">
			<input class="form-control" type="text" id="street" name="street" size="30" maxlength="40" required /> <input class="form-control" type="text" id="nr" name="number" size="6" maxlength="4" required />
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-2 text-right">
			<label>Plz, Ort:</label>
		</div>
		<div class="col-sm-8">
			<input class="form-control" type="text" id="zip" name="plz" size="6" maxlength="5" required /> <input class="form-control" type="text" id="city" name="ort" size="30" maxlength="30" required />
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-2 text-right">
			<label>Land:</label>
		</div>
		<div class="col-sm-8">
			<select name="land" class="form-control">
				<option value="DE">Deutschland</option>
			</select>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-2 text-right">
			<label>E-Mail:</label>
		</div>
		<div class="col-sm-8">
			<input class="form-control" type="email" id="email" name="email" size="40" maxlength="50" required />
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-12">
			<input type="checkbox" name="agbBox" required> AGB aktzeptiert<br/>
			<textarea id="agbArea" class="form-control" rows="5" cols="80"><?php echo $agbText; ?></textarea>
		</div>
	</div>

	<input class="submit" type="submit" name="bestellungAbsenden" class="btn btn-default" value="Bestellung aufgeben">
</form>

<script>
	$("#addressdatenForm").validate();
</script>