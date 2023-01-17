<h2>Usuários</h2>

<ul>
    <?php foreach( $users as $user): ?>
        <li><?php echo $user->nome_user;?> | <a href="/user/<?php echo $user->idusuarios; ?>">Detalhes</a></li>
    <?php endforeach; ?>
</ul>