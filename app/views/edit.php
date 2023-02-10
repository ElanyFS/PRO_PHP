<form action="">

</form>

<hr>

<?php echo getFlash('upError'); ?>

<form action="/user/image/edit" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit">Alterar foto</button>
</form>