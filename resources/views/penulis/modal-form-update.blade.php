<!-- Modal -->
<div class="modal fade" id="modalEditForm" tabindex="-1" aria-labelledby="modalEditFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="modalEditFormLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="penulisEditForm">
                <div class="modal-body border-top border-bottom">
                    <input type="hidden" id="uuids" name="uuid">
                    <div class="mb-3">
                        <label for="name">Nama Penulis
                        </label>
                        <input type="text" class="form-control" id="name_update" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email Penulis
                        </label>
                        <input type="email" class="form-control" id="email_update" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password
                        </label>
                        <input type="password" class="form-control" id="password_update" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirm">Password Confirmation
                        </label>
                        <input type="password" class="form-control" id="password_confirm_update"
                            name="password_confirm">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnSubmit"></button>
                </div>
            </form>
        </div>
    </div>
</div>
