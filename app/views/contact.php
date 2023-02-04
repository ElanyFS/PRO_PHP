<?php $this->layout('master', ['title' => $title])?>

<h2>Contato</h2>

<form action="/contact" method="post"> 
    <input type="text" name="name" placeholder="Seu nome" value="<?php echo getOld('name');?>"><br>
    <?php echo getFlash('name'); ?>

    <input type="text" name="email" placeholder="Seu email" value="<?php echo getOld('email');?>"><br>
    <?php echo getFlash('email'); ?>

    <input type="text" name="subject" placeholder="Assunto" value="<?php echo getOld('subject');?>"><br>
    <?php echo getFlash('subject'); ?>

    <textarea name="message" placeholder="Mensagem" cols="30" rows="10"><?php echo getOld('subject'); ?></textarea><br>
    <?php echo getFlash('message'); ?>

    <button type="submit" >Enviar</button>
</form> 