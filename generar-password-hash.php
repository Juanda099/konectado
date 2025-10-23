<?php
/**
 * Generador de Hash de Contraseña para osTicket
 * Usa el mismo algoritmo que osTicket (bcrypt)
 */

// Contraseña que quieres usar
$password = 'Admin123!';

// Generar hash compatible con osTicket
$hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 8]);

echo "==============================================\n";
echo "HASH DE CONTRASEÑA PARA OSTICKET\n";
echo "==============================================\n\n";
echo "Contraseña: $password\n";
echo "Hash bcrypt: $hash\n\n";
echo "==============================================\n";
echo "CÓMO USAR:\n";
echo "==============================================\n";
echo "1. Abre phpMyAdmin en tu hosting\n";
echo "2. Base de datos: konectando_pqr\n";
echo "3. Tabla: ost_staff\n";
echo "4. Busca usuario: admin\n";
echo "5. Edita el campo 'passwd'\n";
echo "6. Pega el hash de arriba\n";
echo "7. Guarda\n";
echo "8. Login con: admin / $password\n";
echo "==============================================\n";
?>
