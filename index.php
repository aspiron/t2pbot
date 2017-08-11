<?php
ini_set("log_errors", 1);
ini_set("error_log", __DIR__."/error_log");

ob_start();

define('API_KEY','tokenname');// your API KEY here ...
$update = json_decode(file_get_contents('php://input'));
function makeHTTPRequest($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

if(isset($update->message)){
    $text = $update->message->text;
  // $chat_id = $update->message->chat->id;
    if($text == "/start" || $text == '/help'){
        makeHTTPRequest('sendMessage',[
            'chat_id'=>$update->message->chat->id,
            'text'=>'<b>T2P botga xush kelibsiz</b>

▪️Bu bot sizning yozuvlaringizni rasmga aylantiradi.

▪️bu botdan to`g`ri yo`lda foydalaning.

▪️menga:
<b>Ismingiz Qiladigan ishingiz va Bog`lanish
mumkin bo`lgan manzilni
yozing ularni "|" ushbu belgi bilan ajrating</b>,
yuboring va natijani mendan oling :)

▪️men bilan bog`lanmoqchimisiz?
<a href="https://telegram.me/aspiron">Bemalol yozavering !</a>',
            'parse_mode'=>'HTML',
            'disable_web_page_preview'=>true
        ]);
        return false;
    }

  else{
    



$xabarloop = explode("|", $text);
$name = $xabarloop[0];
$job = $xabarloop[1];
$mail = $xabarloop[2];




// link to the font file no the server
$fontname = 'font/Capriola-Regular.ttf';
// controls the spacing between text
$i=30;
//JPG image quality 0-100
$quality = 90;

function create_image($user){

        global $fontname;   
        global $quality;
        $file = "covers/".$user[0]['name'].".jpg";  
    
    // if the file already exists dont create it again just serve up the original   
    //if (!file_exists($file)) {    
            

            // define the base image that we lay our text on
            $im = imagecreatefromjpeg("pass.jpg");
            
            // setup the text colours
            $color['grey'] = imagecolorallocate($im, 54, 56, 60);
            $color['green'] = imagecolorallocate($im, 55, 189, 102);
            
            // this defines the starting height for the text block
            $y = imagesy($im) - $height - 365;
             
        // loop through the array and write the text    
        foreach ($user as $value){
            // center the text in our image - returns the x value
            $x = center_text($value['name'], $value['font-size']);  
            imagettftext($im, $value['font-size'], 0, $x, $y+$i, $color[$value['color']], $fontname,$value['name']);
            // add 32px to the line height for the next text block
            $i = $i+32; 
            
        }
            // create the image
            imagejpeg($im, $file, $quality);
            
    //}
                        
        return $file;   
}

function center_text($string, $font_size){

            global $fontname;

            $image_width = 800;
            $dimensions = imagettfbbox($font_size, 0, $fontname, $string);
            
            return ceil(($image_width - $dimensions[4]) / 2);               
}




    $user = array(
    
        array(
            'name'=> $name, 
            'font-size'=>'27',
            'color'=>'grey'),
            
        array(
            'name'=> $job,
            'font-size'=>'16',
            'color'=>'grey'),
            
        array(
            'name'=> $mail,
            'font-size'=>'13',
            'color'=>'green'
            )
            
    );

create_image($user);
// $ids = rand("0,1292938");
// $image2 = $image."?id=".$ids;


    // $theSticker = $image2;

    // $tmpFile = tmpfile();
    // fwrite($tmpFile,$theSticker);
    // fseek($tmpFile,0);

    // $meta = stream_get_meta_data($tmpFile);
    // $filePath = $meta['uri'];
    
$aspimg = "yourwebsite/path/covers/".$user[0]['name'].".jpg";

    /**
     * end Making the Sticker
     */


    var_dump(makeHTTPRequest('sendPhoto',[
       'chat_id'=>$update->message->chat->id,
        'photo'=>$aspimg
    ]));

}

}



file_put_contents('the_log',ob_get_clean());
