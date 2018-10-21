<?php
$connection = mysqli_connect('localhost','user','0000', 'input_db');
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if($_POST['cols'] != '' && $_POST['rows'] != ''){
  if($_POST['cols'] < 3
  || $_POST['rows'] < 3
  || $_POST['cols'] % 3 == 0
  || $_POST['rows'] % 3 == 0){
    $sql = 'INSERT INTO incorrect_inputs(id, colons, rows, date_of_input) VALUES (NULL,'
    . $_POST['cols'] .', '
    . $_POST['rows'] .', '
    . '\'' . date('d/m/Y, h:i:s') .'\'' . ');';
  } else {
    $sql = 'INSERT INTO correct_inputs(id, colons, rows, date_of_input) VALUES (NULL,'
    . $_POST['cols'] .', '
    . $_POST['rows'] .', '
    . '\'' . date('d/m/Y, h:i:s') .'\'' . ');';
  }
}

mysqli_query($connection, $sql);

function print_db($table_name, $connection){
  $sql = "SELECT * FROM " . $table_name . "_inputs";
  echo '<h2>'.strtoupper($table_name).' INPUTS:</h2>';
  $query_result = mysqli_query($connection, $sql);
  $rows_num =  mysqli_num_rows($query_result);
  $table = '<table>';
  for ($i = 0 ; $i < $rows_num ; ++$i){
    $table .= '<tr>';
    $row = mysqli_fetch_row($query_result);
    for ($j = 0 ; $j < 4 ; ++$j) $table .= '<td>'.$row[$j].'</td>';
    $table .= '</tr>';
  }
  $table .= '</table>';
  echo $table;
  echo '<br>';
}
if($_POST['show_db'] == 'on'){
  print_db('correct', $connection);
  print_db('incorrect', $connection);
}
?>
