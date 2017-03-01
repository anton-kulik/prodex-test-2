<?php
session_name('prodex-2');
session_start();

require_once 'functions.php';

$allImages = getAllImage();

if (isset($_POST['action']) && $_POST['action'] == 'addImage') {
    $image['name'] = $_FILES['image']['name'];
    $image['type'] = $_FILES['image']['type'];
    $image['tmp_name'] = $_FILES['image']['tmp_name'];
    $image['error'] = $_FILES['image']['error'];

    if ($image['type'] == 'image/jpeg' || $image['type'] == 'image/gif' || $image['type'] == 'image/png') {
        if (addImage($image)) {
            $_SESSION['message'] = '<p style="color: green">Картинка загружена</p>';
            header('Location: index.php');
            die;
        }
    } else {
        $_SESSION['message'] = '<p style="color: red">Неправильный формат</p>';
    }
}

if (isset($_GET['delImage'])) {
    $id = intval($_GET['delImage']);
    $name = $_GET['name'];
    if (delImage($id, $name)) {
        $_SESSION['message'] = '<p style="color: green">Картинка удалена</p>';
        header('Location: index.php');
        die;
    }
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prodex test 2</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="container" style="padding-top: 35px">

    <form class="form-inline" method="post" enctype="multipart/form-data" novalidate>

        <div class="form-group">
            <input type="file" name="image">
            <p class="help-block">(допустимые форматы - jpg, gif, png)</p>
        </div>

        <button type="submit" class="btn btn-default">Загрузить</button>
        <input type="hidden" name="action" value="addImage">
    </form>

    <div style="padding: 10px 0 10px 0; text-align: center" class="messageHolder">
        <?php if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        } ?>
    </div>

    <?php if (isset($allImages) && !empty($allImages)) { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td>id</td>
                <td>картинка</td>
                <td></td>
            </tr>
            </thead>
            <?php foreach ($allImages as $image) { ?>
                <tr>
                    <td width="10"><?php echo $image['id'] ?></td>

                    <td align="center">
                        <a onclick="openModal('<?php echo $image['id'] ?>')">
                            <img width="100" height="100" src="images/<?php echo $image['small'] ?>"
                                 alt="<?php echo $image['name'] ?>">
                        </a>

                        <div id="imageId<?php echo $image['id'] ?>" class="prefix-Dialog">
                            <div>
                                <img width="100%" src="images/<?php echo $image['name'] ?>">
                                <a class="prefix-close" title="Закрыть"></a>
                            </div>

                            <script>
                                var isInit = '';
                                function openModal(imageId) {

                                    var modal = document.querySelector('#imageId' + imageId);
                                    if (isInit == false) {
                                        isInit = true;
                                        document.querySelector('.prefix-close').addEventListener('click',
                                            function (event) {
                                                event.preventDefault();
                                                modal.classList.toggle('active');
                                            }
                                        );
                                    }
                                    modal.classList.toggle('active');
                                }
                            </script>
                    </td>

                    <td width="100"><a
                                href="index.php?delImage=<?php echo $image['id'] ?>&name=<?php echo $image['name'] ?>">
                            <button class="btn btn-danger">удалить</button>
                        </a>
                    </td>

                </tr>
            <?php } ?>
        </table>
    <?php } ?>

</div>
</body>
</html>
