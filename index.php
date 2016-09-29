<html>
  <head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.2.1/css/bulma.css" />
    <title>
        tx-crack
    </title>
</head>
<body>
  <div class="notification is-danger">
      <button class="delete"></button>
      本网站仅供学习交流使用！！
    </div>
<?php

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
        echo '<div class="tile is-parent"><article class="tile is-child notification is-info"><p class="title">' . $p . '</p><figure class="image is-4by3">';
        echo '<img src="http://www.beihaiw.com/pic.php?url=http://imgsrc.baidu.com/forum/pic/item/' . $p . '.jpg"></br>';
        echo '</figure></article></div></div>';
    }
    
  
  echo '<a class="button is-primary" href="index.php?mid=' . $mid . '&cid=' . ($cid + 1) . '">cid+1</a>';
  echo '<a class="button is-primary" href="index.php?mid=' . $mid . '&cid=' . ($cid - 1) . '">cid-1</a>';
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
            echo '<div class="tile is-parent"><article class="tile is-child notification is-info"><p class="title">' . $p . '</p><figure class="image is-4by3">';
            echo '<img src="http://www.beihaiw.com/pic.php?url=http://imgsrc.baidu.com/forum/pic/item/' . $p . '.jpg"></br>';
            echo '</figure></article></div></div>';
        }
        
  
  echo '<a class="button is-primary" href="index.php?mid=' . $mid . '&cid=' . ($cid + 1) . '">cid+1</a>';
  echo '<a class="button is-primary" href="index.php?mid=' . $mid . '&cid=' . ($cid - 1) . '">cid-1</a>';
    } else {
        print '<div class="notification is-danger"><button class="delete"></button>comic not found.</div>';
    }
}

?>
  


</body>
</html>
