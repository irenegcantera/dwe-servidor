    <?php
        require 'checksV1.php';
        include 'header.php';
    ?>
    
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col">
                <?php echo $contactos;?>
            </div>
            <div class="col">
                <h5>Introduzca los datos</h5>
                <form style="background-color: #8080ff; padding:2em;" name="formulario" action = "" method="POST">
                    <div class="row mb-3">
                        <label for="nombre" class="form-label">Nombre</label>       
                        <div class="col-sm-10">
                            <input class="form-control" id = "nombre" name="nombre" type="text" placeholder="Irene">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <div class="col-sm-10">
                            <input class="form-control" id = "telefono" name="telefono" type="text" placeholder="123456789">
                        </div>
                    </div>
                    <input name="nombres" type="hidden" value="<?php echo implode(";",$nombreArray) ?>">
                    <input name="telefonos" type="hidden" value="<?php echo implode(";",$telfArray) ?>">

                    <input class="btn btn-primary" name="enviar" type="submit" value="Enviar">
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col"></div>
            <div class="col text-danger" id = "error">
                <?php echo $error;?>
            </div>
        </div>
    </div>

    <?php include 'footer.php';?>

