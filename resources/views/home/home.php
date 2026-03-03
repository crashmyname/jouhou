<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title?></title>
    <link href="<?= asset('tabler/dist/css/tabler.min.css?1692870487')?>" rel="stylesheet"/>
    <link href="<?= asset('tabler/dist/css/tabler-flags.min.css?1692870487')?>" rel="stylesheet"/>
    <link href="<?= asset('tabler/dist/css/tabler-payments.min.css?1692870487')?>" rel="stylesheet"/>
    <link href="<?= asset('tabler/dist/css/tabler-vendors.min.css?1692870487')?>" rel="stylesheet"/>
    <link href="<?= asset('tabler/dist/css/demo.min.css?1692870487')?>" rel="stylesheet"/>
    <link rel="shortcut icon" href="<?= asset('bpjs.png')?>" type="image/x-icon">
  </head>
    <style>
    .toggle-svg {
      transition: transform 0.3s ease;
    }

    .collapsed .toggle-svg {
      transform: rotate(-90deg);
    }
    .circle {
      width: 70px;
      height: 70px;
      position: relative;
      border-radius: 50%;
      overflow: hidden;
      border: 1px solid black;
    }

    .quadrant {
      width: 50%;
      height: 50%;
      position: absolute;
      box-shadow: 0 0 0 1px black;
    }

    .q1 { top: 0; left: 0; }
    .q2 { top: 0; right: 0; }
    .q3 { bottom: 0; left: 0; }
    .q4 { bottom: 0; right: 0; }

    .primary { background: #0756cc; }
    .success { background: #29d183; }
    .gray    { background: #6c757d; }
    </style>
  <body>
    <header class="navbar navbar-expand-md d-print-none bg-primary">
      <div class="container-xl position-relative d-flex justify-content-center">

        <div class="position-absolute start-0">
          <select class="form-control">
            <option>Line 1</option>
            <option>Line 2</option>
            <option>Line 3</option>
          </select>
        </div>
        <h1 class="navbar-brand m-0 text-center fs-1">
          <a href="#" class="text-white text-decoration-none">
            JOUHOU BOARD
          </a>
        </h1>

      </div>
    </header>
    <div class="container-fluid mt-1">
      <div class="row mb-2">
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title text-white">CUSTOMER OUTFLOW SITUATION</h3>
              <div class="card-actions">
                <a href="#card-layout-sheet1"
                  class="btn-action text-white toggle-icon"
                  data-bs-toggle="collapse"
                  aria-expanded="true">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down toggle-svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
                </a>
              </div>
            </div>
    
            <div id="card-layout-sheet1" class="collapse show">
              <div class="card-body text-center">
                <div class="table-responsive">
                  <table class="table table-vcenter card-table">
                    <tr>
                      <td>NO MC/LANE</td>
                      <td>:</td>
                      <td width="200px"></td>
                    </tr>
                    <tr>
                      <td>DATE</td>
                      <td>:</td>
                      <td width="200px"></td>
                    </tr>
                    <tr>
                      <td>TYPE / MODEL</td>
                      <td>:</td>
                      <td width="200px"></td>
                    </tr>
                    <tr>
                      <td>ZERO CLAIM</td>
                      <td>:</td>
                      <td width="200px"></td>
                    </tr>
                    <tr>
                      <td colspan="2">GROUP</td>
                      <td width="200px">LAST CLAIM <br>--/--/----</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title text-white">LAYOUT SHEET</h3>
              <div class="card-actions">
                <a href="#card-layout-sheet2"
                  class="btn-action text-white toggle-icon"
                  data-bs-toggle="collapse"
                  aria-expanded="true">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down toggle-svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
                </a>
              </div>
            </div>
    
            <div id="card-layout-sheet2" class="collapse show">
              <div class="card-body text-center">
    
                <img src="<?= asset('image/mc1.png')?>"
                    class="img-fluid rounded cursor-pointer"
                    style="max-width:300px;"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)">
                <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-transparent border-0 shadow-none">
                      <div class="modal-body p-0 text-center">
                        <img id="previewImage" src="" class="img-fluid rounded" alt="Preview">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title text-white">PERUBAHAN 4M</h3>
              <div class="card-actions">
                <a href="#card-layout-sheet3"
                  class="btn-action text-white toggle-icon"
                  data-bs-toggle="collapse"
                  aria-expanded="true">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down toggle-svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
                </a>
              </div>
            </div>
    
            <div id="card-layout-sheet3" class="collapse show">
              <div class="card-body text-center">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover" style="color:black;">
                    <tbody>
                      <tr>
                        <td style="background-color: red;color:white;">MAN</td>
                        <td style="background-color: blue;color:white;">MACHINE</td>
                      </tr>
                      <tr>
                        <td>
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" value="" checked="checked">
                                ADA
                              </label><br>
                              <label>
                                <input type="checkbox" value="">
                                TIDAK ADA
                              </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" value="" checked="checked">
                                ADA
                              </label><br>
                              <label>
                                <input type="checkbox" value="">
                                TIDAK ADA
                              </label>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td style="background-color: yellow;color:black;">MATERIAL</td>
                        <td style="background-color: green;color:white;">METHODE</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="checkbox">
                              <label>
                                <input type="checkbox" value="" checked="checked">
                                ADA
                              </label><br>
                              <label>
                                <input type="checkbox" value="">
                                TIDAK ADA
                              </label>
                            </div>
                        </td>
                        <td>
                          <div class="checkbox">
                              <label>
                                <input type="checkbox" value="" checked="checked">
                                ADA
                              </label><br>
                              <label>
                                <input type="checkbox" value="">
                                TIDAK ADA
                              </label>
                            </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title text-white">RENCANA PRODUKSI</h3>
              <div class="card-actions">
                <a href="#card-layout-sheet4"
                  class="btn-action text-white toggle-icon"
                  data-bs-toggle="collapse"
                  aria-expanded="true">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down toggle-svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
                </a>
              </div>
            </div>
    
            <div id="card-layout-sheet4" class="collapse show">
              <div class="card-body text-center">
    
                <div class="card-body" style="height: 250px; overflow: hidden; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#pdfModal">
                  <iframe src="<?= asset('image/plan_injecttion.pdf')?>" width="100%" height="100%" style="border:none; pointer-events:none;">
                  </iframe>
                </div>
                <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-fullscreen" role="document">
                    <div class="modal-content" style="height: 100vh;">
                      <div class="modal-header">
                        <h5 class="modal-title">Preview Rencana Produksi</h5>
                        <button type="button btn-primary" class="btn btn-red" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×Close</span>
                        </button>
                      </div>
                      <div class="modal-body p-0" style="height: calc(100vh - 56px);">
                        <iframe src="<?= asset('image/plan_injecttion.pdf')?>" width="100%" height="100%" style="border:none;">
                        </iframe>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title text-white">MONITORING KOSU</h3>
              <div class="card-actions">
                <a href="#card-layout-sheet5"
                  class="btn-action text-white toggle-icon"
                  data-bs-toggle="collapse"
                  aria-expanded="true">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down toggle-svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
                </a>
              </div>
            </div>
    
            <div id="card-layout-sheet5" class="collapse show">
              <div class="card-body text-center">
                <h1>ITEM INI TIDAK DIKONTROL / DIKECUALIKAN</h1>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title text-white">TABEL CATATAN CLAIM CUSTOMER</h3>
              <div class="card-actions">
                <a href="#card-layout-sheet6"
                  class="btn-action text-white toggle-icon"
                  data-bs-toggle="collapse"
                  aria-expanded="true">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down toggle-svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
                </a>
              </div>
            </div>
    
            <div id="card-layout-sheet6" class="collapse show">
              <div class="card-body text-center">
                <h1>ITEM INI TIDAK DIKONTROL /
DIKECUALIKAN</h1>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title text-white">POINT SKILL</h3>
              <div class="card-actions">
                <a href="#card-layout-sheet7"
                  class="btn-action text-white toggle-icon"
                  data-bs-toggle="collapse"
                  aria-expanded="true">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down toggle-svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
                </a>
              </div>
            </div>
    
            <div id="card-layout-sheet7" class="collapse show">
              <div class="card-body text-center">
                <table class="table table-bordered" style="text-align:center;">
                  <thead>
                    <tr>
                      <td>MP 1</td>
                      <td>MP 1</td> 
                    </tr>
                    <tr>
                      <td>EKO NURCAHYONO</td>
                      <td>BAGUS YOYO SANTOSO</td>
                    </tr>
                    <tr>
                      <td>73647</td>
                      <td>73417</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        
                        <img src="<?= asset('image/73647.jfif')?>"  alt="Image" style="width:130px;height:140px;">
                        
                      </td>
                      <td>
                        <img src="<?= asset('image/73417.jfif')?>"  alt="Image" style="width:130px;height:140px;">
                      </td>
                    </tr>
                    <tr>
                      <td align="center">
                        <div class="row">
                          <div class="col-6">
                            <div class="circle">
                              <div class="quadrant q1 primary"></div>
                              <div class="quadrant q2 primary"></div>
                              <div class="quadrant q3 gray"></div>
                              <div class="quadrant q4 gray"></div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="circle">
                              <div class="quadrant q1 success"></div>
                              <div class="quadrant q2 success"></div>
                              <div class="quadrant q3 success"></div>
                              <div class="quadrant q4 gray"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td align="center">
                        <div class="row">
                          <div class="col-6">
                            <div class="circle">
                              <div class="quadrant q1 primary"></div>
                              <div class="quadrant q2 primary"></div>
                              <div class="quadrant q3 gray"></div>
                              <div class="quadrant q4 gray"></div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="circle">
                              <div class="quadrant q1 success"></div>
                              <div class="quadrant q2 success"></div>
                              <div class="quadrant q3 success"></div>
                              <div class="quadrant q4 gray"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title text-white">PAPAN MANAGEMENT PRODUKSI</h3>
              <div class="card-actions">
                <a href="#card-layout-sheet8"
                  class="btn-action text-white toggle-icon"
                  data-bs-toggle="collapse"
                  aria-expanded="true">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down toggle-svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
                </a>
              </div>
            </div>
    
            <div id="card-layout-sheet8" class="collapse show">
              <div class="card-body text-center">
    
                <img src=""
                    class="img-fluid rounded cursor-pointer"
                    style="max-width:300px;"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)">
    
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title text-white">COMPLAIN OCCURE CONTACT FROM ISSUE</h3>
              <div class="card-actions">
                <a href="#card-layout-sheet9"
                  class="btn-action text-white toggle-icon"
                  data-bs-toggle="collapse"
                  aria-expanded="true">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down toggle-svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
                </a>
              </div>
            </div>
    
            <div id="card-layout-sheet9" class="collapse show">
              <div class="card-body text-center">
    
                <img src="files/layout_machine/mc1.png"
                    class="img-fluid rounded cursor-pointer"
                    style="max-width:300px;"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)">
    
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title text-white">MAPPING OPERATOR PRODUKSI</h3>
              <div class="card-actions">
                <a href="#card-layout-sheet10"
                  class="btn-action text-white toggle-icon"
                  data-bs-toggle="collapse"
                  aria-expanded="true">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down toggle-svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
                </a>
              </div>
            </div>
    
            <div id="card-layout-sheet10" class="collapse show">
              <div class="card-body text-center">
    
                <img src="files/layout_machine/mc1.png"
                    class="img-fluid rounded cursor-pointer"
                    style="max-width:300px;"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)">
    
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title text-white">RECORD PERUBAHAN 4M</h3>
              <div class="card-actions">
                <a href="#card-layout-sheet11"
                  class="btn-action text-white toggle-icon"
                  data-bs-toggle="collapse"
                  aria-expanded="true">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down toggle-svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
                </a>
              </div>
            </div>
    
            <div id="card-layout-sheet11" class="collapse show">
              <div class="card-body text-center">
    
                <img src="files/layout_machine/mc1.png"
                    class="img-fluid rounded cursor-pointer"
                    style="max-width:300px;"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)">
    
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title text-white">CHECKSHEET PARTING LINE</h3>
              <div class="card-actions">
                <a href="#card-layout-sheet12"
                  class="btn-action text-white toggle-icon"
                  data-bs-toggle="collapse"
                  aria-expanded="true">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down toggle-svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
                </a>
              </div>
            </div>
    
            <div id="card-layout-sheet12" class="collapse show">
              <div class="card-body text-center">
    
                <img src="files/layout_machine/mc1.png"
                    class="img-fluid rounded cursor-pointer"
                    style="max-width:300px;"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)">
    
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title text-white">CHECKSHEET MACHINE</h3>
              <div class="card-actions">
                <a href="#card-layout-sheet13"
                  class="btn-action text-white toggle-icon"
                  data-bs-toggle="collapse"
                  aria-expanded="true">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down toggle-svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
                </a>
              </div>
            </div>
    
            <div id="card-layout-sheet13" class="collapse show">
              <div class="card-body text-center">
    
                <img src="files/layout_machine/mc1.png"
                    class="img-fluid rounded cursor-pointer"
                    style="max-width:300px;"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)">
    
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title text-white">CHECKSHEET 2S3T</h3>
              <div class="card-actions">
                <a href="#card-layout-sheet14"
                  class="btn-action text-white toggle-icon"
                  data-bs-toggle="collapse"
                  aria-expanded="true">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down toggle-svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
                </a>
              </div>
            </div>
    
            <div id="card-layout-sheet14" class="collapse show">
              <div class="card-body text-center">
    
                <img src="files/layout_machine/mc1.png"
                    class="img-fluid rounded cursor-pointer"
                    style="max-width:300px;"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)">
    
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title text-white">CATATAN NURSECALL</h3>
              <div class="card-actions">
                <a href="#card-layout-sheet15"
                  class="btn-action text-white toggle-icon"
                  data-bs-toggle="collapse"
                  aria-expanded="true">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down toggle-svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
                </a>
              </div>
            </div>
    
            <div id="card-layout-sheet15" class="collapse show">
              <div class="card-body text-center">
    
                <img src="files/layout_machine/mc1.png"
                    class="img-fluid rounded cursor-pointer"
                    style="max-width:300px;"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)">
    
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title text-white">CHECKSHEET PATROL TEAM LEADER</h3>
              <div class="card-actions">
                <a href="#card-layout-sheet16"
                  class="btn-action text-white toggle-icon"
                  data-bs-toggle="collapse"
                  aria-expanded="true">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-down toggle-svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 10l6 6l6 -6h-12" /></svg>
                </a>
              </div>
            </div>
    
            <div id="card-layout-sheet16" class="collapse show">
              <div class="card-body text-center">
    
                <img src="files/layout_machine/mc1.png"
                    class="img-fluid rounded cursor-pointer"
                    style="max-width:300px;"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    onclick="showImage(this.src)">
    
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(btn => {
          const target = document.querySelector(btn.getAttribute('href'));

          target.addEventListener('show.bs.collapse', function () {
              btn.classList.remove('collapsed');
          });

          target.addEventListener('hide.bs.collapse', function () {
              btn.classList.add('collapsed');
          });
      });
    function showImage(src) {
      document.getElementById('previewImage').src = src;
    }
    </script>
    <!-- Libs JS -->
    <script src="<?= asset('tabler/dist/libs/apexcharts/dist/apexcharts.min.js?1692870487')?>" defer></script>
    <script src="<?= asset('tabler/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1692870487')?>" defer></script>
    <script src="<?= asset('tabler/dist/libs/jsvectormap/dist/maps/world.js?1692870487')?>" defer></script>
    <script src="<?= asset('tabler/dist/libs/jsvectormap/dist/maps/world-merc.js?1692870487')?>" defer></script>
    <script src="<?= asset('tabler/dist/libs/fslightbox/index.js?1692870487')?>" defer></script>
    <!-- Tabler Core -->
    <script src="<?= asset('tabler/dist/js/tabler.min.js?1692870487')?>" defer></script>
    <script src="<?= asset('tabler/dist/js/demo.min.js?1692870487')?>" defer></script>
  </body>
</html>
