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
<html lang="en" class="w-screen h-screen">
<head>
    <title>Form</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-screen h-screen flex justify-center items-center">
    <main class="bg-white shadow-lg p-8 rounded-md">
        <form action="./<?php echo $action ?>" method="POST" class="space-y-4">
            <div class="flex flex-col space-y-2">
                <label for="title">Title</label>
                <input id="title" class="w-100 border border-gray-200 rounded-sm px-4 py-2 placeholder:text-gray-200 focus:outline-none focus:ring-2 focus:border-transparent focus:ring-blue-400/50" name="title" type="text" required placeholder="Post Title" value="<?php echo $post['title'] ?? '' ?>"">
            </div>

            <div class="flex flex-col space-y-2">
                <label for="content">Content</label>
                <textarea id="content" class="w-full border border-gray-200 rounded-sm px-4 py-2 placeholder:text-gray-200 focus:outline-none focus:ring-2 focus:border-transparent focus:ring-blue-400/50" name="content" cols="30" rows="10" placeholder="Write here"><?php echo $post['content'] ?? "" ?></textarea>
            </div>

            <button type="submit" class="px-4 rounded-md text-white py-2 bg-blue-500 hover:bg-blue-600 active:bg-blue-400 focus:outline-none focus:ring-2 focus:border-transparent focus:ring-blue-400/50">Submit</button>
        </form>
    </main>
</body>
</html>
