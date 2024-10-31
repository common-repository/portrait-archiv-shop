<div class="container">
	<div class="row">
		<div class="col-sm-9">
			<h1>Ihr aktueller Warenkorb</h1>
		</div>
	</div>

	<div class="row">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>Artikel</th>
						<th>Anzahl</th>
						<th>Einzelpreis</th>
						<th>Gesamtpreis</th>
						<?php if (!isset($displayOnly) || !$displayOnly) { ?>
							<th>&nbsp;</th>
						<?php } ?>
					</tr>
				</thead>
				<tbody id="productList">
				</tbody>
				<tr>
					<td colspan="4" align="right"><b>Zwischensumme:</b></td>				
					<td class='text-right'><span id="zwischensumme"></span></td>
					<?php if (!isset($displayOnly) || !$displayOnly) { ?>
						<td>&nbsp;</td>
					<?php } ?>						
				</tr>
				<tr>
					<td colspan="4" align="right"><b>zzgl. Versand:</b></td>				
					<td class='text-right'><span id="versandkosten"></span></td>
					<?php if (!isset($displayOnly) || !$displayOnly) { ?>
						<td>&nbsp;</td>
					<?php } ?>						
				</tr>
				<tr>
					<td colspan="4" align="right"><b>Gesamtpreis:</b></td>				
					<td class='text-right'><span id="gesamtpreis"></span></td>
					<?php if (!isset($displayOnly) || !$displayOnly) { ?>
						<td>&nbsp;</td>
					<?php } ?>						
				</tr>
				</tbody>
			</table>
	</div>
	
	<div id="orderArea">
		<div class="row">
			<div class="col-sm-9">
				<h1>Warenkorb bestellen</h1>
			</div>
		</div>
		
		<div class="row">
			Bitte geben Sie Ihre Versandadresse ein:
			<?php
		 		include 'addressForm.tpl';
		 	?>
		</div>
	</div>
 </div>
 
 	<?php
 		include plugin_dir_path( __FILE__ ) . '../../js/warenkorbList.php';
 	?>
 