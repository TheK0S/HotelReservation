<?php

function printGrade($grade){
    $string = '';
    while($grade-- > 0){
      $string = $string . "&#9733";
    }
    return $string;
}



?>