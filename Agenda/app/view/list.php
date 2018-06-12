<?php ob_start(); ?>

<h2>Listado de Contactos</h2>
<table>
  <thead>
    <th>Nombre</th>
    <th>Dirección</th>
    <th>Teléfono</th>
    <th></th>
  </thead>
  <tbody><?php echo $tablaContactos; ?></tbody>
</table>

<?php $contenido = ob_get_clean(); ?>

<?php include 'layout.php' ?>