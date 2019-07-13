<?php
require 'classes/Database.php';

$database = new Database;



$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if(isset($_POST['delete_id'])){
    $delete_id = $_POST['delete_id'];
    $database->query('DELETE FROM posts WHERE id = :id');
    $database->bind(':id', $delete_id);
    $database->execute();
}

if(isset($_POST['submit'])){
    $title = $post['title'];
    $id = $post['id'];
    $body = $post['body'];
    
    $database->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
    $database->bind(':title', $title);
    $database->bind(':body', $body);
    $database->bind(':id', $id);
    $database->execute();

    
}

$database->query('SELECT * FROM posts');
//$database->bind(':id', 1);

$rows = $database->resultset();
?>

<h1>Add post</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<label>Post ID</label><br/>
<input type="text" name="id" placeholder="Specify ID" /><br/><br/>
<label>Post Title</label><br/>
<input type="text" name="title" placeholder="Add a Title..." /><br/><br/>
<label>Post Body</label><br/>
<textarea name="body"></textarea><br/><br/>
<input type="submit" name="submit" value="Submit" />
</form>

<h1>Posta</h1>
<?php foreach($rows as $row){ ?>
    <h3><?= $row['id']; ?></h3>
    <p><?php echo $row['title']; ?></p>
    <p><?php echo $row['body']; ?></p>
    <br />
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
    <input type="submit" name="delete" value="Delete" />
    </form>
<?php } ?>
