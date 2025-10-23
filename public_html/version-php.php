<?php
echo "<h1>Versión de PHP Actual</h1>";
echo "<h2 style='color: " . (version_compare(PHP_VERSION, '8.0.0') >= 0 ? 'red' : 'green') . ";'>";
echo "PHP " . PHP_VERSION;
echo "</h2>";
echo "<p><strong>Nota:</strong> Para osTicket, necesitas PHP 7.4.x (verde). Si ves PHP 8.x (rojo), cambia la versión en Laragon.</p>";
?>
