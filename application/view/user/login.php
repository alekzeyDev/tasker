<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Авторизация</h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="/login">
                        <fieldset>
                            <div class="form-group<?php if(isset($this->errors['login'])): ?> has-error<?php endif; ?>">
                                <input type="text" name="login" value="<?php echo $this->login ?>" class="form-control" placeholder="Логин" required
                                       autofocus>
                            </div>
                            <div class="form-group<?php if(isset($this->errors['password'])): ?> has-error<?php endif; ?>">
                                <input type="password" name="password" class="form-control" placeholder="Пароль"
                                       required>
                            </div>
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Войти">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
