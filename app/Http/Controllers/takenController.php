<?php
 
$action = $_POST['action'];
 
if($action == "create"){
 
    //variabelen
    $title = $_POST['title'];
    $$beschrijving = $_POST['beschrijving'];
    $afdeling = $_POST['afdeling'];
    $status = $_POST['status'];
    $prioriteit = $_POST['prioriteit'];
    $deadline = $_POST['deadline'];
    $user = $_POST['user'];
    $created_at = $_POST['created_at'];
 
    //validatie
    if(empty($title)){
    $errors[] = "Please enter task name!";
    }
    if(empty($afdeling)){
    $errors[] = "Please select a department!";
    }
 
    require_once '../../../backend/conn.php';
 
    $query = "INSERT INTO taken (titel, beschrijving, afdeling, status, prioriteit, deadline, user_id, created_at) VALUES ('$title', '$beschrijving', '$afdeling', '$status', '$prioriteit', '$deadline', '$user_id', '$created_at')";
 
    $statement = $conn->prepare($query);
 
    $statement->execute([
        ':title' => $title,
        ':beschrijving' => $beschrijving,
        ':afdeling' => $afdeling,
        ':status' => $status,
        ':prioriteit' => $prioriteit,
        ':deadline' => $deadline,
        ':user' => $user,
        ':created_at' => $created_at
    ]);
 
    header("Location: $base_url/index.php");
 
 
} elseif($action == "edit"){
   
    //variabelen
    $title = $_POST['title'];
    $beschrijving = $_POST['beschrijving'];
    $afdeling = $_POST['afdeling'];
    $status = $_POST['status'];
    if(isset($_POST['prioriteit']))
    {
        $prioriteit = $_POST['Priority'];
    } else {
        $prioriteit = "Not priority";
    }
    $deadline = $_POST['deadline'];
    $user = $_POST['user'];
   $created_at = $_POST['created_at'];
 
    require_once '../../../backend/conn.php';
 
    $query = "UPDATE taken SET titel = '$title', beschrijving = '$beschrijving', afdeling = '$afdeling', status = '$status', prioriteit = '$prioriteit', deadline = '$deadline' WHERE id = :id";
 
        $statement->execute([
        ':title' => $title,
        ':beschrijving' => $beschrijving,
        ':afdeling' => $afdeling,
        ':status' => $status,
        ':prioriteit' => $prioriteit,
        ':deadline' => $deadline,
        ':user' => $user,
        ':created_at' => $created_at
    ]);
 
    header("Location: $base_url/index.php");
 
} elseif($action == "delete"){
   
    require_once '../../../backend/conn.php';

    $query = "DELETE FROM taken WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ':id' => $_POST['id']
    ]);
 
    header("Location: $base_url/index.php");
 
}
 