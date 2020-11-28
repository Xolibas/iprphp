<?php session_start();
    if (empty($_SESSION['username'])) {
        session_destroy();
        session_start();
        $_SESSION['messages'][] = 'You must login to do this.';
        header('Location: ../Account/loginf.php');
        exit;
      }
    require('../header.php');
    require('../db.php'); 
    $id = $_GET['id'];
    $statement = $connection->prepare("SELECT * FROM posts WHERE posts.id = ".$id." AND (posts.user_id = ".$_SESSION['id']." OR posts.status = 1)");
    $statement->execute();
    $status;
    echo "<table><tr><td>Title</td></tr>";
                foreach($statement->fetchAll() as $postrow)
                {
                    echo "<tr>
                        <td>".$postrow['title']."</td></tr>
                    <tr><td>".$postrow['text']."</td></tr>";
                    $status=$postrow['status'];
                }
    echo "</table>"; 
    require('sharing.php');  
?>
<?php if($status==1){
echo "<a href=". socialsharingbuttons('facebook', $params) ." target='_blank'>Facebook</a> | 
<a href=". socialsharingbuttons('twitter', $params) ." target='_blank'>Twitter</a> | 
<a href=". socialsharingbuttons('whatsapp', $params) ." target='_blank'>Whatsapp</a> | 
<a href=". socialsharingbuttons('linkedin', $params) ." target='_blank'>Linkedin</a> |
<a href=". socialsharingbuttons('telegram', $params) ." target='_blank'>Telegram</a> |";
} require_once('../footer.php'); ?>