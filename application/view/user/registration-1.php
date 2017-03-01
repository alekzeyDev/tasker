<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Регистрация: шаг 1</h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="/register/1">
                        <fieldset>
                            <div class="form-group<?php if(isset($this->errors['login'])): ?> has-error<?php endif; ?>">
                                <input type="text" name="login" class="form-control" value="<?php echo $this->login ?>" placeholder="Логин" required
                                       autofocus>
                            </div>
                            <div class="form-group<?php if(isset($this->errors['email'])): ?> has-error<?php endif; ?>">
                                <input type="email" name="email" value="<?php echo $this->email ?>" class="form-control" placeholder="Email"
                                       required>
                            </div>
                            <div class="form-group<?php if(isset($this->errors['fio'])): ?> has-error<?php endif; ?>">
                                <input type="text" name="fio" value="<?php echo $this->fio ?>" class="form-control" placeholder="ФИО"
                                       required>
                            </div>
                            <div class="form-group<?php if(isset($this->errors['password'])): ?> has-error<?php endif; ?>">
                                <input type="password" name="password" value="<?php echo $this->password ?>" class="form-control" placeholder="Пароль"
                                       required>
                            </div>
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Далее >">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
