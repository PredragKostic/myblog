<?php
require 'classes/Database.php';

$database = new Database;

$database->query('SELECT * FROM posts WHERE id = :id');
$database->bind(':id', 1);

$rows = $database->resultset();
?>

<h1>Posta</h1>
<?php foreach($rows as $row){ ?>
    <h3><?= $row['id']; ?></h3>
    <p><?php echo $row['body']; ?></p>
<?php } ?>
