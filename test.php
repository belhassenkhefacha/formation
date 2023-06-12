<?php
$fichier = __DIR__.DIRECTORY_SEPARATOR.'demo.txt';
$size=@file_put_contents($fichier,'belhassen',FILE_APPEND);
if($size===false){
    echo 'impossible d"ecrire dans le fichier';
}else{
    echo 'ecriture réussite';
}
file_get_contents($fichier);
$resource=fopen($fichier,'r');
$k=0;
while($line = fgets($resource)){
    $k++;
    if($k==1){
        fwrite($resource,'hi');
        break;
    }
}
echo fread($resource,2);
var_dump(fstat($resource));
fclose($fichier);
?>