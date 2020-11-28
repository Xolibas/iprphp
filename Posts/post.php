<?php session_start();
    if (empty($_SESSION['username'])) {
        session_destroy();
        session_start();
        $_SESSION['messages'][] = 'You must login to do this.';
        header('Location: loginf.php');
        exit;
      }
    require('../header.php');
    require('../db.php'); 
    $id = $_GET['id'];
    $statement = $connection->prepare("SELECT * FROM posts WHERE posts.id = ".$id." AND (posts.user_id = ".$_SESSION['id']." OR posts.status = 1)");
    $statement->execute();
    echo "<table><tr><td>Title</td></tr>";
                foreach($statement->fetchAll() as $postrow)
                {
                    echo "<tr>
                        <td>".$postrow['title']."</td></tr>
                    <tr><td>".$postrow['text']."</td></tr>";
                }
    echo "</table>"; 
    require('sharing.php');  
?>
<a href="<?php echo socialsharingbuttons('facebook', $params); ?>" target="_blank">Facebook</a> | 
<a href="<?php echo socialsharingbuttons('twitter', $params); ?>" target="_blank">Twitter</a> | 
<a href="<?php echo socialsharingbuttons('whatsapp', $params); ?>" target="_blank">Whatsapp</a> | 
<a href="<?php echo socialsharingbuttons('linkedin', $params); ?>" target="_blank">Linkedin</a> |
<a href="<?php echo socialsharingbuttons('telegram', $params); ?>" target="_blank">Telegram</a> |
<?php require_once('../footer.php'); ?>