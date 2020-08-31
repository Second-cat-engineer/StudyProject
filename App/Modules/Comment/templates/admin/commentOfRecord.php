
<h3>Комментарии к записи </h3>
<?php var_dump($this->modelName); ?>
<hr>
<?php if (!empty($this->comments)) { ?>
<table>
    <tr>
        <td>idComment</td>
        <td>Comment</td>
        <td>Author</td>
        <td>Created_at</td>
        <td>Удалить</td>
    </tr>
    <?php foreach ($this->comments as $comment) { ?>
            <?php var_dump($this->controller); ?>
        <tr>
            <td><?php echo $comment->getId(); ?></td>
            <td><?php echo $comment->comment; ?></td>
            <td><?php echo $comment->author->login ?></td>
            <td><?php echo $comment->created_at; ?></td>
            <td>
                <form action= "/admin/comment/delete" method= "post" >
                    <input type="hidden" name="modelName" value="<?php echo $this->controller; ?>">
                    <input type="hidden" name="recordId" value="<?php echo $comment->record_id; ?>">
                    <button name="commentId" value="<?php echo $comment->getId() ?>">
                        Удалить comment
                    </button>
                </form>
            </td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <h3> К данной записи нет комментарий </h3>
<?php } ?>
</table>