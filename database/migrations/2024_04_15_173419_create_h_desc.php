<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('h_desc', function (Blueprint $table) {
            $table->string('h', 10)->primary(); // Definir el campo 'h' como varchar de longitud 10 y clave primaria
            $table->string('desc', 300);
            $table->timestamps();
        });

        DB::table('h_desc')->insert([
            ['h' => 'H200', 'desc' => 'Explosivo inestable.'],
            ['h' => 'H201', 'desc' => 'Explosivo; peligro de explosión en masa.'],
            ['h' => 'H202', 'desc' => 'Explosivo; grave peligro de proyección.'],
            ['h' => 'H203', 'desc' => 'Explosivo; peligro de incendio, de onda expansiva o de proyección.'],
            ['h' => 'H204', 'desc' => 'Peligro de incendio o de proyección.'],
            ['h' => 'H205', 'desc' => 'Peligro de explosión en masa en caso de incendio.'],
            ['h' => 'H206', 'desc' => '¡Atención! No utilizar junto con otros productos. Puede desprender gases peligrosos (cloro).'],
            ['h' => 'H207', 'desc' => '¡Atención! Contiene cadmio. Durante su utilización se desprenden vapores peligrosos. Ver la información facilitada por el fabricante. Seguir las instrucciones de seguridad.'],
            ['h' => 'H208', 'desc' => 'Contiene . Puede provocar una reacción alérgica.'],
            ['h' => 'H209', 'desc' => 'Puede inflamarse fácilmente al usarlo.'],
            ['h' => 'H209A', 'desc' => 'Puede inflamarse al usarlo.'],
            ['h' => 'H210', 'desc' => 'Puede solicitarse la ficha de datos de seguridad.'],
            ['h' => 'H220', 'desc' => 'Gas extremadamente inflamable.'],
            ['h' => 'H221', 'desc' => 'Gas inflamable.'],
            ['h' => 'H222', 'desc' => 'Aerosol extremadamente inflamable.'],
            ['h' => 'H223', 'desc' => 'Aerosol inflamable.'],
            ['h' => 'H224', 'desc' => 'Líquido y vapores extremadamente inflamables.'],
            ['h' => 'H225', 'desc' => 'Líquido y vapores muy inflamables.'],
            ['h' => 'H226', 'desc' => 'Líquidos y vapores inflamables.'],
            ['h' => 'H228', 'desc' => 'Sólido inflamable.'],
            ['h' => 'H240', 'desc' => 'Peligro de explosión en caso de calentamiento.'],
            ['h' => 'H241', 'desc' => 'Peligro de incendio o explosión en caso de calentamiento.'],
            ['h' => 'H242', 'desc' => 'Peligro de incendio en caso de calentamiento.'],
            ['h' => 'H250', 'desc' => 'Se inflama espontáneamente en contacto con el aire.'],
            ['h' => 'H251', 'desc' => 'Se calienta espontáneamente; puede inflamarse.'],
            ['h' => 'H252', 'desc' => 'Se calienta espontáneamente en grandes cantidades; puede inflamarse.'],
            ['h' => 'H260', 'desc' => 'En contacto con el agua desprende gases inflamables que pueden inflamarse espontáneamente.'],
            ['h' => 'H261', 'desc' => 'En contacto con el agua desprende gases inflamables.'],
            ['h' => 'H270', 'desc' => 'Puede provocar o agravar un incendio; comburente.'],
            ['h' => 'H271', 'desc' => 'Puede provocar un incendio o una explosión; muy comburente.'],
            ['h' => 'H272', 'desc' => 'Puede agravar un incendio; comburente.'],
            ['h' => 'H280', 'desc' => 'Contiene gas a presión; peligro de explosión en caso de calentamiento.'],
            ['h' => 'H281', 'desc' => 'Contiene gas refrigerado; puede provocar quemaduras o lesiones criogénicas.'],
            ['h' => 'H290', 'desc' => 'Puede ser corrosivo para los metales.'],
            ['h' => 'H300', 'desc' => 'Mortal en caso de ingestión.'],
            ['h' => 'H301', 'desc' => 'Tóxico en caso de ingestión.'],
            ['h' => 'H302', 'desc' => 'Nocivo en caso de ingestión.'],
            ['h' => 'H304', 'desc' => 'Puede ser mortal en caso de ingestión y de penetración en las vías respiratorias.'],
            ['h' => 'H310', 'desc' => 'Mortal en contacto con la piel.'],
            ['h' => 'H311', 'desc' => 'Tóxico en contacto con la piel.'],
            ['h' => 'H312', 'desc' => 'Nocivo en contacto con la piel.'],
            ['h' => 'H314', 'desc' => 'Provoca quemaduras graves en la piel y lesiones oculares graves.'],
            ['h' => 'H315', 'desc' => 'Provoca irritación cutánea.'],
            ['h' => 'H317', 'desc' => 'Puede provocar una reacción alérgica en la piel.'],
            ['h' => 'H318', 'desc' => 'Provoca lesiones oculares graves.'],
            ['h' => 'H319', 'desc' => 'Provoca irritación ocular grave.'],
            ['h' => 'H330', 'desc' => 'Mortal en caso de inhalación.'],
            ['h' => 'H331', 'desc' => 'Tóxico en caso de inhalación.'],
            ['h' => 'H332', 'desc' => 'Nocivo en caso de inhalación.'],
            ['h' => 'H334', 'desc' => 'Puede provocar síntomas de alergia o asma o dificultades respiratorias en caso de inhalación.'],
            ['h' => 'H335', 'desc' => 'Puede irritar las vías respiratorias.'],
            ['h' => 'H336', 'desc' => 'Puede provocar somnolencia o vértigo.'],
            ['h' => 'H340', 'desc' => 'Puede provocar defectos genéticos <Indíquese la vía de exposición si se ha demostrado concluyentemente que el peligro no se produce por ninguna otra vía>.'],
            ['h' => 'H341', 'desc' => 'Se sospecha que provoca defectos genéticos <Indíquese la vía de exposición si se ha demostrado concluyentemente que el peligro no se produce por ninguna otra vía>.'],
            ['h' => 'H350', 'desc' => 'Puede provocar cáncer <indíquese la vía de exposición si se ha demostrado concluyentemente que el peligro no se produce por ninguna otra vía>.'],
            ['h' => 'H351', 'desc' => 'Se sospecha que provoca cáncer <indíquese la vía de exposición si se se ha demostrado concluyentemente que el peligro no se produce por ninguna otra vía>.'],
            ['h' => 'H360', 'desc' => 'Puede perjudicar la fertilidad o dañar al feto <indíquese el efecto específico si se conoce> <indíquese la vía de exposición si se ha demostrado concluyentemente que el peligro no se produce por ninguna otra vía>.'],
            ['h' => 'H361', 'desc' => 'Se sospecha que puede perjudicar la fertilidad o dañar el feto <indíquese el efecto específico si se conoce> <indíquese la vía de exposición si se ha demostrado concluyentemente que el peligro no se produce por ninguna otra vía>.'],
            ['h' => 'H362', 'desc' => 'Puede perjudicar a los niños alimentados con leche materna.'],
            ['h' => 'H370', 'desc' => 'Provoca daños en los órganos <o indíquense todos los órganos afectados, si se conocen> <indíquese la vía de exposición si se ha demostrado concluyentemente que el peligro no se produce por ninguna otra vía>.'],
            ['h' => 'H371', 'desc' => 'Puede provocar daños en los órganos <o indíquense todos los órganos afectados, si se conocen> <indíquese la vía de exposición si se ha demostrado concluyentemente que el peligro no se produce por ninguna otra vía>.'],
            ['h' => 'H372', 'desc' => 'Provoca daños en los órganos <indíquense todos los órganos afectados, si se conocen> tras exposiciones prolongadas o repetidas <indíquese la vía de exposición si se ha demostrado concluyentemente que el peligro no se produce por ninguna otra vía>.'],
            ['h' => 'H373', 'desc' => 'Puede provocar daños en los órganos <indíquense todos los órganos afectados, si se conocen> tras exposiciones prolongadas o repetidas <indíquese la vía de exposición si se ha demostrado concluyentemente que el peligro no se produce por ninguna otra vía>.'],
            ['h' => 'H400', 'desc' => 'Muy tóxico para los organismos acuáticos.'],
            ['h' => 'H410', 'desc' => 'Muy tóxico para los organismos acuáticos, con efectos nocivos duraderos.'],
            ['h' => 'H411', 'desc' => 'Tóxico para los organismos acuáticos, con efectos nocivos duraderos.'],
            ['h' => 'H412', 'desc' => 'Nocivo para los organismos acuáticos, con efectos nocivos duraderos.'],
            ['h' => 'H413', 'desc' => 'Puede ser nocivo para los organismos acuáticos, con efectos nocivos duraderos.'],
            ['h' => 'EUH 001', 'desc' => 'Explosivo en estado seco.'],
            ['h' => 'EUH 014', 'desc' => 'Reacciona violentamente con el agua.'],
            ['h' => 'EUH 018', 'desc' => 'Al usarlo, pueden formarse mezclas aire-vapor explosivas o inflamables.'],
            ['h' => 'EUH 019', 'desc' => 'Puede formar peróxidos explosivos.'],
            ['h' => 'EUH 029', 'desc' => 'En contacto con agua libera gases tóxicos.'],
            ['h' => 'EUH 031', 'desc' => 'En contacto con ácidos libera gases tóxicos.'],
            ['h' => 'EUH 032', 'desc' => 'En contacto con ácidos libera gases muy tóxicos.'],
            ['h' => 'EUH 044', 'desc' => 'Riesgo de explosión al calentarlo en ambiente confinado.'],
            ['h' => 'EUH 066', 'desc' => 'La exposición repetida puede provocar sequedad o formación de grietas en la piel.'],
            ['h' => 'EUH 070', 'desc' => 'Tóxico en contacto con los ojos.'],
            ['h' => 'EUH 071', 'desc' => 'Corrosivo para las vías respiratorias.'],
            ['h' => 'EUH 201', 'desc' => 'Contiene plomo. No utilizar en objetos que los niños puedan masticar o chupar. ¡Atención! Contiene plomo.'],
            ['h' => 'EUH 202', 'desc' => 'Cianoacrilato. Peligro. Se adhiere a la piel y a los ojos en pocos segundos. Mantener fuera del alcance de los niños.'],
            ['h' => 'EUH 203', 'desc' => 'Contiene cromo (VI). Puede provocar una reacción alérgica.'],
            ['h' => 'EUH 204', 'desc' => 'Contiene isocianatos. Puede provocar una reacción alérgica.'],
            ['h' => 'EUH 205', 'desc' => 'Contiene componentes epoxídicos. Puede provocar una reacción alérgica.'],
            ['h' => 'EUH 206', 'desc' => '¡Atención! No utilizar junto con otros productos. Puede desprender gases peligrosos (cloruro de hidrógeno - ácido clorhídrico).'],
            ['h' => 'EUH 207', 'desc' => 'Atención! Contiene azida de plomo.'],
            ['h' => 'EUH 208', 'desc' => 'Contiene sensibilizadores. Puede provocar una reacción alérgica.'],
            ['h' => 'EUH 209', 'desc' => 'Contiene bencisotiazolinona. Puede provocar una reacción alérgica.'],
            ['h' => 'EUH 210', 'desc' => 'Contiene mezcla de: 5-cloro-2-metil-2H-isotiazol-3-ona [EC no. 247-500-7] y 2-metil-2H-isotiazol-3-ona [EC no. 220-239-6] (3:1). Puede provocar una reacción alérgica.'],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('h_desc');
    }
};
