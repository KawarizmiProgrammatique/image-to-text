<?php

function extractText($image, $langs = 'en fr') {
    if (file_exists($image)) {
        ob_start();
        @passthru("easyocr -l {$langs} -f {$image} --detail=0");
        $text = ob_get_contents();
        ob_end_clean();

        return $text;
    }

    return '';
}

if (count($argv) < 2) {
    echo 'Please provide the path to the folder where images are stored.' . PHP_EOL;
    echo '$ php ./extract-texts.php [folder-path]' . PHP_EOL . PHP_EOL;
    exit(0);
}

$folder = __DIR__ . '/' . trim($argv[1], '/');

if (!is_dir($folder) || !file_exists($folder)) {
    echo $folder . ' is not a folder' . PHP_EOL;
    exit(0);    
}

$images = glob($folder . '/*');
foreach($images as $image) {
    $path_parts = pathinfo($image);
    echo 'Processing ' . $path_parts['basename'] . PHP_EOL;

    $output     = __DIR__ . '/texts/' . $path_parts['filename'] . '.txt';
    $extractTxt = extractText($image);

    $fp = fopen($output, 'w');
    fwrite($fp, $extractTxt);
    fclose($fp);
}
