<?php $this->layout('master', ['title' => $title]) ?>

<!-- <h2>Usuários: <?php echo $users->count; ?></h2> -->
<h2>Usuários </h2>

<!-- <div x-data="users()" x-init="loadUsers()">
    <ul>
        <template x-for="user in data">
            <li x-text="user.nome_user"></li>
        </template>
    </ul>
</div> -->

<form action="/" method="GET">
    <input type="text" name="search" placeholder="Digite o nome que deseja buscar"/>
    <button type="submit">Buscar</button>
</form>

<ul>
    <?php foreach ($users->rows as $user) : ?>
        <li><?php echo $user->nome_user; ?> | <a href="/user/<?php echo $user->idusuario; ?> ">Detalhes</a></li>
    <?php endforeach; ?>
</ul>

<?php  echo $links;?>