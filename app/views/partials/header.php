<ul id="menu_list">
    <li> <a href="/">Home</a></li>
    <li> <a href="/user/create">Create</a></li>
    <li> <a href="/login">Login</a></li>
</ul>

<div id="status_login">
    Bem-Vindo(a),
    <?php if (logged()) : ?>

        <?php echo user()->nome_user; ?> | <a href="/logout"><span class="material-symbols-outlined">logout</span></a>

    <?php else : ?>
        Visitante
    <?php endif; ?>
</div>