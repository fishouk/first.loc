<form method="post" action="/index/auth/?au=<?=rand(250000,353000)?>">
          
          <label for="login">Логин:</label><br>
          <input type="text" name="login" id="login" placeholder="Логин"/><br>
          
          <label for="password">Пароль:</label><br>
          <input type="password" name="password" id="password" placeholder="Пароль"/><br>
          
          <input type="submit" name="but" value="Авторизация"/>
        </form>