<?php

  $formAction = add_query_arg('pawps_ordner', null);
  if (isset($shooting)) {
  	$formAction = add_query_arg('pawps_shooting', $shooting->id, $formAction);
  }
  $formAction = remove_query_arg('pawps_galerieReset', $formAction);

?>

<h1>Onlinegalerie</h1>

<form name="gaestekennwortForm" method="post" action="<?php echo $formAction; ?>">
	Auf dieser Seite erhalten Sie Zugriff auf Ihre Onlinegalerie. Der Zugriff auf Ihre Galerie ist durch ein Gästekennwort geschützt. Dieses Kennwort erfahren Sie bei Ihrem Gastgeber.<br/>
	Bitte geben Sie das Ihnen übergebene Gästekennwort im folgenden Feld ein:
	<input type="text" name="PA_GUESTPASSWORD" size="25" maxlength="25">
	<p class="submit">
		<input type="submit" name="checkGuestPassword" class="button-primary" value="Kennwort pruefen" />
	</p>
</form>