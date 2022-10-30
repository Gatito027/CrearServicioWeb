<?php
include 'conexion.php';
$pdo=new conexion();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id'])){
        $sql=$pdo->prepare('CALL sp_obtenerUsuario(:id);');
        $sql->bindValue(':id', $_GET['id']);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header ("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit;
    }else{
        $sql=$pdo->prepare('CALL ObtenerUsuarios();');
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header ("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit;
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql='CALL insertarUsuario(:nombre,:apePaterno,:apeMaterno,:email,:telefono,:status);';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nombre', $_POST['nombre']);
    $stmt->bindValue(':apePaterno', $_POST['apePaterno']);
    $stmt->bindValue(':apeMaterno', $_POST['apeMaterno']);
    $stmt->bindValue(':email', $_POST['email']);
    $stmt->bindValue(':telefono', $_POST['telefono']);
    $stmt->bindValue(':status', $_POST['status']);
    $stmt->execute();
    $idPost=$pdo->lastInsertId();
    if($idPost){
        header("HTTP/1.1 200 OK");
        echo json_encode($idPost);
        exit;
    }
}
if($_SERVER['REQUEST_METHOD'] == 'PUT'){
    $sql='CALL actualizarUsuario(:id,:nombre,:apePaterno,:apeMaterno,:email,:telefono,:status);';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nombre', $_GET['nombre']);
    $stmt->bindValue(':apePaterno', $_GET['apePaterno']);
    $stmt->bindValue(':apeMaterno', $_GET['apeMaterno']);
    $stmt->bindValue(':email', $_GET['email']);
    $stmt->bindValue(':telefono', $_GET['telefono']);
    $stmt->bindValue(':status', $_GET['status']);
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
    header("HTTP/1.1 200 OK");
    exit;
}
if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    $sql='CALL eliminarUsuario(:id);';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
    header("HTTP/1.1 200 OK");
    exit;
}
header("HTTP/1.1 400 Error no se ha encontrado el metodo");
?>