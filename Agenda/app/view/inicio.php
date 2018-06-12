<?php ob_start(); ?>

<h2>Inicio</h2>
<h4>Fecha: <?php echo $params['fecha']; ?></h4>
<h3><?php echo $params['mensaje']; ?></h3>

<?php $contenido = ob_get_clean(); ?>

<?php include 'layout.php' ?>