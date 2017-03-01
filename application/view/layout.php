<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $this->tag_title; ?></title>

        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/sb-admin.css" rel="stylesheet">
        <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="/css/custom-style.css" rel="stylesheet">
        <!--<script src="/js/jquery-1.10.2.js"></script>-->
        <script src="/js/jquery-3.1.1.min.js"></script>
    </head>
    <?php if (empty($this->noNav)): ?>
        <nav class="navbar  navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/index">
                        Задачник
                    </a>
                </div>
                <div class="collapse navbar-collapse navbar-right">
                    <?php if ($this->user) { ?>
                        <p class="navbar-brand">
                            (<?= $this->user->login ?>)
                        </p>
                        &nbsp;
                        <a class="btn btn-info navbar-btn" href="/logout"><i class="fa fa-sign-out fa-fw"></i></a>
                    <?php } else { ?>
                        <p class="navbar-brand">
                            Вход
                        </p>
                        &nbsp;
                        <a class="btn btn-info navbar-btn" href="/login"><i class="fa fa-sign-in fa-fw"></i></a>
                    <?php } ?>

                </div>


            </div>
        </nav>
    <?php endif; ?>
    <body>

        <?php echo $this->content; ?>

        <div class="clearfix"></div>

        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/custom.js"></script>

    </body>

</html>
