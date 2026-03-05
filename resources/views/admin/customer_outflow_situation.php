    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card-header">
                    <h4 class="card-title"><?= $title?></h4>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-cos">
                        Add COS
                    </button>
                    <div id="cosContainer" class="w-full overflow-x-auto sm:overflow-visible mt-3">
                        <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden border border-gray-200 rounded-lg">
                            <table id="cosTable" class="min-w-full border-collapse text-sm sm:text-base">
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
    <div class="modal modal-blur fade" id="modal-cos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="formaddcos" action="" enctype="multipart/form-data" method="post">
                    <?= csrf()?>
                    <div class="modal-header">
                        <h5 class="modal-title">New Customer Outflow Situation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">No Lane</label>
                            <select name="noLane" id="noLane" class="form-control">
                                <?php foreach($lane as $ln):?>
                                    <option value="<?= $ln->laneId?>"><?= $ln->noLane?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No Machine Lane</label>
                            <input type="text" class="form-control" name="noMcLane" id="noMcLane">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" id="date">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type Model</label>
                            <input type="text" class="form-control" name="typeModel" id="typeModel">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Zero Claim</label>
                            <input type="text" class="form-control" name="zeroClaim" id="zeroClaim">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Claim</label>
                            <input type="text" class="form-control" name="lasClaim" id="lasClaim">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="addcos" class="btn btn-primary ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Create new Customer Outflow Situation
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
                <form id="formeditcos" action="" enctype="multipart/form-data" method="post">
                    <?= method('PUT')?>
                    <div class="modal-header">
                        <h5 class="modal-title">Update Customer Outflow Situation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">No Lane</label>
                            <select name="noLane" id="unoLane" class="form-control">
                                <?php foreach($lane as $ln):?>
                                    <option value="<?= $ln->laneId?>"><?= $ln->noLane?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No Machine Lane</label>
                            <input type="text" class="form-control" name="noMcLane" id="unoMcLane">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" id="udate">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type Model</label>
                            <input type="text" class="form-control" name="typeModel" id="utypeModel">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Zero Claim</label>
                            <input type="text" class="form-control" name="zeroClaim" id="uzeroClaim">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Claim</label>
                            <input type="text" class="form-control" name="lasClaim" id="ulasClaim">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="editcos" class="btn btn-yellow ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Update Customer Outflow Situation
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
        var csrfToken = '<?= csrfHeader()?>'
        var createCos = '<?= route('cos.create')?>'
        var getCos = '<?= route('cos.getdata')?>'
        var editCos = '<?= url('admin/cos')?>'
        var deleteCos = '<?= url('admin/cos')?>'
    </script>
    <script src="<?= asset_v('js/customer_outflow_situation.js')?>"></script>