<?php

function http_request($url){
    // persiapkan curl
    $ch = curl_init(); 

    // set url 
    curl_setopt($ch, CURLOPT_URL, $url);
    
    // set user agent    
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

    // return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    // $output contains the output string 
    $output = curl_exec($ch); 

    // tutup curl 
    curl_close($ch);      

    // mengembalikan hasil curl
    return $output;
}

$profile = http_request("https://api.github.com/users/aris-presley-aja");

// ubah string JSON menjadi array
$profile = json_decode($profile, TRUE);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Curl Data JSON</title>
</head>

<body>
<div  align="center" top="-150px">
<img src="<?php echo $profile['avatar_url']; ?>" width="512" />
<br>
<p>
Nama: <?php echo $profile["name"] ?><br>
URL: <a href="<?php echo $profile["html_url"] ?>"><?php echo $profile["html_url"] ?></a><br>
Lokasi: <?php echo $profile["location"] ?>
</p>
</div>
</body>
</html>
