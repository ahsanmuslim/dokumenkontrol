<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link rel="shortcut icon" href="<?= BASEURL ?>/icon/favicon-16x16.png" type="image/x-icon">
</head>
<body>
    <iframe src="<?= BASEURL ?>/file/pdf/<?= $data['nama_file'] ?>.pdf#toolbar=0" style="width:100%; height:100vh;"></iframe>
</body>
</html>
