<?php

$action = strtolower($_GET['action']).'.php';

if ($action === 'edit.php') {
    require __DIR__.'/includes/config.php';

    $id = $_GET['id'];
    $db = db();

    $postQuery = $db->prepare(<<<SQL
        SELECT *
        FROM posts
        WHERE id = :id
    SQL);

    $postQuery->execute(['id' => $id]);

    $post = $postQuery->fetch(PDO::FETCH_ASSOC);

    $action .= "?id=$id";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main>
        <form action="./<?php echo $action ?>" method="POST">

            <div>
                <label for="title">Title</label>
                <input id="title" name="title" type="text" required placeholder="Post Title" value="<?php echo $post['title'] ?? '' ?>"">
            </div>

            <div>
                <label for="content">Content</label>
                <textarea name="content" id="content" cols="30" rows="10" placeholder="Write here"><?php echo $post['content'] ?? "" ?></textarea>
            </div>

            <button type="submit">Submit</button>
        </form>
    </main>
</body>
</html>
