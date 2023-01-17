<!-- <!DOCTYPE html>
<html>

<head>
	<title>Acessar Livraria</title>
	<link rel="stylesheet" type="text/css" href="assets/css/styleLogin.css">
	<link rel="stylesheet" type="text/css"
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
</head>

<body>
	<div class="container">
		<div class="form sign-in-container">
			<form action="login/login.php" method="post">
				<h1>Sign in</h1>
				<div class="social-container">
					<a class="redes" href="https://rpbloggers.com/"><i class="fab fa-facebook-f"></i></a>
					<a class="redes" href="https://rpbloggers.com/"><i class="fab fa-google-plus-g"></i></a>
					<a class="redes" href="https://rpbloggers.com/"><i class="fab fa-linkedin-in"></i></a>
				</div>
				<input type="email" placeholder="User Email" name="email" required>
				<input type="password" placeholder="Password" name="senha" required>
				<a class="redes" href="https://rpbloggers.com/">Forgot your password?</a>
				<button>Sign In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-right">
					<h1>Sign UP</h1>
					<p>Sign up here if you don't have account.</p>
					<button class="signup_btn"><a class="btn" href="login/telaCadUser.php">Sign Up</a></button>
				</div>
			</div>
		</div>
	</div>
</body>

</html> -->

<div class="container_login">
    <form class="formulario" method="post" action="/login">
        <h1>Login</h1>

        <label class="label">
            <span>E-mail</span>
            <input type="email" name="email" class="campo" placeholder="Digite seu e-mail" value="bcarolyna@gmail.com" />
            <i class="icon icon-envelope"></i>
        </label>

        <label class="label">
            <span>Password</span>
            <input type="password" name="password" class="campo" placeholder="Digite sua senha" />
            <i class="icon icon-envelope"></i>
        </label>

        <!-- <label class="label">
            <span>Assunto</span>
            <input type="text" name="assunto" class="campo" placeholder="Digite um assunto" required=""/>   
        </label>
        <label class="naoexibir">
            <span>Não preencher:</span><br>
            <input type="text" name="url" value=""></p>
        </label> 
        
        <label class="label">
            <span>Mensagem</span>
            <textarea name="mensagem" class="campo" placeholder="Deixe sua mensagem" required=""></textarea>
        </label> -->

        <label class="label">

            <input type="hidden" name="acao" value="enviar">
            <button type="submit" class="botao"> Login </button>

        </label>
    </form>
</div>