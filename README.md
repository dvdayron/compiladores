# Instalacion y ejecucion

# Copiar dll de la extension Parle de php (adjunta en la carpeta ext)

Copiar php_parle.dll en la carpeta de extensiones de su servidor de php, en mi caso uso xampp
C:\xampp\php\ext -> php_parle.dll

# Agregar la referencia en php.init

extension=php_parle
--enable-parle=true
--enable-parle-utf32=true

# Reiniciar su servidor

# Acceder al programa

En mi local por ejemplo http://localhost/compiladores/analisis-lexico.php

# Dudas

Escribir al email dvdayron@gmail.com