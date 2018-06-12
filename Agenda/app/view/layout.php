<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Contactos MVC</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
        <link rel="stylesheet" type="text/css" href="<?php echo self::$base_url ?>css/style.css">
    </head>
    <body>
        <header>
            <h1>Agenda de Contactos</h1>
        </header>
        <div class="menu">
            <a href="<?php echo self::$base_url."listar"; ?>">Lista de contactos</a>
            <a href="<?php echo self::$base_url."insertar"; ?>">Añadir contacto</a>
            <a href="<?php echo self::$base_url."buscar"; ?>">Buscar por nombre</a>
        </div>
        <div class="content">
            <?php echo $contenido; ?>
        </div>
        <footer>
            <div align="center">Diseño y Programación Web • Laura Marimón Torres &COPY; LaMaTo 2018</div>
        </footer>
    </body>
</html>