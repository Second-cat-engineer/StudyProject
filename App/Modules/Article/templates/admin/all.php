<h1>
    <a href="/admin/index/index"> Админ панель </a>
</h1>
<h1> Статьи </h1>
<table>
    <tr>
        <td>idArticle</td>
        <td>Заголовок статьи</td>
        <td>Текст</td>
        <td>Рубрика</td>
        <td>Автор</td>
        <td>Редактировать</td>
        <td>Удалить</td>
        <td>Посмотреть комментарии к данной статье</td>
    </tr>
    <?php foreach ($this->articles as $article) { ?>
        <tr>
            <td><?php echo $article->getId(); ?></td>
            <td><?php echo $article->title; ?></td>
            <td><?php echo mb_substr($article->content, 0, 30); ?></td>
            <td><?php echo $article->heading->heading; ?></td>
            <td><?php echo $article->author->login; ?></td>
            <td>
                <form action= "/admin/article/edit" method= "post" >
                    <button name="id" value="<?php echo $article->getId() ?>">
                        Редактировать
                    </button>
                </form>
            </td>
            <td>
                <form action= "/admin/article/delete" method= "post" >
                    <button name="id" value="<?php echo $article->getId() ?>">
                        Удалить статью
                    </button>
                </form>
            </td>
            <td>
                <form action= "/admin/comment/allOfRecord" method= "post" >
                    <input type="hidden" name="modelName" value="article">
                    <button name="recordId" value="<?php echo $article->getId() ?>">
                        Комментарии
                    </button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>
<a href="/admin/article/add"> Добавить новую статью </a>

<hr>
<h4>
    <a href="/"> Выход из админ панели </a>
</h4>
