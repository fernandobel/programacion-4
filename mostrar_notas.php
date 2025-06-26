<?php
include 'db_connect.php'; 

$sql = "SELECT id, nombreyapellido, usuario, email, nota, fechanota FROM notas ORDER BY fechanota DESC";
$result = $conn->query($sql); 

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        echo "<div class='note-item'>"; 
        echo "<p><strong>Nombre:</strong> " . htmlspecialchars($row['nombreyapellido']) . "</p>";
        if (!empty($row['usuario'])) { 
            echo "<p><strong>Usuario:</strong> " . htmlspecialchars($row['usuario']) . "</p>";
        }
        echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
        echo "<p><strong>Nota:</strong> " . nl2br(htmlspecialchars($row['nota'])) . "</p>"; 
        echo "<p class='note-date'>Fecha: " . htmlspecialchars($row['fechanota']) . "</p>"; 
        echo "<div class='note-actions'>"; 
        echo "<a href='porta.html?editar=" . $row['id'] . "#notas' class='btn-edit'>Editar</a>";

        echo "<a href='procesar_nota.php?eliminar=" . $row['id'] . "' class='btn-delete' onclick=\"return confirm('¿Estás seguro de que quieres eliminar esta nota?');\">Eliminar</a>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>No hay notas aún.</p>"; 
}
$conn->close();
?>