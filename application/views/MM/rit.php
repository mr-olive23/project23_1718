<!--
	-> rit met een pijl tussen
	-> km prijs, extra prijs, totale prijs
-->

<?php var_dump($rit); ?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="..">Overzicht ritten</a></li>
    <li class="breadcrumb-item active" aria-current="page">Rit bekijken</li>
  </ol>
</nav>
<div class="row">
	<div class="col-sm-12">
		<p>
			<button type="button" class="btn btn-primary"><i class="fas fa-pen-square"></i> Wijzigen</button>
			<button type="button" class="btn btn-primary"><i class="fas fa-ban"></i> Rit anuleren</button>
		</p>
	</div>
</div>
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-sm-6">
				<p><i class="fas fa-shopping-cart"></i> klant: Michiel Olijslagers</p>
				<p><i class="fas fa-car"></i> chauffeur: Jan Jansen</p>
				<p>
					<?php
						switch($rit->status->status->id){
							case 1:
								print '<i class="fas fa-circle text-danger"></i> status: ' . $rit->status->status->naam;
								break;
							case 2:
								print '<i class="fas fa-circle text-success"></i> status: ' . $rit->status->status->naam;
								break;
							case 3:
								print '<i class="fas fa-circle text-primary"></i> status: ' . $rit->status->status->naam;
								break;
							case 4:
								print '<i class="fas fa-circle text-warning"></i> status: ' . $rit->status->status->naam;
								break;
							default:
								print "error geen duidelijke status gevonden!";
								break;
						}
					
					?>
				</p>
			</div>
			<div class="col-sm-6">
				<table class="mt-3">
					<tr>
						<td>Km kost: </td>
						<td> € <?php print $rit->prijs; ?></td>
						
					</tr>
					<tr>
						<td>Extra kost: </td>
						<td> € <?php print $rit->extraKost; ?></td>
					</tr>
					<tr style="border-top: 1px solid grey;">
						<td><strong>Totale prijs: </strong></td>
						<td> € <?php print ($rit->prijs + $rit->extraKost); ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<article class="mt-2">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-sm-6">
					<h5>Heen rit</h5>
				</div>
				<div class="col-sm-6 text-right">
					<a href="#" class="text-danger"><i class="fas fa-times"></i></a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-3">
					<?php print date('D, j M' , strtotime($rit->heenvertrek->tijd)); ?>
				</div>
				<div class="col-sm-2">
					<p><i class="far fa-clock"></i> <?php print date('G:i' , strtotime($rit->heenvertrek->tijd)); ?></p>
					<p><i class="fas fa-map-marker"></i> <?php print $rit->heenvertrek->adres->straat . " " . $rit->heenvertrek->adres->huisnummer; ?> </p>
				</div>
				<div class="col-sm-2">
					<div class="mt-4"><i class="far fa-arrow-alt-circle-right"></i>-------<i class="far fa-arrow-alt-circle-right"></i></div>
				</div>
				<div class="col-sm-2">
					<p class="text-left"><i class="far fa-clock"></i> 9:20</p><!-- nog te bereken -->
					<p><i class="fas fa-flag-checkered"></i> <?php print $rit->heenaankomst->adres->straat . " " . $rit->heenaankomst->adres->huisnummer; ?></p>
				</div>
				<div class="col-sm-3">
					<i class="fas fa-hourglass-half"></i> 30 min <!-- nog te bereken -->
				</div>
			</div>
		</div>
	</div>
</article>
<article class="mt-2">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-sm-6">
					<h5>Terug rit</h5>
				</div>
				<div class="col-sm-6 text-right">
					<a href="#" class="text-danger"><i class="fas fa-times"></i></a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-3">
					<?php print date('D, j M' , strtotime($rit->terugvertrek->tijd)); ?>
				</div>
				<div class="col-sm-2">
					<p><i class="far fa-clock"></i> <?php print date('G:i' , strtotime($rit->terugvertrek->tijd)); ?></p>
					<p><i class="fas fa-map-marker"></i> <?php print $rit->terugvertrek->adres->straat . " " . $rit->terugvertrek->adres->huisnummer; ?></p>
				</div>
				<div class="col-sm-2">
					<div class="mt-4"><i class="far fa-arrow-alt-circle-right"></i>-------<i class="far fa-arrow-alt-circle-right"></i></div>
				</div>
				<div class="col-sm-2">
					<p class="text-left"><i class="far fa-clock"></i> 6:00</p>
					<p><i class="fas fa-flag-checkered"></i> <?php print $rit->terugaankomst->adres->straat . " " . $rit->terugaankomst->adres->huisnummer; ?></p>
				</div>
				<div class="col-sm-3">
					<i class="fas fa-hourglass-half"></i> 30 min
				</div>
			</div>
		</div>
	</div>
</article>
<div class="row mt-2">
	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<h5>Opmerking Klant</h5>
				<p><?php print $rit->opmerkingKlant; ?></p>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<h5>Opmerking Chauffeur</h5>
				<p><?php print $rit->opmerkingVrijwilliger; ?></p>
			</div>
		</div>
	</div>
</div>