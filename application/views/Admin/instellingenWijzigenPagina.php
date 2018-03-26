<?php


?>
<script>
    $(document).ready(function(){

        $( "#soort" ).change(function() {
            console.log($( this ).val());
            $('.voorkeurForm').prop('disabled', false);
        });

    });
</script>

<div class="row">
    <div class="col-sm-12 col-md-6">
    <?php
        $attributes = array('name' => 'instellingenForm');
        echo form_open('admin/instellingen/wijzigInstellingen', $attributes);
        /*
         * input field komt bij klein scherm lelijk te staan
         */
        foreach ($instellingen as $instelling) {
            echo '<div class="form-group row">';
                echo form_label($instelling->beschrijving, $instelling->naam, array('class' => 'col-sm-12 col-md-7 col-form-label'));
                echo form_input(array('name' => $instelling->naam, 'id' => $instelling->naam, 'placeholder' => $instelling->waarde, 'type' => 'numeric', 'size' => '30', 'class' => 'form-control col-sm-12 col-md-2'));
            echo '</div>';
        }

        echo form_submit(array('name' => 'InstellingenOpslaan', 'value' => 'Opslaan', 'class' => 'btn btn-primary'));

        echo form_close();
    ?>
    </div>
    
    <div class="col-sm-12 col-md-6">
        <?php
        $attributes = array('name' => 'voorkeurForm');
        echo form_open('admin/instellingen/voorkeurVerwijderen', $attributes);
        ?>
        <div class="row">
            <div class="col-12">
                <p>Communicatie mogenlijkheden:</p>
                <?php
                $lengte = count($voorkeuren);
                if(count($voorkeuren) > 10){
                    $lengte = 10;
                }
                echo form_listboxpro('soort', $voorkeuren, 'id', 'naam', 0, array('id' => 'soort', 'size' => $lengte, 'class' => 'form-control'));
                ?>
            </div>
            <div class="col-12">
                <div class="row" style="padding-top: 10px">
                    <div class="col-6">
                        <?php
                        echo form_input(array('name' => 'nieuweVoorkeur', 'id' => 'nieuweVoorkeur', 'placeholder' => 'Selecteer voorkeur', 'disabled' => 'true', 'size' => '30', 'class' => 'form-control voorkeurForm'));
                        ?>
                    </div>
                    <div class="col-6" style="padding-left: 0">
                        <?php
                        echo form_submit(array('name' => 'voorkeurWijzigen', 'value' => 'Wijzigen', 'class' => 'btn btn-primary voorkeurForm', 'disabled' => 'true'));
                        ?>
                        <?php
                        echo form_submit(array('name' => 'voorkeurVerwijderen', 'value' => 'Verwijderen', 'class' => 'btn btn-danger voorkeurForm', 'disabled' => 'true'));
                        ?>
                    </div>
                </div>

            </div>

            <?php echo form_close(); ?>






            <!--<?php
            $attributes = array('name' => 'voorkeurToevoegenForm');
            echo form_open('admin/instellingen/voorkeurToevoegen', $attributes);
            ?>
            <div class="row" style="padding: 10px 10px 0">
                <div class="form-group col-8">
                    <?php
                        echo form_input(array('name' => 'nieuweVoorkeur', 'id' => 'nieuweVoorkeur', 'placeholder' => 'Nieuwe voorkeur', 'required' => 'true', 'size' => '30', 'class' => 'form-control'));
                    ?>
                </div>
                <div class="col-3">
                    <?php
                        echo form_submit(array('name' => 'voorkeurToevoegen', 'value' => 'Toevoegen', 'class' => 'btn btn-primary'));
                    ?>
                </div>
            </div>
            <?php echo form_close(); ?>-->
        </div>
    </div>
</div>