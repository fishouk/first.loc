<section class="row">
      <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Войти на сайт</h3>
          </div>    
          <form method="post" action="/index/auth/?au=<?=rand(250000,353000)?>" role="form">
            <div class="panel-body">
              <!-- username -->
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input id="login" name="login" type="text" class="form-control" placeholder="Ваш логин" required autofocus />
              </div>
                          
              <!-- password -->
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input id="password" name="password" type="password" class="form-control" placeholder="Ваш логин или e-mail" required autofocus />
              </div>    
            </div>

            <div class="panel-footer clearfix">
                <input class="btn btn-labeled btn-success pull-right" type="submit" name="but" value="Авторизация" />
              </div>
          </form>
        </div>