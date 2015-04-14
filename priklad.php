<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include 'class.php'; // include třídy
        $form = new formular("#", "POST", "Můj první formulář"); // vytvoření oběktu z třídy
        $form->input("text", "nick", "Zadejte jméno:"); // použití funkcí třídy
        $form->input("password", "pass", "Zadejte heslo:");
        $form->input("radio", "test", "Hodnota1:");
        $form->input("radio", "test", "Hodnota1:");
        $form->select("selekt", array("hodnota1", "hodnota2", "dalsi hodnoty..."), "Vyberte:");
        $form->textarea("textarea", "Textové pole:");
        echo $form; // vypsání formuláře
        ?>
    </body>
</html>
