<?php
error_reporting(E_ALL);
include("./common/dbddconnect.php"); 

$path = 'D:\\share\\A--2021--HackThe6ix\\HackThe6ix2021\\backend\\data\\'; 

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

if(!defined('STDERR')) define('STDERR', fopen('php://stderr', 'wb'));

function saveImageFromUrl( $url ) {
    global $path;
    $fn = "";
    $u = strtolower($url);

    fwrite(STDERR, "saveImageFromUrl(".$url.")\n");

    if( strpos($u, 'data:') !== false) 
    { 
        $pos = strpos($url, ",");
        $data = substr($url, $pos+1);
        $data = base64_decode($data);
 
        $im = imagecreatefromstring($data);
        if ($im !== false) {
            $fn = $path . 'image_tmp.jpg'; 
            imagejpeg($im, $fn);
            imagedestroy($im);
            return $fn;
        }
        return $fn;
    }

    if( strpos($u, 'png') !== false) { $fn = $path . 'image_tmp.jpg'; }
    else if( strpos($u, 'gif') !== false) { $fn = $path . 'image_tmp.jpg'; }
    else if( strpos($u, 'jpeg') !== false) { $fn = $path . 'image_tmp.jpg'; }
    else if( strpos($u, 'jpg') !== false) { $fn = $path . 'image_tmp.jpg'; }
    //else return $fn;
    else  { $fn = $path . 'image_tmp.jpg'; }

    $ch = curl_init($url);
    $fp = fopen($fn, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
    return $fn;
}    


function imagecreatefromfile( $filename ) {
    /*
    if (!file_exists($filename)) {
        throw new InvalidArgumentException('File "'.$filename.'" not found.');
    }
    switch ( strtolower( array_pop( explode('.', substr($filename, 0, strpos($filename, '?'))))) ) {
    */
    switch ( strtolower( pathinfo( $filename, PATHINFO_EXTENSION ))) {
        case 'jpeg':
        case 'jpg':
            return imagecreatefromjpeg($filename);
        break;

        case 'png':
            return imagecreatefrompng($filename);
        break;

        case 'gif':
            return imagecreatefromgif($filename);
        break;

        default:
            throw new InvalidArgumentException('File "'.$filename.'" is not valid jpg, png or gif image.');
        break;
    }
}

$food_id = 0;
function insert_food($name, $type, $shop, $url, $h)
{
    global $con, $food_id;
    $ret = "insert_food";
    $id = 100001;
    if($id > 0)
    {
        $sql ='select id from Food order by id desc limit 1';

        if ( ($result = mysqli_query($con, $sql)) )
        {
            if($row = $result->fetch_assoc()) 
            {
                $id = (int)$row["id"] + 1;
            }
        }
    }

    $sql = "INSERT INTO `Food` (";
    $sql .= "id, name, type, shop, url, mid,"
    .   "h1, h2, h3, h4, h5, h6, h7, h8, h9,"
    .   "h10, h11, h12, h13, h14, h15, h16" ;
    $sql .= ") VALUES (";
    $sql .= '"'.$id.'","'.$name.'","'.$type.'","'.$shop.'","'.$url.'"';
    $sql .= ','.$h[0].','.$h[1].','.$h[2].','.$h[3];
    $sql .= ','.$h[4].','.$h[5].','.$h[6].','.$h[7];
    $sql .= ','.$h[8].','.$h[9].','.$h[10].','.$h[11];
    $sql .= ','.$h[12].','.$h[13].','.$h[14].','.$h[15].','.$h[16];
    $sql .=  ")";

    if (!mysqli_query($con, $sql))
    {
        $ret .= $sql . "    Error description: " . mysqli_error($con) ;
    }
    else{
        $ret .= "insert into Food OK: id = ". $id." name=".$name." ". "type=" . $type . " shop= " . $shop . "   ";
        $food_id = $id;
    }
    return $ret;
}

function getList($h)
{
    //global $data, $condition, $order, $limit, $con;
    global $con;
    $list = array();

    $order = " order by power(" 
        ."(power((".$h[1]/$h[0]. "-h1/mid),2)"
        ."+power((".$h[2]/$h[0]. "-h2/mid),2)"
        ."+power((".$h[3]/$h[0]. "-h3/mid),2)"
        ."+power((".$h[4]/$h[0]. "-h4/mid),2)"
        ."+power((".$h[5]/$h[0]. "-h5/mid),2)"
        ."+power((".$h[6]/$h[0]. "-h6/mid),2)"
        ."+power((".$h[7]/$h[0]. "-h7/mid),2)"
        ."+power((".$h[8]/$h[0]. "-h8/mid),2)"
        ."+power((".$h[9]/$h[0]. "-h9/mid),2)"
        ."+power((".$h[10]/$h[0]. "-h10/mid),2)"
        ."+power((".$h[11]/$h[0]. "-h11/mid),2)"
        ."+power((".$h[12]/$h[0]. "-h12/mid),2)"
        ."+power((".$h[13]/$h[0]. "-h13/mid),2)"
        ."+power((".$h[14]/$h[0]. "-h14/mid),2)"
        ."+power((".$h[15]/$h[0]. "-h15/mid),2)"
        ."+power((".$h[16]/$h[0]. "-h16/mid),2)"
        ."),0.5) ";

    $sql ="select ";
    $sql .= "id, name, type, shop, url, mid,"
    .   "h1, h2, h3, h4, h5, h6, h7, h8, h9, h10,"
    .   "h11, h12, h13, h14, h15, h16" 
    .   " from Food  ". $order . " limit 0,6";

    //$data->ql = $sql;

    if (!($result=mysqli_query($con,$sql)))
    {
        echo $sql . "<br>";
        echo "Error description: " . mysqli_error($con) ;
        echo "<br><br>";
        return $list;
    }
    while($row = $result->fetch_assoc()) 
    {
        $values = array($row["mid"]);
        array_push($values, $row["h1"]);
        array_push($values, $row["h2"]);
        array_push($values, $row["h3"]);
        array_push($values, $row["h4"]);
        array_push($values, $row["h5"]);
        array_push($values, $row["h6"]);
        array_push($values, $row["h7"]);
        array_push($values, $row["h8"]);
        array_push($values, $row["h9"]);
        array_push($values, $row["h10"]);
        array_push($values, $row["h11"]);
        array_push($values, $row["h12"]);
        array_push($values, $row["h13"]);
        array_push($values, $row["h14"]);
        array_push($values, $row["h15"]);
        array_push($values, $row["h16"]);

        $record = new stdClass();
        $record->id = $row["id"];
        $record->name = $row["name"];
        $record->type = $row["type"];
        $record->shop = $row["shop"];
        $record->link = $row["url"];
        $record->values = $values;
        array_push($list, $record);

    }
    return $list;
}


$response = new stdClass();
$response->code = 1;
$response->message = "";
$response->ok = true;
$response->data = new stdClass();

$url = "";
$image = null;
$output = null;

$input = file_get_contents('php://input');
$queries = json_decode($input);    
$response->code = 2;
if($queries != null)
{
    $response->code = 3;
    if(property_exists($queries, 'url'))
    {
        $response->code = 4;
        $url = $queries->url;
        $response->data->url = $url;
        $response->data->cmd = $queries->cmd;
        $response->data->type = $queries->type;
        $response->data->name = $queries->name;
        $response->data->shop = $queries->shop;
        $response->data->link = $queries->link;

        $fn = saveImageFromUrl($url);
        $image_0 = imagecreatefromfile($fn);

        $new_width = 320;
        $new_height = 200;
        $image = imagecreatetruecolor($new_width, $new_height);  // Resample
        $width = imagesx($image_0); 
        $height = imagesy($image_0); 
        imagecopyresampled($image, $image_0, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        $fb = $path . 'image_tmp.bmp';
        imagebmp($image, $fb);
        $cmdline = 'getImageSignature.exe "' . $fb . '"';
        $output = shell_exec($cmdline);
        $pos = strpos($output, "data:");
        $h = null;
        if($pos !== false)
        {
            $response->code = 5;
            $h = explode(',', substr($output, $pos + 5));
            if($response->data->cmd == "add")
            {
                $response->data->add = insert_food($response->data->name, $response->data->type, $response->data->shop, $response->data->link, $h);
                $response->code = 0;
                $fj = $path . 'img_'.$food_id.'.jpg';
                imagejpeg($image, $fj);
            }
            else if($response->data->cmd == "search")
            {
                $response->data->list = getList($h);
                $response->code = 0;
            }
        }
    }
}

$response->data->output = $output;

echo json_encode($response);

include("./common/dbddclose.php");

?>