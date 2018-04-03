<?php
	// var_dump($gebruiker);
	// var_dump($adressen);
	
	$selectAdressen = '<option value="default" selected disabled>Kies een adres of voeg er een toe</option><option id="nieuwAdres" value="nieuwAdres">Nieuw adres</option>';
	foreach($adressen as $adres){
		$selectAdressen .= '<option value="' . $adres->id . '">' . $adres->straat . ' ' . $adres->huisnummer . ' (' . $adres->gemeente . ')</option>';
	}

?>

<style>
	.pac-container{
		z-index: 10000;
	}

</style>

<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-sm-6">
				<p><i class="fas fa-shopping-cart"></i> klant: <?php print $gebruiker->voornaam . " " . $gebruiker->naam; ?></p>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="heenTerug">
					<label class="custom-control-label" for="heenTerug">Heen en terug</label>
				</div>
			</div>
			<div class="col-sm-6">
				<button type="button" class="btn btn-primary"><i class="fas fa-save"></i> Opslaan</button>
				<?php print anchor(array('MM/ritten'), '<i class="fas fa-ban"></i> Anuleren', array('class' => 'btn btn-danger'));?>
			</div>
		</div>
	</div>
</div>
<article class="mt-2" id="heen">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-sm-6">
					<h5>Heen rit</h5>
				</div>
				<div class="col-sm-6 text-right">
					
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col">
					<label for="heenDatum">Datum: </label>
					<div class="input-group">
						<div class="input-group-prepend">
							<label class="input-group-text" for='heenDatum'>
								<i class="fas fa-calendar-alt"></i>
							</label>
						</div>
						<input data-provide="datepicker" id="heenDatum" class="form-control">
					</div>
				</div>
				<div class="col">
					<label for="startTijdHeen">Start tijd: </label>
					<input type="time" id="startTijdHeen" width="276" class="form-control" id="time"/>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<label for="heenStartAdres">Start adres: </label>
					<select class="custom-select" id="heenStartAdres">
						<?php
							print $selectAdressen;
						?>
					</select>
				</div>
				<div class="col">
					<label for="heenEindeAdres">Bestemming adres: </label>
					<select class="custom-select" id="heenEindeAdres">
						<?php
							print $selectAdressen;
						?>
					</select>
				</div>
			</div>
		</div>
	</div>
</article>
<article class="mt-2" id="terug" style="display: none;">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-sm-6">
					<h5>Terug rit</h5>
				</div>
				<div class="col-sm-6 text-right">
					
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col">
					<label for="terugDatum">Datum: </label>
					<div class="input-group">
						<div class="input-group-prepend">
							<label class="input-group-text" for='terugDatum'>
								<i class="fas fa-calendar-alt"></i>
							</label>
						</div>
						<input data-provide="datepicker" id="terugDatum" class="form-control" placeholder="" disabled>
					</div>
				</div>
				<div class="col">
					<label for="startTijdTerug">Start tijd: </label>
					<input type="time" id="startTijdTerug" width="276" class="form-control" id="time"/>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<label for="terugStartAdres">Start adres: </label>
					<select class="custom-select" id="terugStartAdres">
						<?php
							print $selectAdressen;
						?>
					</select>
				</div>
				<div class="col">
					<label for="terugEindeAdres">Bestemming adres: </label>
					<select class="custom-select" id="terugEindeAdres">
						<?php
							print $selectAdressen;
						?>
					</select>
				</div>
			</div>
		</div>
	</div>
</article>
<div class="row mt-2">
	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<h5>Opmerking</h5>
				<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<h5>Verwachte kost</h5>
				<p>10km * 5€ = 50€</p>
				<p>
					Aantal ritten over		
				</p>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-id="">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="adres" novalidate>
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Nieuw adres</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger" role="alert" id="errorModal" style="display: none;"></div>
					<div id="locationField">
						<div class="form-group">
							<input type="text" class="form-control" id="autocomplete" placeholder="Vul hier het adres in" onFocus="geolocate()">
						</div>
					</div>
					<div id="address">
						<div class="form-group">
							<label for="street_number">Nummer</label>
							<input type="text" class="form-control" id="street_number" disabled="true">
						</div>
						<div class="form-group">
							<label for="route">Straat</label>
							<input type="text" class="form-control" id="route" disabled="true">
						</div>
						<div class="form-group">
							<label for="locality">Gemeente</label>
							<input type="text" class="form-control" id="locality" disabled="true">
						</div>
						<div class="form-group">
							<label for="postal_code">Postcode</label>
							<input type="text" class="form-control" id="postal_code" disabled="true">
						</div>
						<div class="form-group">
							<label for="administrative_area_level_1">Staat</label>
							<input type="text" class="form-control" id="administrative_area_level_1" disabled="true">
						</div>
						<div class="form-group">
							<label for="country">Land</label>
							<input type="text" class="form-control" id="country" disabled="true">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="anuleerAdres">Anuleren</button>
					<button type="button" class="btn btn-primary" id="saveAdres">Opslaan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Replace the value of the key parameter with your own API key. -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3Fe2FqE9k7EP-u0Q1j5vUoVhtfbWfSjU&libraries=places&callback=initAutocomplete" async defer></script>
	


<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
})

$('.form-control').datepicker({
    format: 'dd/mm/yyyy',
	weekStart: 1,
	language: 'nl'
});

$('#heenTerug').click(function() {
	if (!$(this).is(':checked')) {
		$('#terug').slideUp();
	}else{
		$('#terug').slideDown();
	}
});

$('#heenDatum').change(function(){
	$('#terugDatum').val($('#heenDatum').val());
	//show amount of rits availble after this one
});

$('select').change(function() {
	if($(this).val() == 'nieuwAdres'){
		$('#exampleModal').attr('data-id', $(this).attr('id'));
		$('#exampleModal').modal('show');
	}
});

$('#anuleerAdres').click(function(){
	$('#' + $('#exampleModal').attr('data-id')).val('default');
	$('#exampleModal').modal('hide');
	$("form#adres :input").each(function(){
		$(this).val('');
	});
	$('#errorModal').hide();
});

$("#exampleModal").on('hide.bs.modal', function () {
	$('#' + $('#exampleModal').attr('data-id')).val('default');
	$("form#adres :input").each(function(){
		$(this).val('');
	});
	$('#errorModal').hide();
});

$('#saveAdres').click(function(){
	//uitlezen adres
	var huisnummer = $('#street_number').val();
	var straat = $('#route').val();
	var gemeente = $('#locality').val();
	var postcode = $('#postal_code').val();
	
	if(huisnummer == '' || straat == '' || gemeente == '' || postcode == ''){
		errorModal('Vul een volledig adres in! huisnummer, straat, gemeente, postcode');
	}else{
		//kijk of adres al ingeladen is
		var bestaat = checkOfAdresIngeladenIs(huisnummer, straat, gemeente);
		if(bestaat != false){
			$('#exampleModal').modal('hide');
			$('#' + $('#exampleModal').attr('data-id')).val(bestaat);
			
		}else{
			// ajaxrequest
			$.ajax(
				{
					type:"post",
					url: "<?php echo base_url(); ?>index.php/MM/ritten/nieuwAdres",
					data:{ huisnummer:huisnummer, straat:straat, gemeente:gemeente, postcode:postcode},
					success:function(response)
					{
						console.log(response);//Stationsstraat 177, Geel, België
						var adres = JSON.parse(response);
						//toevoegen aan adressen lijst
						$('select').each(function(){
							$(this).children().eq(1).after('<option value="' + adres.id + '">' + adres.straat + ' ' + adres.huisnummer + ' (' + adres.gemeente + ')</option>');
						});
						$('#exampleModal').modal('hide');
						$('#' + $('#exampleModal').attr('data-id')).val(adres.id);
					}
				}
			);
		}
	}
});

function errorModal(bericht){
	$('#errorModal').html(bericht);
	$('#errorModal').slideDown();
}

function checkOfAdresIngeladenIs(huisnummer, straat, gemeente){
	var result = false;
	$('select#heenStartAdres option').each(function(){
		if($(this).text() == (straat + " " + huisnummer + " (" + gemeente + ")")){
			result = $(this).val();
			return false;
		}
	});
	return result;
}

//fill in adres --> check if both adresses are filled --> calculate cost





//autocomplete van google
var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
      {types: ['geocode']});

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
   // document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
</script>