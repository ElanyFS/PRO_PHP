<?php $this->layout('master', ['title' => $title]) ?>

<h2>Usuários</h2>

<!-- <div x-data="users()" x-init="loadUsers()">
    <ul>
        <template x-for="user in data">
            <li x-text="usuarios.nome_user"></li>
        </template>
    </ul>
</div> -->

<ul>
    <?php foreach ($users as $user) : ?>
        <li><?php echo $user->nome_user; ?> | <a href="/user/<?php echo $user->idusuario; ?>">Detalhes</a></li>
    <?php endforeach; ?>
</ul>