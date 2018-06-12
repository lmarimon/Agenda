<?php ob_start(); ?>

<h2>Búsqueda por nombre</h2>
<form action='resultado' method='post'>
  <input type='text' name='find_name' placeholder='Nombre'><br />
  <input type='image' src="<?php echo self::$base_url ?>img/find.png" alt="Buscar" title="Buscar contacto" class="btn">
</form>

<?php $contenido = ob_get_clean(); ?>

<?php include 'layout.php' ?>