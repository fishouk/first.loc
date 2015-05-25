<form method="post" action="/index/auth/?au=<?=rand(250000,353000)?>">
	<label for="login">Логин:</label>
		<input type="text" name="login" id="login" placeholder="Логин"/>
	<label for="password">Пароль</label>
		<input type="password" name="password" id="password" placeholder="Пароль"/>
	<input type="submit" name="but" value="Авторизация"/>
</form>