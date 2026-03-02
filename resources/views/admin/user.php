    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card-header">
                    <h4 class="card-title"><?= $title?></h4>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-user">
                        Add User
                    </button>
                    <div id="userContainer" class="w-full overflow-x-auto sm:overflow-visible mt-3">
                        <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden border border-gray-200 rounded-lg">
                            <table id="userTable" class="min-w-full border-collapse text-sm sm:text-base">
                            <thead></thead>
                            <tbody></tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-user" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="formadduser" action="" enctype="multipart/form-data" method="post">
                    <?= csrf()?>
                    <div class="modal-header">
                        <h5 class="modal-title">New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">NIK</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Your NIK">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Your name" readonly>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group input-group-flat">
                                        <input type="password" name="password" class="form-control" id="password"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="adduser" class="btn btn-primary ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Create new user
                        </button>
                        <button class="btn btn-primary ms-auto" style="display: none;" id="loading" disabled>
                            <div class="spinner-border me-2" role="status"></div>
                            <strong>Loading...</strong>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="formedituser" action="" enctype="multipart/form-data" method="post">
                    <?= method('PUT')?>
                    <div class="modal-header">
                        <h5 class="modal-title">Update User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">NIK</label>
                            <input type="text" class="form-control" name="username" id="uusername" placeholder="Your NIK">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="uname"
                                placeholder="Your name">
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group input-group-flat">
                                        <input type="password" name="password" class="form-control" id="upassword"
                                            autocomplete="off">
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="edituser" class="btn btn-yellow ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Update user
                        </button>
                        <button class="btn btn-yellow ms-auto" style="display: none;" id="loadingedit" disabled>
                            <div class="spinner-border me-2" role="status"></div>
                            <strong>Loading...</strong>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?= asset_v('js/table-plus.js')?>"></script>
    <script>
        var urlEmp = '<?= route('getemp')?>'
        var csrfToken = '<?= csrfHeader()?>'
        var createUser = '<?= route('user.create')?>'
        var getUser = '<?= route('user.getdata')?>'
        var editUser = '<?= url('user')?>'
        var deleteUser = '<?= url('user')?>'
    </script>
    <script src="<?= asset_v('js/users.js')?>"></script>