<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVistaCasProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creamos la vista
        DB::statement("
            CREATE VIEW vista_cas_producto AS
            SELECT
                cp.cas,
                cp.estado,
                cp.fds,
                cp.nombre AS nombre_cas_producto,
                cp.id AS id_cas_producto,
                cp.tipo,
                p.armario,
                p.balda,
                p.caducidad,
                p.capacidad,
                p.concentracion,
                p.tipo_concentracion,
                p.id_producto AS id_producto,
                p.id_cas,
                hp.h AS h_producto,
                hp.id_producto AS id_producto_hp,
                hd.h AS h_desc,
                hd.desc
            FROM
                cas_productos cp
            LEFT JOIN
                productos p ON cp.id = p.id_cas
            LEFT JOIN
                h_producto hp ON p.id_producto = hp.id_producto
            LEFT JOIN
                h_desc hd ON hp.h = hd.h
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Eliminamos la vista
        DB::statement("DROP VIEW IF EXISTS vista_cas_producto");
    }
}
