<?php
$dossier     = 'files/';
$fichier     = basename($_FILES['file']['name']);
$taille_maxi = 1024 * 1024 * 20;
$taille      = filesize($_FILES['file']['tmp_name']);
$extensions  = array('.png', '.gif', '.jpg', '.jpeg');
$extension   = strrchr($_FILES['file']['name'], '.');

$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . "/dist/upload/files";

//Début des vérifications de sécurité...
if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
    $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
}
if ($taille > $taille_maxi) {
    $erreur = 'Le fichier est trop gros...';
}
if (!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
    //On formate le nom du fichier ici...
    $fichier = strtr($fichier,
        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
    {
        //echo 'Upload effectué avec succès !';
        print json_encode(["filename" => $actual_link . "/" . $fichier]);
    } else //Sinon (la fonction renvoie FALSE).
    {
        print json_encode('Echec de l\'upload !');
    }
} else {
    print json_encode($erreur);
}
?>

