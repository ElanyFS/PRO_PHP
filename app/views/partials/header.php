<ul id="menu_list">
    <li> <a href="/">Home</a></li>
    <?php if(!logged()): ?>
    <li> <a href="/user/create">Create</a></li>
    <li> <a href="/login">Login</a></li>
    <?php endif; ?>
</ul>

<div id="status_login">
    Bem-Vindo(a),
    <?php if (logged()) : ?>

        <?php echo user()->nome_user; ?> | <a href="/logout"><span class="material-symbols-outlined">Logout</span></a>
        | <a href="/edit"><span class="material-symbols-outlined">Edit</span></a>

    <?php else : ?>
        Visitante
    <?php endif; ?>
</div>