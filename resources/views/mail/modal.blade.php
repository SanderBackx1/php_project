<div class='modal' id='modal-mail'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filters selecteren</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class='row selectbox'>
                        <label class='col-sm'for="eventSelect">Selecteer avond waarvan u vragen wilt filteren:</label>
                        <select class='col-sm'id="eventSelect"> </select>
                    </div>
                    <div class='row'>
                    <div class="form-group col-sm filterbox" id='filtersNotSelectedForm'></div>
                    <div class='col-sm' id="filterButtons">
                        <p><a data-toggle="tooltip" title="Geselecteerde filters toevoegen" id='add' class='btn btn-success'>></a></p>
                        <p><a data-toggle="tooltip" title="Alle filters toevoegen" id='addAll' class='btn btn-success'>>></a></p>
                        <p><a data-toggle="tooltip" title="Geseleteerde filters verwijderen" id='removeAll' class='btn btn-danger'><<</a></p>
                        <p><a data-toggle="tooltip" title="Alle filters verwijderen" id='remove' class='btn btn-danger'><</a></p>
                    </div>
                    <div class="form-group col-sm filterbox" id='filtersSelectedForm'></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
