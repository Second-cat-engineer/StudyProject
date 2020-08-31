<h1>
    <a href="/admin/index/index"> Админ панель </a>
</h1>
<h1> Пользователи моей замечательной системы </h1>
<table>
    <tr>
        <td>id</td>
        <td>login</td>
        <td>Уровень доступа к системе</td>
        <td>Изменить уровень доступа</td>
        <td>Удалить пользователя</td>
    </tr>
    <?php foreach ($this->users as $user) { ?>
        <tr>
            <td><?php echo $user->getId(); ?></td>
            <td><?php echo $user->login; ?></td>
            <td><?php echo $user->access; ?></td>
            <td>
                <form action= "/admin/user/edit" method= "post" >
                    <button name="id" value="<?php echo $user->getId() ?>">
                        Изменить уровень доступа
                    </button>
                </form>
            </td>
            <td>
                <form action= "/admin/user/delete" method= "post" >
                    <button name="id" value="<?php echo $user->getId() ?>">
                        Удалить пользователя
                    </button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>

<hr>
<h4>
    <a href="/"> Выход из админ панели </a>
</h4>