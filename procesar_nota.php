<?php
session_start();
include 'db_connect.php';


function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if (isset($_POST['enviar'])) {
    $nombreyapellido = clean_input($_POST['nombreyapellido']);
    $usuario = clean_input($_POST['usuario']);
    $email = clean_input($_POST['email']);
    $nota = clean_input($_POST['nota']);
    $fechanota = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("INSERT INTO notas (nombreyapellido, usuario, email, nota, fechanota) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("sssss", $nombreyapellido, $usuario, $email, $nota, $fechanota);

    if ($stmt->execute()) {

        header("Location: porta.html#notas");
        exit();
    } else {
        echo "Error al agregar nota: " . $stmt->error;
    }
    $stmt->close();
}

if (isset($_GET['eliminar'])) {
    $id = clean_input($_GET['eliminar']);


    $stmt = $conn->prepare("DELETE FROM notas WHERE id = ?");

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {

        header("Location: porta.html#notas");
        exit(); 
    } else {
        echo "Error al eliminar nota: " . $stmt->error;
    }
    $stmt->close();
} 


if (isset($_POST['actualizar'])) {
    $id = clean_input($_POST['id_nota']); 
    $nombreyapellido = clean_input($_POST['nombreyapellido']);
    $usuario = clean_input($_POST['usuario']);
    $email = clean_input($_POST['email']);
    $nota = clean_input($_POST['nota']);

    $stmt = $conn->prepare("UPDATE notas SET nombreyapellido = ?, usuario = ?, email = ?, nota = ? WHERE id = ?");

    $stmt->bind_param("ssssi", $nombreyapellido, $usuario, $email, $nota, $id);

    if ($stmt->execute()) {

        header("Location: porta.html#notas");
        exit();
    } else {
        echo "Error al actualizar nota: " . $stmt->error; 
    }
    $stmt->close();
}

$conn->close();
?>