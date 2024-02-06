<?php

/**
 * Get the files from a directory
 *
 * @param string $dir
 * @return array|false Array of files, or false if the directory path not exists
 */
function getFiles(string $dir): array|false
{
    $dir = rtrim($dir, DIRECTORY_SEPARATOR);

    if (! file_exists($dir)) {
        return false;
    }

    $handler = opendir($dir);

    $files = [];

    if ($handler) {
        while (false !== $file = readdir($handler)) {
            if ($file === '.' || $file === '..' || $file === '.gitignore') {
                continue;
            }

            $files[] = $file;
        }

        closedir($handler);
    }

    return $files;
}

$message = $_GET['message'] ?? null;

$storage = __DIR__.DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR;
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CSV Files</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md">
        <form action="upload.php" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="flex justify-center items-center w-full">
                <div class="block w-64 px-4 py-2 text-sm text-gray-700 bg-white rounded-lg border-2 border-gray-300 border-dashed hover:border-gray-400 focus:outline-none focus:border-blue-500 group ease-in-out duration-200">
                    <label class="flex flex-col justify-center items-center" for="file">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fill-gray-400 group-hover:fill-gray-900 ease-in-out duration-200" viewBox="0 0 24 24">
                            <path d="M16.88 16.29L13 20.17V10.5a1 1 0 10-2 0v9.67l-3.88-3.88a1 1 0 00-1.41 1.41l5.3 5.3a1 1 0 001.41 0l5.3-5.3a1 1 0 10-1.42-1.42z"></path>
                            <path d="M18.42 9.21a7 7 0 00-13.36 1.9A4 4 0 006 19h12a4.28 4.28 0 00.42-.05A4 4 0 0018.42 9.21z"></path>
                        </svg>
                        <span class="mt-2 text-base leading-normal">Select a CSV file</span>
                        <input type='file' required class="hidden" id="file" name="file" onchange="document.getElementById('file_message').textContent = this.files.length ? `CSV file selected: ${this.files[0].name}` : 'Select a CSV file'"/>
                    </label>
                </div>
            </div>

            <div id="file_message" class="text-gray-500 text-center mt-2">None CSV file selected</div>

            <div class="flex items-center justify-center mt-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Submit
                </button>
            </div>
        </form>

        <?php if ($files = getFiles($storage)): ?>
            <div class="flex flex-col items-center justify-center w-full mt-5">
                <ul style="width: 30rem" class="bg-white rounded-lg border border-gray-200 text-gray-900">
                    <?php foreach ($files as $file): ?>
                        <li>
                            <a href="./display.php?filename=<?= $file = rtrim($file, '.csv'); ?>" target="_blank" class="px-6 py-2 border-b border-gray-200 w-full rounded-t-lg flex justify-between items-center">
                                <span><?= $file ?></span>

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9l-6-6H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>

    <?php if (! empty($message)): ?>
        <div class="flex items-center justify-center mt-5">
            <div class="bg-blue-100 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md w-96" role="alert">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-blue-600 w-6 h-6 mr-1" viewBox="0 0 24 24">
                        <path d="M12 22c1.1 0 2-.9 2-2H10c0 1.1.9 2 2 2zm6-6V11c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5S10.5 3.17 10.5 4v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-7c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v7z"/>
                    </svg>

                    <p class="text-sm"><?= $message ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
