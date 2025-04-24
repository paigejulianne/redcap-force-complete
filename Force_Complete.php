<?php
namespace paigejulianne\Force_Complete;

use ExternalModules\AbstractExternalModule;

class Force_Complete extends AbstractExternalModule {

    public function redcap_data_entry_form ( int $project_id, string $record = NULL, string $instrument, int $event_id, int $group_id = NULL, int $repeat_instance = 1 ) : void {
        // add the force close button underneath the submit buttons

        if(SUPER_USER){
            ?>
            <script>
                var form_status_val = $("select[name='<?php echo $instrument; ?>_complete']").val();
                console.log(form_status_val);
                var onclick_func = "if(confirm('Are you sure you want to force close this instrument?')) dataEntrySubmit(this);return false;";
                var input_button = "<input class='btn btn-default' name='submit-btn-forceclose' value='Force Close' onclick="+'"' + onclick_func +'"'+" type='submit' />";
                if(form_status_val == 0){
                    $(""+input_button).insertAfter("div#__SUBMITBUTTONS__-div");
                }
            </script>
            <?php

        } // end if SUPER_USER
    }

    public function redcap_add_edit_records_page(int $project_id, string $instrument, int $event_id): void {
        echo "<script type='text/javascript'>console.log('Hit EM');</script>";
        if (isset($_POST['submit-action'])) {
            if ($_POST['submit-action'] == 'submit-btn-forceclose') {
              die();
            }
        }
    }

}
