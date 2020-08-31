<h1> Редактирование статьи </h1>

<form action="/admin/article/save" method="post">
    Заголовок статьи <br>
    <textarea name="title" cols="100" rows="2"><?php echo $this->article->title; ?></textarea>
    <br>
    Рубрика статьи:
    <select name="heading_id">
        <?php
        foreach ($this->headings as $heading) { ?>
            <option value="<?php echo $heading->getId(); ?>">
                <?php echo $heading->heading; ?>
            </option>
        <?php
        }
        ?>
    </select>
    <br>
    Текст статьи <br>
    <textarea name="content" cols="100" rows="30"><?php echo $this->article->content; ?></textarea>
    <br>
    <button type="submit" name="id" value="<?php echo $this->article->getId(); ?>">
        Сохранить
    </button>
</form>