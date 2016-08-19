<head>
    <title>
        tx-crack
    </title>
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: fei_l
 * Date: 2016-08-18
 * Time: 17:24
 */
/*
 //openssl test
$w = stream_get_wrappers();
echo 'openssl: ',  extension_loaded  ('openssl') ? 'yes':'no', "\n";
echo 'http wrapper: ', in_array('http', $w) ? 'yes':'no', "\n";
echo 'https wrapper: ', in_array('https', $w) ? 'yes':'no', "\n";
echo 'wrappers: ', var_dump($w);
 */
//phpinfo();

$mid = $_GET["mid"];
$cid = $_GET["cid"];

//echo $mid,$cid,'</br>';
mkdir ('images');
mkdir ('images' . '/' . $mid);

if(file_exists('images' . '/' . $mid . '/' . $cid))
{
    $myfile = fopen('images' . '/' . $mid . '/' . $cid, "r");
    $json = fread($myfile,filesize('images' . '/' . $mid . '/' . $cid));
    fclose($myfile);

    $obj = json_decode($json);
    echo '</br>';
    $basecode = $obj->{'base'};
    preg_match_all("/.{40}/i", $basecode, $pid);
    //print_r($pid);
    foreach ($pid[0] as $p) {
        echo '<img src="http://www.beihaiw.com/pic.php?url=http://imgsrc.baidu.com/forum/pic/item/' . $p . '.jpg"></br>';
    }
}
else
{
    $content = file_get_contents(
        "https://mangacrk.nekoheart.com/api.php?api_name=txmh_reader/read_txmh&mid=" . $mid . "&cid=" . $cid);
    echo '</br>';
    if (preg_match("/{.*}/i", $content, $json)) {
        //print "A match was found:". $json[0];
        $myfile = fopen('images' . '/' . $mid . '/' . $cid, "w");
        fwrite($myfile, $json[0]);
        fclose($myfile);
        $obj = json_decode($json[0]);
        echo '</br>';
        $basecode = $obj->{'base'};
        preg_match_all("/.{40}/i", $basecode, $pid);
        //print_r($pid);
        foreach ($pid[0] as $p) {
            echo '<img src="http://www.beihaiw.com/pic.php?url=http://imgsrc.baidu.com/forum/pic/item/' . $p . '.jpg"></br>';
        }
    } else {
        print "comic not found.";
    }
}
?>
</body>
