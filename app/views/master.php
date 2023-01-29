<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title><?php echo $this->e($title); ?></title>
    <?= $this->section('style') ?>
</head>

<body>
    <div id='header'>
        <?php $this->insert('partials/header') ?>
    </div>

    <div class="content">
        <?= $this->section('content') ?>
    </div>
    <script src="app.js"></script>
    <?= $this->section('script') ?>
</body>

</html>