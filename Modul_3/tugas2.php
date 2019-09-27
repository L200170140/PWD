<html>
<head>
    <title>Tugas 2</title>
</head>
<body>
    <H1>Test Ganjil Genap</H1>
    <form method='POST' action='tugas2.php'>
        <p>Masukkan angka : <input type='text' name='nilai' size='3'></p>
        <p><input type='submit' value='Proses' name='submit'></p>
    </form>
<?php
    error_reporting (E_ALL ^ E_NOTICE);
    $nilai = $_POST['nilai'];
    $submit = $_POST['submit'];
    if($submit){
        if($nilai % 2 == 0){
            echo "$nilai adalah Bilangan Genap<br>";
        }else{
            echo "$nilai adalah Bilangan Ganjil<br>";
        }
    }
?>
</body>
</html>