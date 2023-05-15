<!----->
<form id="delete" action="tmp/elimina_profilo.php" style="margin-top:50px;">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <h3>Danger Zone</h3>
            <p>A tuo rischio e pericolo</p>
        </div>
        <div class="col-md-6 col-lg-6">
            <button type="button" style="margin:auto;height: 100px;width: 180px;font-size: 30px;color:black;" class="btn btn-danger btn-block" data-toggle="modal" data-target="#delete-modal" ><strong>Elimina Profilo</strong></button>
        </div>
    </div>
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class=modal-content>
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-modal-title">Elimina Profilo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Sei sicuro di voler eliminare il profilo?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-danger">Si confermo!</button>
                </div>
            </div>
        </div>
    </div>
</form>