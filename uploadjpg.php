<?php
// define('UPLOAD_DIR', 'vendor/');
// $img = $_POST['base64image'];
// $img = str_replace('data:image/jpeg;base64,', '', $img);
// $img = str_replace(' ', '+', $img);
// $data = base64_decode($img);
// $unikName 	= gmdate('ymdHis',time()+60*60*7);
// $fileup = UPLOAD_DIR .$unikName. '.jpg';
// $success = file_put_contents($fileup, $data);


$unikName 	= gmdate('ymdHis',time()+60*60*7);
$fileup = $unikName. '.jpg';

move_uploaded_file($_FILES['webcam']['tmp_name'],'vendor/'.$fileup)

// print $success ? $file : 'Unable to save the file.';
?>