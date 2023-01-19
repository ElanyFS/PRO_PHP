<?php $this->layout('master', ['title' => $title]) ?>
<div class="container_form">
    <h2>Formulário de Cadastro</h2>
    <form class="form" action="/user/create" method="post">
        <div class="form_grupo">
            <label for="nome" class="form_label">Nome</label>
            <input type="text" name="nome_user" class="form_input" id="nome" placeholder="Nome" value="Priscila">
            <?php echo getFlash('nome') ?>
        </div>
        <!-- <div class="form_grupo">
            <label for="nome" class="form_label">CPF</label>
            <input type="text" name="cpf" class="form_input" id="cpf" placeholder="11111111111">
        </div>
        <div class="form_grupo">
            <label for="nome" class="form_label">Função</label>
            <input type="text" name="funcao" class="form_input" id="funcao" placeholder="Gestor(a)">
        </div>
        <div class="form_grupo">
            <label for="datanascimento" class="form_label">Data de Nascimento</label>
            <input type="date" name="datanascimento" class="form_input" id="datanascimento" placeholder="Data de Nascimento">
        </div>
        <div class="form_grupo">
            <label for="nome" class="form_label">Endereço</label>
            <input type="text" name="endereco" class="form_input" id="endereco" placeholder="Calhau">
        </div>
        <div class="form_grupo">
            <label for="nome" class="form_label">Cidade</label>
            <input type="text" name="cidade" class="form_input" id="cidade" placeholder="São Luís">
        </div> -->
        <div class="form_grupo">
            <label for="e-mail" class="form_label">E-mail</label>
            <input type="email" name="email" class="form_input" id="email" placeholder="seuemail@email.com" value="pricaliari@gmail.com">
            <?php echo getFlash('email') ?>
        </div>
        <div class="form_grupo">
            <label for="nome" class="form_label">Senha</label>
            <input type="password" name="password" class="form_input" id="password" placeholder="123456" value="1234">
            <?php echo getFlash('password') ?>
        </div>
        <!-- <div class="form_grupo">
            <label for="estadocivil" class="text">Estado civil</label>
            <select name="estadocivil" class="dropdown">
                <option selected disabled class="form_select_option" value="">Selecione</option>
                <option value="Solteiro" class="form_select_option">Solteiro(a)</option>
                <option value="Casado" class="form_select_option">Casado(a) </option>
                <option value="Divorciado" class="form_select_option">Divorciado(a)</option>
                <option value="Viúvo" class="form_select_option">Viúvo(a)</option>
            </select>
        </div>
        <div class="form_grupo">
            <span class="legenda">Sexo:</span>
            <div class="radio-btn">
                <input type="radio" class="form_new_input" id="masculino" name="sexo" value="Masculino">
                <label for="masculino" class="radio_label form_label"> <span class="radio_new_btn"></span> Masculino</label>
            </div>
            <div class="radio-btn">
                <input type="radio" class="form_new_input" id="feminino" name="sexo" value="Feminino">
                <label for="feminino" class="radio_label form_label"> <span class="radio_new_btn"></span> Feminino</label>
            </div>
        </div> -->
        <div class="submit">
            <input type="hidden" name="acao" value="enviar">
            <button type="submit" name="Submit" class="submit_btn">Cadastrar</button>
        </div>
    </form>
</div>