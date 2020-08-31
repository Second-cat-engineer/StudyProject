<h1> Редактирование описания изображения </h1>

<form action="/admin/image/saveEditImage" method="post">
    Заголовок <br>
    <textarea name="title" cols="100" rows="2"><?php echo $this->image->title; ?></textarea>
    <br>
    Описание изображения  <br>
    <textarea name="content" cols="100" rows="15"><?php echo $this->image->content; ?></textarea>
    <br>
    <button type="submit" name="id" value="<?php echo $this->image->getId(); ?>">
        Сохранить
    </button>
</form>