<h1> Редактирование цитаты </h1>

<form action="/admin/quote/save" method="post">
    Заголовок <br>
    <textarea name="quote" cols="100" rows="2"><?php echo $this->quote->quote; ?></textarea>
    <br>
    Текст  <br>
    <textarea name="content" cols="100" rows="15"><?php echo $this->quote->content; ?></textarea>
    <br>
    <button type="submit" name="id" value="<?php echo $this->quote->getId(); ?>">
        Сохранить
    </button>
</form>