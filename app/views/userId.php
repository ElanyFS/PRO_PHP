<?php $this->layout('master', ['title' => $title]) ?>

<h2>Usuário  <?php echo $user[0]->idusuario;?></h2>

<table border="1">
   <tr>
       <th>Nome:</th>
       <td><?php echo $user[0]->nome_user; ?></td>
   </tr>
   <tr>
       <th>E-mail:</th>
       <td><?php echo $user[0]->email; ?></td>
   </tr>
</table>