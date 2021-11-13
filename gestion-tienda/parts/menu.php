<html>
	<head>
		<title>Menu Desplegable</title>
		<link rel = "stylesheet" type = "text/css" href = <?=PATH."css/style.css"?>>
	</head>
	<body>
		<div id="header">
			<nav> <!-- Aqui estamos iniciando la nueva etiqueta nav -->
				<ul class="nav">
					<li><a href=<?=PATH."index.php"?>>Inicio</a></li>
					<li><a href=<?=PATH."productos/producto.php"?>>Productos</a>
						<ul>
							<li><a href=<?=PATH."productos/crear.php"?>>Crear</a></li>
							<li><a href=<?=PATH."productos/listar.php"?>>Listar</a></li>
                            <li><a href="">Stock</a></li>
						</ul>
					</li>
					<li><a href=<?=PATH."familias/familia.php"?>>Familias</a>
						<ul>
							<li><a href=<?=PATH."familias/crear.php"?>>Crear</a></li>
							<li><a href="">Listar</a></li>
 
						</ul>
					</li>
					<li><a href=<?=PATH."tiendas/tienda.php"?>>Tiendas</a>
						<ul>
							<li><a href=<?=PATH."tiendas/crear.php"?>>Crear</a></li>
							<li><a href="">Listar</a></li>
                            <li><a href="">Stock</a></li>
						</ul>
					</li>                                        
					<li><a href="">Acerca de</a>
					</li>

				</ul>
			</nav><!-- Aqui estamos cerrando la nueva etiqueta nav -->
		</div>
	</body>
</html>
<br><br><br>