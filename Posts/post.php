<?php
    session_start();
    require('../header.php');
    require('postc.php');
?>
    <table>
        <tr><td colspan = '3'>Title</td></tr>
        <tr><td colspan = '3'><?php echo $post['title'] ?></td></td></tr>
        <tr><td colspan='3'><?php echo $post['text'] ?></td></tr>
        <tr><td colspan='1'></td><td>Created at</td><td><?php echo $post['created_at'] ?></td></tr>
        <?php if($post['updated_at']!=NULL) echo "<tr><td colspan='1'></td><td>Updated at</td><td>".$post['updated_at']."</td></tr>"; ?>        
    </table>
<?php
    if($status==1)
    {
        echo "<a href=". socialsharingbuttons('facebook', $params) ." target='_blank'>Facebook</a> | 
        <a href=". socialsharingbuttons('twitter', $params) ." target='_blank'>Twitter</a> | 
        <a href=". socialsharingbuttons('whatsapp', $params) ." target='_blank'>Whatsapp</a> | 
        <a href=". socialsharingbuttons('linkedin', $params) ." target='_blank'>Linkedin</a> |
        <a href=". socialsharingbuttons('telegram', $params) ." target='_blank'>Telegram</a> |";
    }  
    require_once('../footer.php');
?>