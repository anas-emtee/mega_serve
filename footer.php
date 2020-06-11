<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END PAGE CONTAINER-->

<!-- modal large -->
<div class="modal fade" id="QRCodeModal" tabindex="-1" role="dialog" aria-labelledby="QRCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">QRCode Scanner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input style="display:none;" type="file" id="qr_uploaded" accept="image/*;capture=camera" />

                <div class="row form-group">
                    <div class="col col-md-12">
                        <label for="nf-password" class=" form-control-label">Scan QR Code</label>
                        <div class="input-group">
                            <input type="text" id="awbno" name="awbno" placeholder="QR Content" class="form-control">
                            <div class="input-group-btn">
                                <button id="upload_qr" type="button" class="btn btn-primary"><i class="fa fa-qrcode"></i></button>
                            </div>
                        </div>
                        <span class="help" id="help"></span>
                    </div>
                </div>
                <div class="row" id="afterUpload" style="display: nones;">
                    <div class="col col-md-12">
                        <div class="row">
                            <div class="col col-md-6">
                                <img id="img" class="img-responsive" src="images/qr_sample.png" style="border: 1px solid gray">
                            </div>
                            <div class="col col-md-6">
                                <div class="form-group">
                                    <!--<label>QR Content:</label>-->
                                    <textarea rows="6" class="form-control" id="result"> QR Content / Error </textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" id="decodeButton">Decode</button>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal large -->
<script type="text/javascript">
    $(function(){
        $("#upload_qr").on('click', function(e){
            e.preventDefault();
            $("#qr_uploaded:hidden").trigger('click');
        });
    });
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#img').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#qr_uploaded").change(function() {
        readURL(this);
    });
</script>

<!-- modal large -->
<div class="modal fade" id="BarCodeModal" tabindex="-1" role="dialog" aria-labelledby="BarCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">BarCode Scanner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="controls" style="display: none;">
                    <fieldset class="input-group">
                        <input type="file" id="upload" accept="image/*;capture=camera" />
                        <button type="button" class="btn">Rerun</button>
                    </fieldset>
                    <fieldset class="reader-config-group">
                        <label>
                            <span>Barcode-Type</span>
                            <select name="decoder_readers">
                                <option value="code_128" selected="selected">Code 128</option>
                                <option value="code_39">Code 39</option>
                                <option value="code_39_vin">Code 39 VIN</option>
                                <option value="ean">EAN</option>
                                <option value="ean_extended">EAN-extended</option>
                                <option value="ean_8">EAN-8</option>
                                <option value="upc">UPC</option>
                                <option value="upc_e">UPC-E</option>
                                <option value="codabar">Codabar</option>
                                <option value="i2of5">Interleaved 2 of 5</option>
                                <option value="2of5">Standard 2 of 5</option>
                                <option value="code_93">Code 93</option>
                            </select>
                        </label>
                        <label>
                            <span>Resolution (long side)</span>
                            <select name="input-stream_size">
                                <option value="320">320px</option>
                                <option value="640">640px</option>
                                <option selected="selected" value="800">800px</option>
                                <option value="1280">1280px</option>
                                <option value="1600">1600px</option>
                                <option value="1920">1920px</option>
                            </select>
                        </label>
                        <label>
                            <span>Patch-Size</span>
                            <select name="locator_patch-size">
                                <option value="x-small">x-small</option>
                                <option value="small">small</option>
                                <option value="medium">medium</option>
                                <option selected="selected" value="large">large</option>
                                <option value="x-large">x-large</option>
                            </select>
                        </label>
                        <label>
                            <span>Half-Sample</span>
                            <input type="checkbox" name="locator_half-sample" />
                        </label>
                        <label>
                            <span>Single Channel</span>
                            <input type="checkbox" name="input-stream_single-channel" />
                        </label>
                        <label>
                            <span>Workers</span>
                            <select name="numOfWorkers">
                                <option value="0">0</option>
                                <option selected="selected" value="1">1</option>
                            </select>
                        </label>
                    </fieldset>
                </div>
                <div id="result_strip" style="display: none;">
                    <ul class="thumbnails"></ul>
                </div>
                <div id="interactive" class="viewport" style="display: none;"></div>
                <div id="debug" class="detection" style="display: none;"></div>

                <div class="row form-group">
                    <div class="col col-md-12">
                        <label for="nf-password" class=" form-control-label">Scan AWB Barcode</label>
                        <div class="input-group">
                            <input type="text" id="awbno" name="awbno" placeholder="AWB No." class="form-control">
                            <div class="input-group-btn">
                                <button id="upload_bar" type="button" class="btn btn-primary"><i class="fa fa-barcode"></i></button>
                            </div>
                        </div>
                        <span class="help" id="help"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $("#upload_bar").on('click', function(e){
            e.preventDefault();
            $("#upload:hidden").trigger('click');
        });
    });
</script>
<script src="quagga/quagga.js" type="text/javascript"></script>
<script src="quagga/file_input.js" type="text/javascript"></script>
<!-- end modal large -->

<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
<script type="text/javascript">
    window.addEventListener('load', function () {
        const codeReader = new ZXing.BrowserQRCodeReader()
        console.log('ZXing code reader initialized')
        document.getElementById('decodeButton').addEventListener('click', () => {
            const img = document.getElementById('img')
            codeReader.decodeFromImage(img).then((result) => {
                console.log(result)
                document.getElementById('result').textContent = result.text
            }).catch((err) => {
                console.error(err)
                document.getElementById('result').textContent = "Error Reading QR: "+err
            })
            console.log(`Started decode for image from ${img.src}`)
        })
    })
</script>