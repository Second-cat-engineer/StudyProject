<h1>
    <a href="/admin/index/index"> Админ панель </a>
</h1>
<h1> Цитаты </h1>
<table>
    <tr>
        <td>id </td>
        <td>Цитата</td>
        <td>Текст</td>
        <td>Автор</td>
        <td>Редактировать</td>
        <td>Удалить</td>
        <td>Посмотреть комментарии к данной статье</td>
    </tr>
    <?php foreach ($this->quotes as $quote) { ?>
        <tr>
            <td><?php echo $quote->getId(); ?></td>
            <td><?php echo $quote->quote; ?></td>
            <td><?php echo $quote->content; ?></td>
            <td><?php echo $quote->author->login; ?></td>
            <td>
                <form action= "/admin/quote/edit" method= "post" >
                    <button name="id" value="<?php echo $quote->getId() ?>">
                        Редактировать
                    </button>
                </form>
            </td>
            <td>
                <form action= "/admin/quote/delete" method= "post" >
                    <button name="id" value="<?php echo $quote->getId() ?>">
                        Удалить
                    </button>
                </form>
            </td>
            <td>
                <form action= "/admin/comment/allOfRecord" method= "post" >
                    <input type="hidden" name="modelName" value="quote">
                    <button name="recordId" value="<?php echo $quote->getId() ?>">
                        Комментарии
                    </button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>
<a href="/admin/quote/add"> Добавить новую цитату</a>

<hr>
<h4>
    <a href="/"> Выход из админ панели </a>
</h4>