<html>
  <head>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <style media="screen">
      form{
        margin: auto;
        width: 20%;
      }
      div{
        display: block;
      }
      h2{
        text-align: center;
      }
    </style>
    <title>Tables</title>
  </head>
  <body>
    <form width="500px" action="index.php" method="post">
      <p><b>Введіть, будь ласка, кількість колонок та рядків</b></p>
      <p>Colons: <input type="text" name="cols"></p>
      <p>Rows: <input type="text" name="rows"></p>
      <p>Кожна четверта <input type="radio" name="flag_four"></p>
      <p>Показати статистику <input type="radio" name="show_db"></p>
      <p>Створити таблиці <input type="radio" name="draw"></p>
      <p><input type="submit"></p>
    </form>
    <?php include_once "db.php"; ?>
    <?php include_once "tables.php"; ?>
  </body>
</html>
