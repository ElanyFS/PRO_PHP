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

<?php $this->start('script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.3/axios.min.js" integrity="sha512-L4lHq2JI/GoKsERT8KYa72iCwfSrKYWEyaBxzJeeITM9Lub5vlTj8tufqYk056exhjo2QDEipJrg6zen/DDtoQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    // alert('Teste');
    axios.defaults.headers = {
        "Content-type":"applicatio/json",
        HTTP_X_REQUESTED_WITH : "XMLHttpRequest"
    }
    async function loadUsers(){
        try{
            const {data} = await axios.get('/users');
            console.log(data);
        }catch(error){
            console.log(error);
        }
    }

    loadUsers();
</script>

<?php $this->stop() ?>