<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tu cuenta</title>

</head>

<body id="page-top">

    <?php include('nav.php');?>

    <header>        
        <div class="header-content">
            <div class="header-content-inner">  
                <h3>Usuario:  <?php echo $this->session->userdata('username') ?> </h3>

                <h3>Número de Teléfono: <?= $usuario->phone?> </h3>
                <?php if ( ! $usuario->active) : ?>
                    <button data-toggle="modal" data-target="#modalTelefono" class="btn btn-primary btn-xl page-scroll">Cambiar número</button>
                <?php else : ?>
                    <h3>No se puede cambiar el número de teléfono mientras se está de alta</h3>
                <?php endif; ?>

                <h3>Servicios</h3>
                <?php if ($usuario->active) : ?>                    
                    <button data-toggle="modal" data-target="#modalBaja" class="btn btn-primary btn-xl page-scroll">Darse de Baja</button>
                <?php else : ?>
                    <button data-toggle="modal" data-target="#modalAlta" class="btn btn-primary btn-xl page-scroll">Darse de Alta</button>
                <?php endif; ?>
                <?php echo (isset($error_alta)) ? '<h3>Error en el alta</h3>' : '';?>
                <?php echo (isset($error_alta_founds)) ? '<h3>Error en el alta. No tienes fondos disponibles</h3>' : '';?>
            </div>
        </div>

    </header>

    <!-- Modals -->
    <!-- Modal Alta -->
    <div id="modalAlta" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Darse de Alta</h4>
                </div>
                <div class="modal-body">
                    <p>Al aceptar darse de alta, se van a consumir 2 de saldo.</p>
                </div>
                <div class="modal-footer">
                    <a href="<?=base_url()?>web_service/alta_usuario" class="btn btn-primary btn-xl page-scroll">Darse de Alta</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Baja -->
    <div id="modalBaja" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Darse de Baja</h4>
                </div>
                <div class="modal-body">
                    <p>¿Seguro que desea darse de baja?</p>
                </div>
                <div class="modal-footer">
                    <a href="<?=base_url()?>operaciones/baja" class="btn btn-primary btn-xl page-scroll">Darse de Baja</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Teléfono -->
    <div id="modalTelefono" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cambiar el número de teléfono</h4>
                </div>
                <div class="modal-body">
                    <?=form_open(base_url().'operaciones/cambiar_telefono/')?> <!-- Open an input to register an user  -->                    
                    <p><?= form_input('telefono', '', 'style="color:black;" placeholder="Nº del Teléfono"') ?></p>
                </div>
                <div class="modal-footer">
                    <?=form_submit('submit', 'Cambiar', 'class="btn btn-primary btn-xl page-scroll"')?> <!-- Submit the form -->
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?=base_url()?>assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?=base_url()?>assets/js/jquery.easing.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.fittext.js"></script>
    <script src="<?=base_url()?>assets/js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url()?>assets/js/creative.js"></script>

</body>

</html>
