<?php
// Generar nuevo hash para admin123
$password = 'admin123';
$hash = password_hash($password, PASSWORD_BCRYPT);

echo "<h1>Nuevo Hash Generado</h1>";
echo "<p><strong>Password:</strong> $password</p>";
echo "<p><strong>Hash:</strong> <code>$hash</code></p>";

echo "<h2>SQL para actualizar:</h2>";
echo "<pre>";
echo "UPDATE ost_staff SET passwd='$hash' WHERE username='admin';";
echo "</pre>";

echo "<h2>Verificación:</h2>";
if (password_verify($password, $hash)) {
    echo "<p style='color:green;'>✓ Password verificado correctamente</p>";
} else {
    echo "<p style='color:red;'>✗ Error en verificación</p>";
}
?>
