<?php
/**
 * @file medewerker/gebruikersBeherenOverzicht.php
 *
 * View waarin gebruikers in kunnen worden beheerd
 * - krijgt een variabele $firstVisit binnen om gebruikersondersteuning te tonen bij het bezoeken voor de eerste keer
 * - krijgt een $functies-object binnen om op functie gebruikers te kunnen tonen (medewerker kan tot en met vrijwilliger zien, admin tot en met medewerker)
 *
 * Gemaakt door Geffrey Wuyts
 *
 * Medemogelijk door Michiel Olijslagers
 */

?>
<div class="row">
    <div class="col-5">
        <div class="row">
            <div class="col-5 form-group">
                <?php
                echo form_labelpro('Functie', 'functieListbox');
                echo form_listboxpro('functieListbox', $functies, 'id', 'naam', -1, array('id' => 'functieListbox', 'class' => 'form-control'));
                ?>
            </div>
            <div class="col-7 form-group">
                <?php
                echo form_labelpro('Filter op naam', 'filterNaam');
                echo form_input(array('id' => 'filterNaam', 'placeholder' => 'Geef een naam in', 'class' => 'form-control'));
                ?>
            </div>
            <div class="col-12 form-group">
                <?php
                echo form_hidden('firstVisit', $firstVisit);
                echo form_listboxproGebruikersBeheren('gebruikersListbox', array(), 'id', 'voornaam', 'naam', 0, array('id' => 'gebruikersListbox', 'size' => 10, 'class' => 'form-control'));
                ?>
            </div>

            <div class="col-12 form-group">
                <?php print anchor("medewerker/gebruikersBeheren/gegevensWijzigen", '+ Nieuwe gebruiker', 'class="btn btn-primary"'); ?>
            </div>
        </div>
    </div>
    <div class="col-7">
        <div id="gebruikerInfo" class="row"></div>
    </div>
</div>
<div class="modal fade" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="tutorialModalLabel" aria-hidden="true" data-id="" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tutorialModalLabel">Hoe werkt Gebruikers beheren?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <?php echo toonAfbeelding("tutorial/tut1.jpg", 'class="d-block w-100" alt="First slide"');?>
                        </div>
                        <?php
                            for ($i = 2; $i <= 7; $i++){
                                echo '<div class="carousel-item">';
                                echo toonAfbeelding("tutorial/tut".$i.".jpg", 'class="d-block w-100" alt="First slide"');
                                echo '</div>';
                            }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" style="color: black;">
                        <span>
							<i class="fas fa-angle-left fa-2x"></i>
						</span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" style="color: black;">
                        <span>
							<i class="fas fa-angle-right fa-2x"></i>
						</span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="closeTut">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function () {
        if($("input[name=firstVisit]").val() == 1){
            $('#tutorialModal').modal('show');
        }

        haalGebruikersMetFunctieOp($('#functieListbox option:selected').val());

        $('#functieListbox').change(function () {
            haalGebruikersMetFunctieOp($('#functieListbox option:selected').val());
        });

        $('#gebruikersListbox').change(function () {
            haalGebruikerInfoOp($('#gebruikersListbox option:selected').val());
        });

        $('#closeTut').click(function () {
            $('#tutorialModal').modal('hide');
        });
    });
	
	$('#filterNaam').keyup(function(){
		filterOpNaam();
	});

	function filterOpNaam() {
        var filterNaam = $('#filterNaam').val().toLowerCase();
        $('#gebruikersListbox option').show();

        if(filterNaam != ""){
            $('#gebruikersListbox option').not('[data-m *= ' + filterNaam + ']').hide();
        }
    }
	
    function haalGebruikersMetFunctieOp(functieId) {
        $.ajax({
            type: "GET",
            url: site_url + "/medewerker/gebruikersBeheren/haalAjaxOp_GebruikersOpFunctie",
            data: {functieId: functieId},
            success: function (result) {
                $("#gebruikersListbox").html(result);
				$('#gebruikersListbox option').each(function(){
					$(this).attr('data-m', $(this).text().toLowerCase());
				});
                filterOpNaam();
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }

    function haalGebruikerInfoOp(gebruikerId) {
        $.ajax({
            type: "GET",
            url: site_url + "/medewerker/gebruikersBeheren/haalAjaxOp_GebruikerInfo",
            data: {gebruikerId: gebruikerId},
            success: function (result) {
                $("#gebruikerInfo").html(result);
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }
</script>