<h2>Usuários</h2>

<ul>
    <?php foreach( $users as $user): ?>
        <li><?php echo $user->nome;?> | <a href="/users/<?php echo $user->idusuario; ?>">Detalhes</a></li>
    <?php endforeach; ?>
</ul>