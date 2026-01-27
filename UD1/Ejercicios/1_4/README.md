# Actividad 1.4. Validación y saneamiento.
## [1. Validar un email y mostrar mensaje](e01.php)
* Recibir un email por POST.
* Validar si es un email válido.
* Mostrar “Email válido” o “Email NO válido”.
## [2. Saneamiento de texto con caracteres especiales](e02.php)
* Recibir un texto con etiquetas HTML.
* Sanitizar el texto usando FILTER_SANITIZE_SPECIAL_CHARS.
* Mostrar el texto limpio en pantalla.
## [3. Validar edad con rango](e03.php)
* Recibir edad por POST.
* Validar que sea un entero entre 18 y 65.
* Mostrar si la edad es válida o no.
## [4. Saneamiento y validación de URL](e04.php)
* Recibir una URL.
* Saneala con FILTER_SANITIZE_URL.
* Validar si la URL es válida.
* Mostrar el resultado.
## [5. Validar IP con flags](e05.php)
* Recibir una dirección IP.
* Validar que sea IPv4 o IPv6.
* Validar que no sea una IP privada ni reservada (usar flags).
* Mostrar el resultado.
## [6. Validar y sanear número flotante](e06.php)
* Recibir un número decimal como string.
* Sanear para eliminar caracteres no numéricos.
* Validar que sea un número decimal válido.
* Mostrar el número validado.
## [7. Validar nombre con expresión regular](e07.php)
* Recibir un nombre.
* Validar que solo contenga letras y espacios usando FILTER_VALIDATE_REGEXP.
* Mostrar si el nombre es válido.
## [8. Saneamiento de texto completo](e08.php)
* Recibir texto con caracteres HTML, etiquetas y scripts.
* Usar FILTER_SANITIZE_FULL_SPECIAL_CHARS para limpiar.
* Mostrar el texto resultante.
## [9. Validar booleanos con distintos valores](e09.php)
* Recibir una variable que pueda ser “true”, “false”, 1, 0, “yes”, “no”.
* Validar usando FILTER_VALIDATE_BOOLEAN con opciones para aceptar “yes” y “no”.
* Mostrar el valor booleano resultante.
## [10. Validar y sanear formulario completo](e10.php)
* Recibir un formulario con: nombre, email, edad, web personal.
* Sanea cada campo con el filtro adecuado.
* Valida los campos.
* Muestra errores o confirma datos válidos.