<?php

/**
 * Plugin Name: BaseDatosMalsonantes
 *
 * Plugin URI: http://wordpress.org/plugins/BaseDatosMalsonantes/
 *
 * Description: Cambia malsonantes por otras cosas
 *
 * Version: 1.0
 *
 * Author: Sergio Mendez
 *
 * Author URI: http://jacko
 */


function createTables() {

    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name1 = $wpdb->prefix . 'palabrasMalsonantes';
    $table_name2 = $wpdb->prefix . 'cambios';

    $sql = "CREATE TABLE $table_name1 (
        id mediumint(9) NOT NULL,
        text text NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    $sql2 = "CREATE TABLE $table_name2 (
        id mediumint(9) NOT NULL,
        text text NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    dbDelta( $sql2 );
}
add_action('plugins_loaded', 'createTables');


function insertValuesTablas() {
    global $wpdb;
    $table_name1 = $wpdb->prefix . 'palabrasMalsonantes';
    $table_name2 = $wpdb->prefix . 'cambios';

    $sqlvalor1 = "INSERT INTO $table_name1 (id, text) VALUES (1, 'mierda')";
    $sqlvalor2 = "INSERT INTO $table_name1 (id, text) VALUES (2, 'jodido')";
    $sqlvalor3 = "INSERT INTO $table_name1 (id, text) VALUES (3, 'follón')";
    $sqlvalor4 = "INSERT INTO $table_name1 (id, text) VALUES (4, 'lerdo')";
    $sqlvalor5 = "INSERT INTO $table_name1 (id, text) VALUES (5, 'nabo')";

    $sqlvalor12 = "INSERT INTO $table_name2 (id, text) VALUES (1, 'caca')";
    $sqlvalor22 = "INSERT INTO $table_name2 (id, text) VALUES (2, 'duro')";
    $sqlvalor32 = "INSERT INTO $table_name2 (id, text) VALUES (3, 'problema')";
    $sqlvalor42 = "INSERT INTO $table_name2 (id, text) VALUES (4, 'tonto')";
    $sqlvalor52 = "INSERT INTO $table_name2 (id, text) VALUES (5, 'pito')";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sqlvalor1);
    dbDelta( $sqlvalor2);
    dbDelta( $sqlvalor3);
    dbDelta( $sqlvalor4);
    dbDelta( $sqlvalor5);

    dbDelta( $sqlvalor12);
    dbDelta( $sqlvalor22);
    dbDelta( $sqlvalor32);
    dbDelta( $sqlvalor42);
    dbDelta( $sqlvalor52);
}
add_action('plugins_loaded', 'insertValuesTable');


function cambioMalsonantes( $text ) {
    global $wpdb;
    $table_palabrasmalsonantes = $wpdb->prefix . 'malsonantes';
    $table_cambios = $wpdb->prefix . 'cambios';

    $queryPalabrasMalsonantes = $wpdb->get_results( "SELECT text FROM $table_palabrasmalsonantes");
    $queryCambios = $wpdb->get_results("SELECT text FROM $table_cambios");

    $malsonantes = array();
    for ($i = 0; $i < sizeof($queryPalabrasMalsonantes); $i++) {
        $malsonantes[] = $queryPalabrasMalsonantes[$i]->text;
    }

    $cambios = array();
    for ($i = 0; $i < sizeof($queryCambios); $i++) {
        $cambios[] = $queryCambios[$i]->text;
    }

    return str_replace( $malsonantes, $cambios, $text);
}
add_filter('the_content', 'cambiomalsonantes');