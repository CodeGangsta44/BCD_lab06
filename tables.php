<?php

  $cols = ( $_POST['cols'] == '' ) ? 7 : $_POST['cols'];
  $rows = ( $_POST['rows'] == '' ) ? 7 : $_POST['rows'];

  $table1 = '<table>';
  $table2 = '<table>';
  $table3 = '<table>';
  $table4 = '<table>';

  $to_draw = $_POST['flag_four'] == 'on' ? True : False;

  function get_str($cff, $to_draw){
    return (($cff % 4) === 0 && $to_draw ? 'Четверта клітинка' : '');
  }
  function print_table_title($number){
    echo '<br>';
    $title = '<h2>Table #' . $number . '</h2>';
    echo $title;
  }

if($_POST['draw'] == 'on'){
  if($cols <= 0
  || $rows < 3
  || $rows % 3 == 0){
    echo '<h1>INCORRECT INPUT!<h1>';
  } else {

    print_table_title(1);
    $cff = 0;
    for($i = 0; $i < $rows; $i++){

      $table1 .= '<tr>';
      if($i === 0){

        $table1 .= '<td colspan="'
        . ($cols - $i)
        . '">'
        . get_str(++$cff, $to_draw)
        . '</td>';
      }
      else if($i < min($rows, $cols)) {

        $table1 .= '<td rowspan="'
        . ($rows - $i)
        . '">'
        . get_str(++$cff, $to_draw)
        . '</td>';


        $table1 .= '<td colspan="'
        . ($cols - $i)
        . '">'
        . get_str(++$cff, $to_draw)
        . '</td>';

      } else if ($i == $cols){

        $table1 .= '<td rowspan="'
        . ($rows - $i)
        . '">'
        . get_str(++$cff, $to_draw)
        . '</td>';

        break;
      }
      $table1 .= '</tr>';
    }
    $table1 .= '</table>';
    echo $table1;

    print_table_title(2);
    $cff = 0;
    for($i = 0; $i < $rows; $i++){

      $table2 .= '<tr>';

      if($i > min($rows, $cols) - 1) continue;

      if($i === min($rows, $cols) - 1){
        $table2 .= '<td '
        . ($cols < $rows ? 'row' : 'col')
        . 'span="'
        . (max($rows, $cols) - $i)
        . '">'
        . get_str(++$cff, $to_draw)
        . '</td>';
      }

      else if($i === $rows - 1){
        $table2 .= '<td>'
        . get_str(++$cff, $to_draw)
        . '</td>';
      }
      else{

        $table2 .= '<td rowspan="'
        . ($rows - $i)
        . '">'
        . get_str(++$cff, $to_draw)
        . '</td>';

        $table2 .= '<td colspan="'
        . ($cols - $i - 1)
        . '">'
        . get_str(++$cff, $to_draw)
        . '</td>';
      }
      $table2 .= '</tr>';
    }
    $table2 .= '</table>';
    echo $table2;

    print_table_title(3);
    $cff = 0;
    for($i = 0; $i < $rows; $i++){
      $curr_summ = 0;
      $table3 .= '<tr>';

      if($i % 2 == 1){
        $table3 .= '<td>'
        . get_str(++$cff, $to_draw)
        . '</td>';
        $curr_summ += 1;
      }

      for($j = 0; $j < floor(($cols - $curr_summ)/2); $j++){
        $table3 .= '<td colspan="2">'
        . get_str(++$cff, $to_draw)
        . '</td>';
      }

      $curr_summ += (floor(($cols - $curr_summ)/2) * 2);

      if($curr_summ != $cols){
        $table3 .= '<td>'
        . get_str(++$cff, $to_draw)
        . '</td>';
      }
      $table3 .= '</tr>';
    }
    $table3 .= '</table>';
    echo $table3;

    print_table_title(4);
    $cff = 0;
    $table4 .= '<tr>';
    $summ_in_first_col = 3; $next_span = 3;

    for($i = 0; $i < $cols; $i++){
      $table4 .= '<td rowspan="'
      . $next_span . '">'
      . get_str(++$cff, $to_draw)
      .'</td>';

      $next_span = 3 - (($rows - $next_span)%3);
    }

    $inc = ($rows - floor($rows / 3)*3) == 2 ? 1 : -1;
    $shift = 3 - (($rows - 3)%3);
    $table4 .= '</tr>';

    for($i = 1; $i < $rows; $i++){
      $table4 .= '<tr>';

      for($j = 0;$j + $shift <= $cols - 1; $j += 3){
        $table4 .= '<td rowspan="'
        .min(3, $rows - $i)
        .'">'
        . get_str(++$cff, $to_draw)
        . '</td>';
      }

      $shift += $inc;
      if($shift == 3) $shift = 0;
      if($shift == -1) $shift = 2;
      $table4 .= '</tr>';
    }
    echo $table4;
    echo '<br>';
  }
}
?>
