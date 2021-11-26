<div id="create_form" class="container-fluid">
    <div class="container">
        <h2 class="text-center" id="title">Web bids create page</h2>
        <hr>
        <div class="row">
            <div class="col-md-5">
                <form role="form" method="post" action="">
                    <fieldset>
                        <p class="text-uppercase pull-center">Detaily produktu: </p>
                        <p style="color: red" id="r-error"></p>
                        <div class="form-group">
                            <input type="nazov_produktu"  id="r-nazov_produktu" class="form-control input-lg" placeholder="Názov produktu*">
                        </div>
                        <div class="form-group">
                            <input type="starting_price"  id="r-starting_price" class="form-control input-lg" placeholder="0*">
                        </div>
                        <div class="form-group">
                            <input type="time_limit"  id="r-time_limit" class="form-control input-lg" placeholder="00:00:00*">
                        </div>
                        <div class="form-group">
                            <input type="popis"  id="r-popis" class="form-control input-lg" placeholder="Popis*">
                        </div>

                        <label>Typ aukcie: </label>
                        <select id="typ_aukcie">
                            <option value="nabidkova">Nabídková aukce</option>
                            <option value="poptavka">Poptávková aukce</option>
                        </select>
                        <div>  </div>
                        <label>Pravidla aukce: </label>
                        <select id="pravidla_aukcie">
                            <option value="otvorena">Otvorená aukce</option>
                            <option value="uzavreta">Uzavretá aukce</option>
                        </select>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" id="agreement" class="form-check-input">
                                Súhlasím s podmienkami aukcie.
                            </label>
                        </div>
                        <div>
                            <input type="button" class="btn btn-lg btn-primary"  onclick="attempt_register()" value="SUBMIT AUCTION">
                        </div>
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            Select image to upload:
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <input type="submit" value="Upload Image" name="submit">
                    </fieldset>
                </form>
            </div>


            </fieldset>
            </form>




        </div>
    </div>
</div>
</div>

<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
?>

<?php
