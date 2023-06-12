<?php
function ajouter_vue(){
    //verifier si le fichier compteur existe 
    //si oui on angmente
    //snn le compteur=1
    $fichier=dirname(__DIR__).DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'compteur';
    $fichier_journalier=$fichier.'-'.date('Y-m-d');
    incrementer_compteur($fichier);
    incrementer_compteur($fichier_journalier);
}

function incrementer_compteur(string $fichier){
    $compteur=1;
    if(file_exists($fichier)){
        
        $compteur=(int)file_get_contents($fichier);
        $compteur++;
        file_put_contents($fichier,$compteur);
    }
}

function nombre_vues():string{
    $fichier=dirname(__DIR__).DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'compteur';
    return file_get_contents($fichier);
}

function nombre_vues_mois(int $annee,int $mois){
    $mois=str_pad($mois,2,'0');
    $fichier=dirname(__DIR__).DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'compteur-' .$annee. '-'.$mois;
}
?>