<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $this->layout('master', ['title' => $title]); ?></title>
</head>
<body>
    <?php $this->start('style') ?>
    <!-- <link rel="stylesheet" href="../../public/assets/css/style_maintenance.css"> -->
    
    <?php $this->stop() ?>
    <img class="imgManutencao" src="http://www.cefertelhas.com.br/manutencao.jpg" alt="Site em manutenção" width="100%" height="100%" >
</body>
</html>