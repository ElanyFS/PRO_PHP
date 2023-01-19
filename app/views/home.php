<?php $this->layout('master', ['title' => $title]) ?>

<h2>Usuários</h2>

<ul>
    <?php foreach( $users as $user): ?>
        <li><?php echo $user->nome_user;?> | <a href="/user/<?php echo $user->idusuario; ?>">Detalhes</a></li>
    <?php endforeach; ?>
</ul>