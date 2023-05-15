<div class="modal fade" id="password-modal" tabindex="-1" role="dialog" aria-labelledby="password-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!--Modal Header-->
            <div class= modal-header>
                <h5 class="modal-title" id="change-password-title">Modifica la password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Modal Header-->
            <!--Modal Body-->
            <div class=modal-body>
                
                    <div class="form-group form-modal">
                        <label for="old-password">Inserisci la Vecchia Password</label>
                        <input type="password" class="form-control" id="old-password" name="oldpassword" required/>
                    </div>
                    <div class="form-group form-modal">
                        <label for="new-password">Inserisci la Nuova Password</label>
                        <input type="password" class="form-control" id="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve contenere almeno 8 caratteri di cui un numero, una maiuscola e una minuscola!"/>
                    </div>
                    <div class="form-group form-modal">
                        <label for="confirm-password">Conferma la Nuova Password</label>
                        <input type="password" class="form-control" id="ctrlpassword" name="ctrlpassword" required/>
                    </div>
                
            </div>
                <!--Modal Body-->
                <!--Modal Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                <button type="submit" class="btn btn-primary">Applica le modifiche</button>
            </div>
            <!--Modal Footer-->
        </div>
    </div>    
</div>
  
