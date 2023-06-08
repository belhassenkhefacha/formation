<?php
include 'functions.php';
//les variables
$prenom='xxx';
$nom = 'Marc';
echo $nom."\n";
$note=10;
$note2=15;
$moyenne=(($note+$note2)/2);
//les tableaux
$notes=[10,20,9,4,-2];
echo $notes[3]."\n"; 
$eleve=['Marc','DOE',[20,10,6]];
echo $eleve[2][0]."\n";
$elv=[
    'nom' => 'Doe',
    'prenom' => 'Marc', 
    'notes' => [10,20,15]
    ];
$elv['notes'][3]=16;
echo $elv['prenom'].' '.$elv['nom'].' a une note '.$elv['notes'][3]."\n";
//les conditions
$note= (int)readline('Entrez votre note :');
if($note>10){
    echo 'superieur a la moyenne ';
}else if($note==10){
    echo 'vous avez juste la moyenne ';
}else{
    echo 'inferieur a la moyenne ';
}
//les boucles
$creneaux=[];
while(true){
    $deb=(int)readline('heure d"ouverture');
    $fin=(int)readline('heure de fermeture');
    if($deb >= $fin){
        echo 'impossible';
    }else{
        $creneaux=[$deb,$fin];
        $action = readline('voulez vous enregistrer un nouveau creneau (o/n)');
        if($action === 'n'){
            break;
        }
    }
}

$heure=(int)readline("A qu'elle heure voulez vous visiter le magasin");
$creneauTrouve=false;

foreach($creneaux as $creneau){
    if($heure>=$creneau[0] && $heure<=$creneau[1]){
        $creneauTrouve=true;
        break;
    }
}

if($creneauTrouve){
    echo 'le magasin sera ouvert';
}else{
    echo 'desole le magasin est ferme';
}
//les fonctions
$not=[20,16,4];
$som=array_sum($not);
$moy=$som/count($not);
echo "Vous avez ".round($moy)." de moyenne\n";
$nottri=sort($not);
$notreversed=array_reverse($not);
print_r($not);
print_r($notreversed);
$insultes=['xxx','con'];
$asterisque=[];
foreach($insultes as $insulte){
    $lettre=substr($insulte,0,1);
    $asterisque[]=$lettre.' '.str_repeat('*',strlen($insulte)-1);
}
$phrase=readline('Entrez une phrase');
$phrase=str_replace($insultes,$asterisque,$phrase);
echo $phrase;
//les fonctions utilisateurs
function bonjour($nom){
    echo"Bonjour ".$nom."\n";
}
bonjour("Belhassen");
bonjour("xxx");
function repondre_oui_non($msg){
    while(true)
    {
        $response=readline('Entrez le choix');
        if(strtolower($response) == 'o')
        {
            return true;
        }else{
            return false;
        }   
    }
}

$res=repondre_oui_non('voulez vous continuer');
echo $res;

$tab = [5, 9, -2, 0, 18, 20, 36];

function maxx($tab) {
    $m = $tab[0];
    for ($i = 1; $i < count($tab); $i++) {
        if ($tab[$i] > $m) {
            $m = $tab[$i];
        }
    }
    return $m;
}

$maxtab = maxx($tab);
echo $maxtab;
//include & require(functions.php)
echo 'Demo de texte';
var_dump(repondre_oui_non('Test'));


?>