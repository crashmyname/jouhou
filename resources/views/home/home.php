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
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link rel="shortcut icon" href="<?= asset('ISE.png')?>" type="image/x-icon">
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
          <select class="form-control" name="lane" id="lane">
            <?php foreach($lane as $ln):?>
              <option value="<?= $ln->laneId?>"><?= $ln->noLane?></option>
            <?php endforeach; ?>
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
                      <td width="200px" id="noMcLane"></td>
                    </tr>
                    <tr>
                      <td>DATE</td>
                      <td>:</td>
                      <td width="200px" id="date"></td>
                    </tr>
                    <tr>
                      <td>TYPE / MODEL</td>
                      <td>:</td>
                      <td width="200px" id="typeModel"></td>
                    </tr>
                    <tr>
                      <td>ZERO CLAIM</td>
                      <td>:</td>
                      <td width="200px" id="zeroClaim"></td>
                    </tr>
                    <tr>
                      <td colspan="2">GROUP</td>
                      <td width="200px">LAST CLAIM <br>
                      <p id="lastClaim"></p></td>
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
    
                <img src="" id="image-layout"
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
                                <input type="checkbox" value="" id="man-a">
                                ADA
                              </label><br>
                              <label>
                                <input type="checkbox" value="" id="man-ta">
                                TIDAK ADA
                              </label>
                            </div>
                        </td>
                        <td>
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" value="" id="machine-a">
                                ADA
                              </label><br>
                              <label>
                                <input type="checkbox" value="" id="machine-ta">
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
                                <input type="checkbox" value="" id="material-a">
                                ADA
                              </label><br>
                              <label>
                                <input type="checkbox" value="" id="material-ta">
                                TIDAK ADA
                              </label>
                            </div>
                        </td>
                        <td>
                          <div class="checkbox">
                              <label>
                                <input type="checkbox" value="" id="methode-a">
                                ADA
                              </label><br>
                              <label>
                                <input type="checkbox" value="" id="methode-ta">
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
                      <td>MP 2</td> 
                    </tr>
                    <tr>
                      <td id="empname1">-</td>
                      <td id="empname2">-</td>
                    </tr>
                    <tr>
                      <td id="empnik1">-</td>
                      <td id="empnik2">-</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        
                        <img src="" id="imageName1" alt="Image" style="width:130px;height:140px;">
                        
                      </td>
                      <td>
                        <img src="" id="imageName2" alt="Image" style="width:130px;height:140px;">
                      </td>
                    </tr>
                    <tr>
                      <td align="center">
                        <div class="row">
                          <div class="col-6">
                            <div class="circle" id="pointskill1-1">
                             
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="circle" id="pointskill1-2">
                              
                            </div>
                          </div>
                        </div>
                      </td>
                      <td align="center">
                        <div class="row">
                          <div class="col-6">
                            <div class="circle" id="pointskill2-1">
                              
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="circle" id="pointskill2-2">
                              
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
    <script src="<?= env('APP_NODE_SERVER')?>/socket.io/socket.io.js"></script>
    <script>
    const laneSelect = document.getElementById("lane");

    function loadData(laneId){
        $.ajax({
            url: '<?= url('dashboard/')?>' + laneId,
            type: 'GET',
            success: function(res){
                const cos = res.data.cos;
                const layout = res.data.layout;
                const fourm = res.data.fourm;
                const pointskill = res.data.point
                if(cos){
                  document.getElementById("noMcLane").innerText = cos.noMcLane;
                  document.getElementById("date").innerText = cos.format_date;
                  document.getElementById("typeModel").innerText = cos.typeModel;
                  document.getElementById("zeroClaim").innerText = cos.zeroClaim;
                  document.getElementById("lastClaim").innerText = cos.format_date_claim;
                }
                if(layout){
                    $("#image-layout").attr("src", layout.encrypt_url)
                }else{
                    $("#image-layout").attr("src", "<?= asset_v('image/no-image.png')?>")
                }
                if(fourm){
                  if(fourm.man == '1'){
                    $('#man-a').prop('checked', true);
                    $('#man-ta').prop('checked', false);
                  } else {
                    $('#man-a').prop('checked', false);
                    $('#man-ta').prop('checked', true);
                  }
                  if(fourm.machine == '1'){
                    $('#machine-a').prop('checked', true);
                    $('#machine-ta').prop('checked', false);
                  } else {
                    $('#machine-a').prop('checked', false);
                    $('#machine-ta').prop('checked', true);
                  }
                  if(fourm.material == '1'){
                    $('#material-a').prop('checked', true);
                    $('#material-ta').prop('checked', false);
                  } else {
                    $('#material-a').prop('checked', false);
                    $('#material-ta').prop('checked', true);
                  }
                  if(fourm.methode == '1'){
                    $('#methode-a').prop('checked', true);
                    $('#methode-ta').prop('checked', false);
                  } else {
                    $('#methode-a').prop('checked', false);
                    $('#methode-ta').prop('checked', true);
                  }
                } else {
                  $('#man-a').prop('checked', false);
                  $('#man-ta').prop('checked', false);
                  $('#machine-a').prop('checked', false);
                  $('#machine-ta').prop('checked', false);
                  $('#material-a').prop('checked', false);
                  $('#material-ta').prop('checked', false);
                  $('#methode-a').prop('checked', false);
                  $('#methode-ta').prop('checked', false);
                }
                if(pointskill){
                  $('#empname1').text(pointskill[0].empName)
                  $('#empnik1').text(pointskill[0].empNik)
                  $("#imageName1").attr("src", pointskill[0].encrypt_url)
                  let p = parseInt(pointskill[0].pointSkill)
                  let p2 = parseInt(pointskill[0].pointSkill2)
                  const html = ` 
                              <div class="quadrant q1 ${p >= 1 ? 'primary' : 'gray'}"></div>
                              <div class="quadrant q2 ${p >= 2 ? 'primary' : 'gray'}"></div>
                              <div class="quadrant q3 ${p >= 3 ? 'primary' : 'gray'}"></div>
                              <div class="quadrant q4 ${p >= 4 ? 'primary' : 'gray'}"></div>
                              `
                  const html2 = `
                              <div class="quadrant q1 ${p2 >= 1 ? 'success' : 'gray'}"></div>
                              <div class="quadrant q2 ${p2 >= 2 ? 'success' : 'gray'}"></div>
                              <div class="quadrant q3 ${p2 >= 3 ? 'success' : 'gray'}"></div>
                              <div class="quadrant q4 ${p2 >= 4 ? 'success' : 'gray'}"></div>
                  `
                  $('#pointskill1-1').html(html)
                  $('#pointskill1-2').html(html2)

                  $('#empname2').text(pointskill[1].empName)
                  $('#empnik2').text(pointskill[1].empNik)
                  $("#imageName2").attr("src", pointskill[1].encrypt_url)
                  let p21 = parseInt(pointskill[1].pointSkill)
                  let p22 = parseInt(pointskill[1].pointSkill2)
                  const html21 = ` 
                              <div class="quadrant q1 ${p21 >= 1 ? 'primary' : 'gray'}"></div>
                              <div class="quadrant q2 ${p21 >= 2 ? 'primary' : 'gray'}"></div>
                              <div class="quadrant q3 ${p21 >= 3 ? 'primary' : 'gray'}"></div>
                              <div class="quadrant q4 ${p21 >= 4 ? 'primary' : 'gray'}"></div>
                              `
                  const html22 = `
                              <div class="quadrant q1 ${p22 >= 1 ? 'success' : 'gray'}"></div>
                              <div class="quadrant q2 ${p22 >= 2 ? 'success' : 'gray'}"></div>
                              <div class="quadrant q3 ${p22 >= 3 ? 'success' : 'gray'}"></div>
                              <div class="quadrant q4 ${p22 >= 4 ? 'success' : 'gray'}"></div>
                  `
                  $('#pointskill2-1').html(html21)
                  $('#pointskill2-2').html(html22)
                } else {
                  $('#empname1').text('-')
                  $('#empnik1').text('-')
                  $("#imageName1").attr("src", '<?= asset_v('image/no-image.png')?>')
                  $('#empname2').text('-')
                  $('#empnik2').text('-')
                  $("#imageName2").attr("src", '<?= asset_v('image/no-image.png')?>')
                  const html = ` 
                              <div class="quadrant q1 gray"></div>
                              <div class="quadrant q2 gray"></div>
                              <div class="quadrant q3 gray"></div>
                              <div class="quadrant q4 gray"></div>
                              `
                  const html2 = `
                              <div class="quadrant q1 gray"></div>
                              <div class="quadrant q2 gray"></div>
                              <div class="quadrant q3 gray"></div>
                              <div class="quadrant q4 gray"></div>
                  `
                  $('#pointskill1-1').html(html)
                  $('#pointskill1-2').html(html2)
                  const html21 = ` 
                              <div class="quadrant q1 gray"></div>
                              <div class="quadrant q2 gray"></div>
                              <div class="quadrant q3 gray"></div>
                              <div class="quadrant q4 gray"></div>
                              `
                  const html22 = `
                              <div class="quadrant q1 gray"></div>
                              <div class="quadrant q2 gray"></div>
                              <div class="quadrant q3 gray"></div>
                              <div class="quadrant q4 gray"></div>
                  `
                  $('#pointskill2-1').html(html21)
                  $('#pointskill2-2').html(html22)
                }
            }
        });
    }

    loadData(laneSelect.value);

    laneSelect.addEventListener("change", function(){
        loadData(this.value);
    });
    
    const socket = io("<?= env('APP_NODE_SERVER')?>");
    socket.emit("join-lane", laneSelect.value);

    laneSelect.addEventListener("change", function(){
        socket.emit("join-lane", this.value);
    });
    socket.on("cos-update", function(data) {
        if(data.laneId == laneSelect.value){
            document.getElementById("noMcLane").innerText = data.noMcLane;
            document.getElementById("date").innerText = data.date;
            document.getElementById("typeModel").innerText = data.typeModel;
            document.getElementById("zeroClaim").innerText = data.zeroClaim;
            document.getElementById("lastClaim").innerText = data.lasClaim;
        }
    });
    socket.on("layout-update", function(data){
      if(data.laneId == laneSelect.value){
        document.getElementById("image-layout").src = data.encrypt_url
      }
    })
    socket.on("fourm-update", function(data){
      if(data.laneId == laneSelect.value){
        if(data.man == '1'){
          $('#man-a').prop('checked', true);
          $('#man-ta').prop('checked', false);
        } else {
          $('#man-a').prop('checked', false);
          $('#man-ta').prop('checked', true);
        }
        if(data.machine == '1'){
          $('#machine-a').prop('checked', true);
          $('#machine-ta').prop('checked', false);
        } else {
          $('#machine-a').prop('checked', false);
          $('#machine-ta').prop('checked', true);
        }
        if(data.material == '1'){
          $('#material-a').prop('checked', true);
          $('#material-ta').prop('checked', false);
        } else {
          $('#material-a').prop('checked', false);
          $('#material-ta').prop('checked', true);
        }
        if(data.methode == '1'){
          $('#methode-a').prop('checked', true);
          $('#methode-ta').prop('checked', false);
        } else {
          $('#methode-a').prop('checked', false);
          $('#methode-ta').prop('checked', true);
        }
      }
    })
    socket.on("pointskill-update", function(data){
      if(data.laneId == laneSelect.value){
        if(data){
            $('#empname1').text(data[0].empName)
            $('#empnik1').text(data[0].empNik)
            $("#imageName1").attr("src", data[0].encrypt_url)
            let p = parseInt(data[0].pointSkill)
            let p2 = parseInt(data[0].pointSkill2)
            const html = ` 
                        <div class="quadrant q1 ${p >= 1 ? 'primary' : 'gray'}"></div>
                        <div class="quadrant q2 ${p >= 2 ? 'primary' : 'gray'}"></div>
                        <div class="quadrant q3 ${p >= 3 ? 'primary' : 'gray'}"></div>
                        <div class="quadrant q4 ${p >= 4 ? 'primary' : 'gray'}"></div>
                        `
            const html2 = `
                        <div class="quadrant q1 ${p2 >= 1 ? 'success' : 'gray'}"></div>
                        <div class="quadrant q2 ${p2 >= 2 ? 'success' : 'gray'}"></div>
                        <div class="quadrant q3 ${p2 >= 3 ? 'success' : 'gray'}"></div>
                        <div class="quadrant q4 ${p2 >= 4 ? 'success' : 'gray'}"></div>
            `
            $('#pointskill1-1').html(html)
            $('#pointskill1-2').html(html2)

            $('#empname2').text(data[1].empName)
            $('#empnik2').text(data[1].empNik)
            $("#imageName2").attr("src", data[1].encrypt_url)
            let p21 = parseInt(data[1].pointSkill)
            let p22 = parseInt(data[1].pointSkill2)
            const html21 = ` 
                        <div class="quadrant q1 ${p21 >= 1 ? 'primary' : 'gray'}"></div>
                        <div class="quadrant q2 ${p21 >= 2 ? 'primary' : 'gray'}"></div>
                        <div class="quadrant q3 ${p21 >= 3 ? 'primary' : 'gray'}"></div>
                        <div class="quadrant q4 ${p21 >= 4 ? 'primary' : 'gray'}"></div>
                        `
            const html22 = `
                        <div class="quadrant q1 ${p22 >= 1 ? 'success' : 'gray'}"></div>
                        <div class="quadrant q2 ${p22 >= 2 ? 'success' : 'gray'}"></div>
                        <div class="quadrant q3 ${p22 >= 3 ? 'success' : 'gray'}"></div>
                        <div class="quadrant q4 ${p22 >= 4 ? 'success' : 'gray'}"></div>
            `
            $('#pointskill2-1').html(html21)
            $('#pointskill2-2').html(html22)
          } else {
            $('#empname1').text('-')
            $('#empnik1').text('-')
            $("#imageName1").attr("src", '<?= asset_v('image/no-image.png')?>')
            $('#empname2').text('-')
            $('#empnik2').text('-')
            $("#imageName2").attr("src", '<?= asset_v('image/no-image.png')?>')
            const html = ` 
                        <div class="quadrant q1 gray"></div>
                        <div class="quadrant q2 gray"></div>
                        <div class="quadrant q3 gray"></div>
                        <div class="quadrant q4 gray"></div>
                        `
            const html2 = `
                        <div class="quadrant q1 gray"></div>
                        <div class="quadrant q2 gray"></div>
                        <div class="quadrant q3 gray"></div>
                        <div class="quadrant q4 gray"></div>
            `
            $('#pointskill1-1').html(html)
            $('#pointskill1-2').html(html2)
            const html21 = ` 
                        <div class="quadrant q1 gray"></div>
                        <div class="quadrant q2 gray"></div>
                        <div class="quadrant q3 gray"></div>
                        <div class="quadrant q4 gray"></div>
                        `
            const html22 = `
                        <div class="quadrant q1 gray"></div>
                        <div class="quadrant q2 gray"></div>
                        <div class="quadrant q3 gray"></div>
                        <div class="quadrant q4 gray"></div>
            `
            $('#pointskill2-1').html(html21)
            $('#pointskill2-2').html(html22)
          }
      }
    })
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
