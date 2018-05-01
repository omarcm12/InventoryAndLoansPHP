<input type="hidden" name="utf8" value="✓" />
<input type="hidden" name="MAX_FILE_SIZE" value="8000000" />
<div class="row">
   
        <div class="form-group">
            <div class="col-md-6">
            <label>Dias de expiracion de solicitud</label>
            <input type="number" class="form-control" name="configuration[days_expired]" id="configuration_expired" value="<?= $configuration->DaysExpiredLoan() ?>" >
        </div>
        <div class="col-md-6">
            <label>Precio de multa por dia</label>
            <input type="number" class="form-control" name="configuration[days_price]" id="configuration_price" value="<?= $configuration->DaysPrice() ?>">
        </div>
        </div>
         <!-- <div class="col-md-6">
        <div class="form-group">
            <label>Precio de multa por dia</label>
            <input type="number" class="form-control" name="configuration[days_price]" id="configuration_price" value="<?= $configuration->DaysPrice() ?>">
        </div>-->
    
    </div>                            

<div class="row">
                                                       
</div>







