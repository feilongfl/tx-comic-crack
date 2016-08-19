
<head><title>zip</title></head>
<body>
<?php
function addFileToZip($path, $zip) {
    echo 'path:' . $path . '</br>';
    $handler = opendir($path); //打开当前文件夹由$path指定。
    /*
    循环的读取文件夹下的所有文件和文件夹
    其中$filename = readdir($handler)是每次循环的时候将读取的文件名赋值给$filename，
    为了不陷于死循环，所以还要让$filename !== false。
    一定要用!==，因为如果某个文件名如果叫'0'，或者某些被系统认为是代表false，用!=就会停止循环
    */
    while (($filename = readdir($handler)) !== false) {
        if ($filename != "." && $filename != "..") {//文件夹文件名字为'.'和‘..’，不要对他们进行操作
            echo 'path:' . $path . "/" . $filename . '</br>';
            if (is_dir($path . "/" . $filename)) {// 如果读取的某个对象是文件夹，则递归
                addFileToZip($path . "/" . $filename, $zip);
            } else { //将文件加入zip对象
                $zip->addFile($path . "/" . $filename);
            }
        }
    }
    @closedir($path);
}

echo 'hi!</br>';
$zip = new ZipArchive();
if ($zip->open('images.zip', ZipArchive::OVERWRITE) === TRUE) {
    addFileToZip('images/', $zip); //调用方法，对要打包的根目录进行操作，并将ZipArchive的对象传递给方法
    $zip->close(); //关闭处理的zip文件
}
echo 'finish!</br>';
?>
</body>

