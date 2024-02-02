<?php
require __DIR__.'/includes/config.php';

$message = $_GET['message'] ?? null;

$db = db();

$postsQuery = $db->query(<<<SQL
    SELECT *
    FROM posts
SQL);

$posts = $postsQuery->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en" class="w-screen h-screen">
<head>
    <title>Form</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        window.onload = () => {
            setTimeout(() =>
                    document
                        .getElementById('message')
                        .classList
                        .add('opacity-0', 'delay-200', 'duration-1000'),
                2000
            );
        }
    </script>
</head>
<body class="w-screen h-screen flex justify-center items-center relative">
    <?php if (! empty($message)): ?>
        <div id="message" class="absolute top-0 right-0 mt-8 opacity-1 transition">
            <p class="p-4 px-8 rounded-l bg-blue-500 text-white uppercase to-hide"><?php echo $message ?></p>
        </div>
    <?php endif; ?>

    <main class="bg-white shadow-lg p-8 rounded-md w-100 md:w-6/12 space-y-4">
        <div class="flex justify-start">
            <a href="./form.php?action=create" class="block px-4 rounded-md text-white py-2 bg-gray-800 hover:bg-gray-900 active:bg-gray-800 focus:outline-none focus:ring-2 focus:border-transparent focus:ring-blue-400/50">Create new</a>
        </div>

        <div class="relative rounded-xl overflow-auto border">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                    <?php foreach ($posts as $post): ?>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo $post['id']; ?></th>
                            <td class="px-6 py-4"><?php echo $post['title']; ?></td>
                            <td class="px-6 py-4 flex justify-end space-x-2">
                                <a href="./form.php?action=edit&id=<?php echo $post['id']; ?>" class="block px-4 rounded-md text-white py-2 bg-blue-500 hover:bg-blue-600 active:bg-blue-400 focus:outline-none focus:ring-2 focus:border-transparent focus:ring-blue-400/50">Edit</a>
                                <a href="./delete.php?id=<?php echo $post['id']; ?>" class="block px-4 rounded-md text-white py-2 bg-red-500 hover:bg-red-600 active:bg-red-400 focus:outline-none focus:ring-2 focus:border-transparent focus:ring-blue-400/50">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
