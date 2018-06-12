<?php ob_start(); ?>

<h2>Formulario de alta</h2>
<form action='insertDB' method='post'>
  <input type='text' name='name' placeholder='Nombre' size="50" required><br />
  <input type='text' name='dire' placeholder='Dirección' size="50"><br />
  <input type='text' name='telf' placeholder='Teléfono' size="50" minlength="9" maxlength="9" required><br />
  <input type='image' src="<?php echo self::$base_url ?>img/add.png" alt="Añadir" title="Añadir contacto" class="btn">
</form>

<?php $contenido = ob_get_clean(); ?>

<?php include 'layout.php' ?>