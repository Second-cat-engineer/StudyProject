<h1> Добавление нового изображения </h1>

<form action="/admin/image/saveNewImage" method="post" enctype="multipart/form-data">
    Заголовок <br>
    <textarea name="title" cols="100" rows="2"></textarea>
    <br>
    Описание изображения  <br>
    <textarea name="content" cols="100" rows="15"></textarea>
    <br>
    <input type = "file" name = "image">
    <hr>
    <button type="submit">
        Сохранить/Загрузить
    </button>
</form>