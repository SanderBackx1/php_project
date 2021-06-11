<div class='modal' id='modal-activiteit'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">modal-activiteit-title</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    @method('')
                    @csrf
                    <div class="form-group">

                        <label for="name">Name</label>
                        <input type="text" name="naam" id="naam"
                               class="form-control"
                               placeholder="Naam"
                               minlength="3"
                               required
                               value="">

                        <label for="name">Startuur</label>
                        <input type="text" name="startuur" id="startuur"
                                class="form-control"
                                placeholder="Startuur"
                                minlength="3"
                                required
                                value="">

                        <label for="name">Einduur</label>
                        <input type="text" name="einduur" id="einduur"
                                class="form-control"
                                placeholder="Einduur"
                                minlength="3"
                                required
                                value="">

                        <label for="name">Lokaal</label>
                        <input type="text" name="lokaal" id="lokaal"
                                class="form-control"
                                placeholder="Lokaal"
                                minlength="3"
                                required
                                value="">

                        <label style="display:none" for="name">Evenement id</label>
                        <input style="display:none" type="text" name="evenement" id="evenement"
                                class="form-control"
                                placeholder="0"
                                minlength="3"
                                required
                                value="">


                        <div class="invalid-feedback"></div>
                    </div>
                    <button data-toggle="tooltip" title="Wijzigingen opslaan" type="submit" class="btn btn-success">Wijziging opslaan</button>
                </form>
            </div>
        </div>
    </div>
</div>
