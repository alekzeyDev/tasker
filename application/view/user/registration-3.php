<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Регистрация: шаг 3</h3>
                </div>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data" action="/register/3">
                        <fieldset>
                            <div class="form-group<?php if(isset($this->errors['image'])): ?> has-error<?php endif; ?>">
                                <label>Аватар</label>
<!--                                <input type="file" name="image" required autofocus>-->
                                <input type="file" name="image" autofocus>
                            </div>
                            <div class="form-group<?php if(isset($this->errors['captcha'])): ?> has-error<?php endif; ?>">
                                <?php echo $this->captcha ?>
                                <input name="CaptchaCode" type="text" class="form-control" id="CaptchaCode" />
                            </div>
                            <div class="form-group">
                                <a href="/register/2" class="btn btn-lg btn-success ">< Назад</a>
                                <input type="submit" class="btn btn-lg btn-success pull-right" value="Завершить">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
