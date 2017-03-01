<style>
    #prewImage img {
        max-width: 320px;
        max-height: 240px;
        border-radius: 6px;
    }
</style>
<?php 
//        print_r($this->sort);exit; ?>
<div id="wrapper">
    <div class="row">
        <div class="col-lg-3">
            <h1 class="page-header"><?= $this->h1 ?></h1> 
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div>
                    <input type="text" class="form-control" value="<?=$this->sort['filterText']?>" id="filterText" placeholder="Поиск ...">
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary <?=$this->sort['filterStatus'] == 'new' ? 'active' : ''?>">
                    <input type="radio" name="filterStatus" class="filterStatus" value="new" autocomplete="off" <?=$this->sort['filterStatus'] == 'new' ? 'checked' : ''?>>Активные
                </label>
                <label class="btn btn-primary <?=$this->sort['filterStatus'] == 'success' ? 'active' : ''?>">
                    <input type="radio" name="filterStatus" class="filterStatus" value="success" autocomplete="off" <?=$this->sort['filterStatus'] == 'success' ? 'checked' : ''?>>Выполненные
                </label>
                <label class="btn btn-primary <?=$this->sort['filterStatus'] == 'all' || empty($this->sort['filterStatus']) ? 'active' : ''?>">
                    <input type="radio" name="filterStatus" class="filterStatus" value="all" autocomplete="off" <?=$this->sort['filterStatus'] == 'all' || empty($this->sort['filterStatus']) ? 'checked' : ''?>>Все
                </label>
            </div>
        </div>
        <div class="col-lg-1">
            <h4>Сортировка:</h4>
        </div>
        <div class="col-lg-3">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary <?=$this->sort['sortName'] == 'id' ? 'active' : ''?>">
                    <input type="radio" name="sortName" class="sortName" value="id" autocomplete="off" <?=$this->sort['sortName'] == 'id' ? 'checked' : ''?>>ID
                </label>
                <label class="btn btn-primary <?=$this->sort['sortName'] == 'author' ? 'active' : ''?>">
                    <input type="radio" name="sortName" class="sortName" value="author" autocomplete="off" <?=$this->sort['sortName'] == 'author' ? 'checked' : ''?>>Имя
                </label>
                <label class="btn btn-primary <?=$this->sort['sortName'] == 'email' ? 'active' : ''?>">
                    <input type="radio" name="sortName" class="sortName" value="email" autocomplete="off" <?=$this->sort['sortName'] == 'email' ? 'checked' : ''?>>Email
                </label>
            </div>

            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary <?=$this->sort['sort'] == 'asc' ? 'active' : ''?>">
                    <input type="radio" name="sort" class="sort" value="asc" autocomplete="off" <?=$this->sort['sort'] == 'asc' ? 'checked' : ''?>><i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                </label>
                <label class="btn btn-primary <?=$this->sort['sort'] == 'desc' ? 'active' : ''?>">
                    <input type="radio" name="sort" class="sort" value="desc" autocomplete="off" <?=$this->sort['sort'] == 'desc' ? 'checked' : ''?>><i class="fa fa-sort-amount-desc" aria-hidden="true"></i>
                </label>
            </div>

        </div>

        <div class="col-lg-12">

            <div id="preview" class="collapse">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="image-task col-lg-4 col-md-5 col-sm-6" id="prewImage">
                                <img src="http://placehold.it/320x240" alt="" class="img-rounded img-responsive"/>
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-6">
                                <h3>Автор:&nbsp;<span id="prewAuthor">...</span>&nbsp;<span class="label label-default" id="prewEmail">...</span></h3>
                                <hr>
                                <div><span style="word-wrap: break-word;" id="prewText">...</span></div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="panel panel-info">
                <div class="panel-body">
                    <a class="btn btn-success" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Новая задача
                    </a>
                    <div class="collapse<?= $this->errors ? ' in' : '' ?>" id="collapseExample">
                        <br>
                        <?php
                        echo $this->partial('/task/form', [
                            'author' => $this->author,
                            'email' => $this->email,
                            'text' => $this->text,
                            'errors' => $this->errors,
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <hr>
    <div id="page-content">
        <ul class="list-group">
            <?php
            $models = $this->models;
            foreach ($models as $key => $task):
                $imgFile = 'uploads\\' . $task->id . '.jpg';
                ?>
                <li class="list-group-item">
                    <div class="row">
                        <div class="image-task col-lg-4 col-md-5 col-sm-6">
                            <img
                                src="<?php
                                if (is_file($imgFile)): echo $imgFile;
                                else : echo 'http://placehold.it/320x240';
                                endif;
                                ?>"
                                alt=""
                                class="img-rounded img-responsive"/>
                        </div>
                        <div class="<?= $this->user ? 'col-lg-6 col-md-5 col-sm-4' : 'col-lg-8 col-md-7 col-sm-6' ?>">
                            <h3>Автор:&nbsp;<?= $task->author ?>&nbsp;<span class="label label-default"><?= $task->email ?></span></h3>
                            <hr>
                            <div><span style="word-wrap: break-word;" id="taskText<?= $task->id ?>"><?= $task->text ?></span></div>
                        </div>
                        <?php if ($this->user) { ?>
                            <div class="col-sm-2">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#editText<?= $task->id ?>">
                                    Редактировать
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="editText<?= $task->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Редактирование описания задачи</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group<?php if (isset($this->errors['text'])): ?> has-error<?php endif; ?>">
                                                    <label>Описание задачи</label>
                                                    <textarea  type="text" name="text" id="text<?= $task->id ?>" class="form-control"
                                                               rows="3" required><?= $task->text ?></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                <button type="button" class="btn btn-primary editText" id="<?= $task->id ?>">Сохранить изменения</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="row">&nbsp;&nbsp;&nbsp;
                                <label class="checkbox-inline">
                                    &nbsp;&nbsp;
                                    <input type="checkbox" class="checkbox style-0 successTask" id="<?= $task->id ?>" <?php
                                    if ($task->status != 'new') {
                                        echo 'checked';
                                    }
                                    ?> >
                                    <span>Выполнено</span>
                                </label>
                            </div>
                        <?php } ?>
                    </div>

                </li>

                <?php
            endforeach;
            ?>
        </ul>

    </div>
    <div id="pagination-selection"></div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<script src="/js/jquery.bootpag.min.js"></script>
<script>

    $('#pagination-selection').bootpag({
        total: <?= $this->countPages ?>,
        page: <?= $this->taskListPage ?>,
        maxVisible: 5,
        leaps: true,
        firstLastUse: true,
        first: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
        last: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
        prev: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        wrapClass: 'pagination',
        activeClass: 'active',
        disabledClass: 'disabled',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first'
    }).on("page", function (event, num) {
        $.ajax({
            type: "POST",
            url: "/next",
            data: {page: num}
        }).done(function (msg) {
            if (msg) {
                window.scrollTo(800, 250);

                location.reload();
            }
        });
    });
</script>
<script>

    $('.editText').click(function ()
    {
        var id = $(this).attr('id');
        var text = $('#text' + id).val();
        $.ajax({
            method: "POST",
            url: "/save-text",
            data: {id: id, text: text}
        })
                .done(function (msg) {

                    if (msg == '1') {
                        $('#taskText' + id).html(text);
                        $('#editText' + id).modal('hide');
                    }
                    if (msg == '2') {
                        alert('При сохранении произошла ошибка.');
                    }
                });
    });


</script>
<script>

    $('.successTask').click(function ()
    {
        var id = $(this).attr('id');
        $.ajax({
            method: "POST",
            url: "/success-task",
            data: {id: id}
        })
                .done(function (msg) {

                    if (msg == 'new') {
                        $(this).prop('checked', false);
                    }
                    if (msg == 'success') {
                        $(this).prop('checked', true);
                    }
                });
    });
    $('#sort-select').change(function ()
    {
        var sort = $(this).val();
        $.ajax({
            method: "POST",
            url: "/change-sort",
            data: {sort: sort}
        })
                .done(function (msg) {

                    if (msg) {
                        location.reload();
                    }
                });
    });
    $('#filterText').change(function ()
    {
        text = $('#filterText').val();
//        if (text.length > 2) {
            $.ajax({
                method: "POST",
                url: "/change-sort",
                data: {filterText: text}
            })
                    .done(function (msg) {
                        if (msg) {
                            location.reload();
                        }
                    });
//        }
    });
    $('.filterStatus').change(function ()
    {
        status = $(this).val();
            $.ajax({
                method: "POST",
                url: "/change-sort",
                data: {filterStatus: status}
            })
                    .done(function (msg) {
                        if (msg) {
                            location.reload();
                        }
                    });
    });
    $('.sortName').change(function ()
    {
        sortName = $(this).val();
            $.ajax({
                method: "POST",
                url: "/change-sort",
                data: {sortName: sortName}
            })
                    .done(function (msg) {
                        if (msg) {
                            location.reload();
                        }
                    });
    });
    $('.sort').change(function ()
    {
        sort = $(this).val();
            $.ajax({
                method: "POST",
                url: "/change-sort",
                data: {sort: sort}
            })
                    .done(function (msg) {
                        if (msg) {
                            location.reload();
                        }
                    });
    });


</script>