<?php

if ($page != 1) $pervpage = '<a href= ./index.php?page=1><<</a>
                               <a href= ./index.php?page='. ($page - 1) .'><</a> ';

if ($page != $total) $nextpage = ' <a href= ./index.php?page='. ($page + 1) .'>></a>
                                   <a href= ./index.php?page=' .$total. '>>></a>';

echo $pervpage.'<b>'.$page.'</b>'.$nextpage;

?>