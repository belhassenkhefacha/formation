<?php
    function nav_item(string $lien,string $titre,string $linkclass=''):string 
        {   
        $classe='nav_item';
        if($_SERVER['SCRIPT_NAME']===$lien){
            $classe .='active';
        }
        return <<<HTML
        <li class="$classe">
            <a class="$linkclass" href="$lien">$titre</a>
        </li>
    HTML;
        }
    

    function nav_menu(string $linkclass=''):string 
    {
        return 
            nav_item('/index.php','Acceuil',$linkclass).
            nav_item('/menu.php','Menu',$linkclass).
            nav_item('/newsletter.php','S"inscrire',$linkclass).
            nav_item('/contact.php','Contact',$linkclass);
    }

    function checkbox(string $name,string $value,array $data):string 
    {
        $attributes='';
        if(isset($data[$name]) && in_array($value,$data[$name]))
        $attributes.='checked';
        return <<<HTML
        <input type="checkbox" name="{$name}[]" value="$value">
    HTML;
    }

    function radio(string $name,string $value,array $data):string
    {
        $attributes='';
        if(isset($data[$name]) && in_array($value,$data[$name]))
        $attributes.='checked';
        return <<<HTML
        <input type="radio" name="{$name}[]" value="$value">
    HTML;
    }

    function creneaux_html(array $creneaux){
        $phrases=[];
        if(empty($creneaux)){
            return 'Fermé';
        }
        foreach($creneaux as $creneau){
            $phrases[]="de {$creneau[0]}h a {$creneau[1]}h";
        }
        return 'Ouvert '.implode(' et ',$phrases);
        //construire tableau intermediaire
        //de Xh a Yh
        //implode pour construire la phrase finale
    }

    function in_creneaux(int $heure, array $creneaux):bool {
        foreach($creneaux as $creneau){
            if($heure >= $creneau[0] && $heure <= $creneau[1])
            {
                return true;
            }
        }
        return false;
    }
    ?>
