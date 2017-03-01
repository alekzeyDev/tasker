<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Регистрация: шаг 2</h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="/register/2">
                        <fieldset>
                            <div class="form-group<?php if(isset($this->errors['country'])): ?> has-error<?php endif; ?>">
                                <input type="text" name="country" value="<?php echo $this->country ?>" class="form-control" placeholder="Страна" required
                                       autofocus>
                            </div>
                            <div class="form-group<?php if(isset($this->errors['city'])): ?> has-error<?php endif; ?>">
                                <input type="text" name="city" value="<?php echo $this->city ?>" class="form-control" placeholder="Город"
                                       required>
                            </div>
                            <div class="form-group<?php if(isset($this->errors['phone'])): ?> has-error<?php endif; ?>">
                                <input type="text" name="phone"  value="<?php echo $this->phone ?>" class="form-control" placeholder="Номер телефона"
                                       required>
                            </div>
                            <div class="form-group">
                                <a href="/register/1" class="btn btn-lg btn-success ">< Назад</a>
                                <input type="submit" class="btn btn-lg btn-success pull-right" value="Далее >">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
