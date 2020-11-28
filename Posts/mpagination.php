<?php

if ($page != 1) $pervpage = '<a href= ../Posts/myposts.php?page=1><<</a>
                               <a href= ../Posts/myposts.php?page='. ($page - 1) .'><</a> ';

if ($page != $total) $nextpage = ' <a href= ../Posts/myposts.php?page='. ($page + 1) .'>></a>
                                   <a href= ../Posts/myposts.php?page=' .$total. '>>></a>';

echo $pervpage.'<b>'.$page.'</b>'.$nextpage;

?>