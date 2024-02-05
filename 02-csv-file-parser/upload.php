<?php

try {
    if ($_SERVER['REQUEST_METHOD'] !== "POST") {
        throw new RuntimeException('The request method is not POST');
    }

    if (
        !isset($_FILES['file']['error']) ||
        is_array($_FILES['file']['error'])
    ) {
        throw new RuntimeException("The file is corrupt");
    }

    $tmpName = $_FILES['file']['tmp_name'];

    $finfo = new finfo(FILEINFO_MIME_TYPE);

    // Check if file is CSV
    if (false === $ext = in_array(
            $finfo->file($tmpName),
            [
                'text/csv',
                'text/plain',
            ],
            true,
        )) {
        throw new RuntimeException('The file type is not CSV');
    }

    $newFileName = sha1_file($tmpName).'.csv';

    // Move file
    if (!move_uploaded_file(
        $tmpName,
        __DIR__.DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.$newFileName,
    )) {
        throw new RuntimeException('The file could not be moved');
    }

    $message = "The file was uploaded";
} catch (RuntimeException $e) {
    $message = $e->getMessage();
}

header("Location: /?message=$message");
