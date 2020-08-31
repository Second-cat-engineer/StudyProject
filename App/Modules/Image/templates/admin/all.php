<h1>
    <a href="/admin/index/index"> Админ панель </a>
</h1>
<h1> Галлерея изображений </h1>
<table>
    <tr>
        <td> id </td>
        <td> Заголовок </td>
        <td> Текст </td>
        <td> Изображение </td>
        <td> Редактировать описание </td>
        <td> Удалить </td>
        <td> Посмотреть комментарии к данной статье</td>
    </tr>
    <?php foreach ($this->images as $image) { ?>
        <tr>
            <td><?php echo $image->getId(); ?></td>
            <td><?php echo $image->title; ?></td>
            <td><?php echo $image->content; ?></td>
            <td><img src="/src/images/<?php echo $image->path; ?>" style = "width: 100px"></td>
            <td>
                <form action= "/admin/image/edit" method= "post" >
                    <button name="id" value="<?php echo $image->getId() ?>">
                        Редактировать
                    </button>
                </form>
            </td>
            <td>
                <form action= "/admin/image/delete" method= "post" >
                    <button name="id" value="<?php echo $image->getId() ?>">
                        Удалить
                    </button>
                </form>
            </td>
            <td>
                <form action= "/admin/comment/allOfRecord" method= "post" >
                    <input type="hidden" name="modelName" value="image">
                    <button name="recordId" value="<?php echo $image->getId() ?>">
                        Комментарии
                    </button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>
<a href="/admin/image/add"> Добавить новое изображение </a>

<hr>
<h4>
    <a href="/"> Выход из админ панели </a>
</h4>
