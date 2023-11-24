<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css\stylesheet.css">
</head>

<body>
    <main>
        <header class="row"><?php echo $header; ?></header>
        <?php echo $user ?? ""; ?>
        <?php echo $error ?? ""; ?>
        <?php echo $success ?? ""; ?>
        <section>
            <?php echo $content; ?>
            <footer class="row">
                <hr>
                <div class="center">
                    <strong><span>Copyright &copy; "Ajani Phillips". All Rights Reserved </span></strong>
                </div>
            </footer>
        </section>
    </main>


</body>

</html>