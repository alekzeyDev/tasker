
<style>
    * {margin: 0;
       padding:0;}

    #imgPlace {
        margin-top: 20px;
        margin-left: 0px;
        margin-right: 0px;
        margin-top: 20px; }

    #imgPlace img {
        max-width: 240px;
        max-height: 160px;
        border-radius: 2px;
    }

    #imgPlace li {
        position: relative;
        max-width: 240px;
        max-height: 160px;
    }

    #imgPlace span {
        position: absolute;
        right: 0.3em;

        background: #000;
        color: #f3f1ed;
        padding: 0 0.25em;
        border-radius: 2px;
    }

    #imgPlace .remove {
        position: absolute;
        right: 0.3em;
        bottom: 0.5em;

        background: #A33B58;
        color: #f3f1ed;
        padding: 0 0.25em;
        border-radius: 2px;
        display: none;
    }
    #imgPlace li:hover .remove {
        display: block;
    }

    body {background: #f3f1ed;}

    ul {list-style: none}
</style>

<form method="post" enctype="multipart/form-data" action="/create">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-6">
            <input accept="image/*" id="fileElem" name="image"  style="display:none" type="file">
            <a href="#" id="fileSelect" class="btn btn-success btn-block">Изображение ...</a>
            <div id="imgPlace"></div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-7 col-xs-6">
            <div class="form-group<?php if (isset($this->errors['author'])): ?> has-error<?php endif; ?>">
                <label>Автор</label>
                <input type="text" name="author" class="form-control" id="author" value="<?= $this->author ?>" placeholder="..." required
                       autofocus>
            </div>
            <div class="form-group<?php if (isset($this->errors['email'])): ?> has-error<?php endif; ?>">
                <label>Email</label>
                <input type="email" name="email" id="email" value="<?= $this->email ?>" class="form-control" placeholder="..."
                       required>
            </div>
            <div class="form-group<?php if (isset($this->errors['text'])): ?> has-error<?php endif; ?>">
                <label>Описание задачи</label>
                <textarea  type="text" name="text" id="text" class="form-control"
                           rows="3" required><?= $this->text ?></textarea>
            </div>
        </div>
    </div>
    <a class="btn btn-lg btn-info btn-block" href="#preview" id="prewBtn" data-toggle="collapse" data-target="#preview">Предосмотр</a>
    <input type="submit" class="btn btn-lg btn-success btn-block" value="Сохранить">

</form>

<script>
    $(document).ready(function () {

        var fileSelect = document.getElementById("fileSelect"),
                fileElem = document.getElementById("fileElem");

        fileSelect.addEventListener("click", function (e) {
            if (fileElem) {
                fileElem.click();
            }
            e.preventDefault(); // prevent navigation to "#"
        }, false);



        $('#fileElem').change(function ()
        {
            handleFiles(this.files);
        });


        $('#prewBtn').click(function ()
        {
            var author = $("#author").val();
            var email = $("#email").val();
            var text = $("#text").val();
            $("#prewAuthor").html(author);
            $("#prewEmail").html(email);
            $("#prewText").html(text);
        });


        function handleFiles(files) {
            var list = $("<ul></ul>");
            $("#imgPlace").html(list);

            for (var i = 0, f; f = files[i]; i++) {

                var reader = new FileReader();

                reader.onload = (function (f) {
                    return function (e) {
                        var li = $("<li></li>");
                        $(list).append(li);

//                        var a = $("<a href='#'></a>");
                        var a = $("<p></p>");
                        $(li).append(a);

                        $('#prewImage').html('<img src="' + e.target.result + '"/>');
                        $(a).append("<img src='" + e.target.result + "'/>");

//                        $(a).append("<span class='name'>" + f.name + "</span>");

                        $(li).append("<a href='#remove' class='remove'>Удалить</a>");
                    };
                })(f);

                reader.readAsDataURL(f);

            }
        }
        $(document).on("click", ".remove", function (e) {
            $("#imgPlace").html('');
            $("#prewImage").html('<img src="http://placehold.it/320x240" alt="" class="img-rounded img-responsive"/>');
            $("#fileElem").val('');
        });

    });
</script>


