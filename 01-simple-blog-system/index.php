<?php
require __DIR__.'/includes/config.php';

$db = db();

$postsQuery = $db->query(<<<SQL
    SELECT *
    FROM posts
SQL);

$posts = $postsQuery->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main>
        <div>
            <a href="./form.php?action=create">Create new</a>
        </div>

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?php echo $post['id']; ?></td>
                    <td><?php echo $post['title']; ?></td>
                    <td>
                        <a href="./form.php?action=edit&id=<?php echo $post['id']; ?>">Edit</a>
                        <a href="./delete.php?id=<?php echo $post['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
