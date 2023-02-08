<?php $this->layout('master', ['title' => $title]) ?>

<div class="container_form">
    <h2>Contato</h2>

    <?php echo getFlash('contact_success','background-color:green;color:white'); ?>
    <?php echo getFlash('contact_error','background-color:red;color:white'); ?>

    <form action="/contact" method="post">
        <?php echo getcsrf(); ?>
        <div class="form_grupo">
            <input type="text" name="name" placeholder="Seu nome" value="<?php echo getOld('name'); ?>"><br>
            <?php echo getFlash('name'); ?>
        </div>

        <div class="form_grupo">
            <input type="text" name="email" placeholder="Seu email" value="<?php echo getOld('email'); ?>"><br>
            <?php echo getFlash('email'); ?>
        </div>

        <div class="form_grupo">
            <input type="text" name="subject" placeholder="Assunto" value="<?php echo getOld('subject'); ?>"><br>
            <?php echo getFlash('subject'); ?>
        </div>

        <div class="form_grupo">
            <textarea name="message" placeholder="Mensagem" cols="30" rows="10"><?php echo getOld('subject'); ?></textarea><br>
            <?php echo getFlash('message'); ?>
        </div>

        <button type="submit">Enviar</button>
    </form>

</div>