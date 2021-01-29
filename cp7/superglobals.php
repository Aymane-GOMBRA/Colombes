<?php
session_start();
$_SESSION['login time']=time();
$_SESSION['fname']='Aymane';
$_SESSION['admin']=true;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Northwind Traders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body class='container'>
    <h2>SERVER</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Clé</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $html = '';
            foreach ($_SERVER as $key => $val) {
                $html .= sprintf('<tr><td>%s</td><td>%s</td></tr>', $key, $val);
            }
            echo $html;
            ?>
        </tbody>
    </table>
    <h2>ENV</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Clé</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $html2 = '';
            foreach ($_ENV as $key2 => $val2) {
                $html2 .= sprintf('<tr><td>%s</td><td>%s</td></tr>', $key2, $val2);
            }
            echo $html2;
            ?>
        </tbody>
    </table>
    <h2>REQUEST</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Clé</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>
            <?php
            setcookie('granola', 'Toto aime le choco');
            setcookie('prince', 'Chateur pop des années des 80', time() + 365 * 24 * 60 * 60, '/');
            $html3 = '';
            foreach ($_REQUEST as $key3 => $val3) {
                $html3 .= sprintf('<tr><td>%s</td><td>%s</td></tr>', $key3, $val3);
            }
            echo $html3;
            ?>
        </tbody>
    </table>
    <h2>Cookie</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Clé</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $html4 = '';
        foreach ($_COOKIE as $key4 => $val4) {
            $html4.=sprintf('<tr><td>%s</td><td>%s</td></tr>',$key4,$val4);
        }
        echo $html4;
        ?>
        </tbody>
    </table>
    <h2>GET</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Clé</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $html5 = '';
        foreach ($_GET as $key5 => $val5) {
            $html5.=sprintf('<tr><td>%s</td><td>%s</td></tr>',$key5,$val5);
        }
        echo $html5;
        ?>
        </tbody>
    </table>

    <h2>SESSION</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Clé</th>
                <th>Valeur</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $html6 = '';
        foreach ($_SESSION as $key6 => $val6) {
            $html6.=sprintf('<tr><td>%s</td><td>%s</td></tr>',$key6,$val6);
        }
        echo $html6;
        ?>
        </tbody>
    </table>
</body>

</html>