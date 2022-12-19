<?php
/*
Plugin Name: Palabras Malsonantes

Plugin URI: http://wordpress.org/plugins/malsonantes/

Description: Este plugin cambia unas palabras malsonantes por otras

Author: Sergio Mendez

Version: 1.0

Author URI: http://jack.sir/
*/

function cambiar_malsonantes( $text){

    $palabrasMalsonantes= ["mierda","jodido","follón","lerdo","nabo"];

    $cambios = ["caca","duro","problema","bobo","pito"];

    return str_replace($palabrasMalsonantes , $cambios, $text);
}
/*
 * Cambia el contenido del post
 */

add_filter('the_content', 'cambiar_malsonantes');
