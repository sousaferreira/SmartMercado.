<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login</title>
	<link rel="shortcut icon" href="<?= BASE_URL; ?>Assets/img/favicon.png" />
	<link rel="icon" href="<?= BASE_URL; ?>Assets/img/favicon.png" type="image/x-icon" />
	<link rel="stylesheet" href="<?= BASE_URL; ?>Assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= BASE_URL; ?>Assets/css/signin.css">
	<?php if (isset($viewData['CSS'])) {
		echo $viewData['CSS'];
	}; ?>
</head>

<body class="text-center">
	<main class="form-signin">
		<form method="post" action="<?= BASE_URL . 'LoginOperador'?>">
			<img class="mb-3 img-fluid" src="<?= BASE_URL . 'Assets/img/funcionarios.png'; ?>" alt="IMG">

			<div class="form-floating">
				<input type="text" name="operador" class="form-control" id="floatingInput" placeholder="nome@operador.com" <?= (isset($viewData["operador"]) && !empty($viewData["operador"])) ? "value='" . $viewData["operador"] . "'" : ""; ?>>
				<label for="floatingInput">Operador</label>
			</div>
			<div class="form-floating">
				<input type="password" name="passwd" class="form-control" id="floatingPassword" placeholder="Password">
				<label for="floatingPassword">Senha</label>
			</div>

			
			<button class="w-100 btn btn-lg btn-danger mb-3" type="submit">Abrir caixa</button>
			


			<p class="mt-5 mb-3 text-muted">Desenvolvimento &copy; 2025</p>
		</form>
	</main>

</body>

</html>