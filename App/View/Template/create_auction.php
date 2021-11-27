<div id="create_form" class="container-fluid">
    <div class="container">
        <h2 class="text-center" id="title">Web bids create page</h2>
        <hr>
        <div class="row">
            <div class="col-md-5">
                <form role="form" method="post" action="create_auction/create_auction">
                    <fieldset>
                        <p class="text-uppercase pull-center">Detaily produktu: </p>
                        <p style="color: red" id="r-error"></p>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control input-lg" placeholder="Názov produktu*" required>
                        </div>
                        <div class="form-group">
                            <input type="number" step="0.01" name="starting_price" class="form-control input-lg" placeholder="0*" required>
                        </div>
                        <div class="form-group">
                            <input type="date"  name="date_limit" class="form-control input-lg" placeholder="00:00:00*">
                        </div>
                        <div class="form-group">
                            <input type="time"  name="time_limit" class="form-control input-lg" placeholder="00:00:00*">
                        </div>
                        <div class="form-group">
                            <input type="text"  name="description" class="form-control input-lg" placeholder="Popis*" required>
                        </div>

                        <label>Typ aukcie: </label>
                        <select name="typ_aukcie">
                            <option value="0">Nabídková aukce</option>
                            <option value="1">Poptávková aukce</option>
                        </select>
                        <div>  </div>
                        <label>Pravidla aukce: </label>
                        <select name="pravidla_aukcie" >
                            <option value="0">Otvorená aukce</option>
                            <option value="1">Uzavretá aukce</option>
                        </select>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" id="agreement" class="form-check-input">
                                Súhlasím s podmienkami aukcie.
                            </label>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-lg btn-primary"  onclick="" value="SUBMIT AUCTION">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

</script>

