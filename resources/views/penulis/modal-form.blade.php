<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="modalFormLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="penulisForm">
                <div class="modal-body border-top border-bottom">
                    <input type="hidden" id="uuid">
                    <div class="mb-3">
                        <label for="name">Nama Penulis
                        </label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email Penulis
                        </label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3" id="oldPassword" style="display: none;">
                        <label for="old_password">Old Password</label>
                        <input type="password" name="old_password" class="form-control" id="old-password">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password
                        </label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirm">Password Confirmation
                        </label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm"
                            required>
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
