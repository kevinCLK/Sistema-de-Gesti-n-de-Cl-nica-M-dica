<table style="text-align: center" class="table table-striped table-hover table-sm table-bordered">
        <thead>
            <tr style="text-align: center">
                <th>HORA</th>
                <th>LUNES</th>
                <th>MARTES</th>
                <th>MIERCOLES</th>
                <th>JUEVES</th>
                <th>VIERNES</th>
                <th>SABADO</th>
                <th>DOMINGO</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $horas=['08:00:00 - 09:00:00','09:00:00 - 10:00:00','10:00:00 - 11:00:00','11:00:00 - 12:00:00','12:00:00 - 13:00:00','13:00:00 - 14:00:00','14:00:00 - 15:00:00','15:00:00 - 16:00:00','16:00:00 - 17:00:00','17:00:00 - 18:00:00','18:00:00 - 19:00:00','19:00:00 - 20:00:00'];
            $diasSemana=['LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO','DOMINGO'];
            ?>
            <?php foreach($horas as $hora): ?>
                <?php list($hora_inicio, $hora_fin) = explode(' - ', $hora); ?>
                <tr>
                    <td> <?php echo $hora; ?></td>
                    <?php foreach($diasSemana as $dia): ?>
                        <?php
                        $nombre_doctor = '';
                        foreach ($horario as $value) {
                            // Comprobar si el día del doctor coincide
                            if (strtoupper($value->dia) === $dia) {
                                // Verificar si la hora está dentro del rango del horario del doctor
                                if ($hora_inicio >= $value->hora_inicio && $hora_fin<=$value->hora_fin) {
                                    $nombre_doctor = $value->doctor->nombres . ' ' . $value->doctor->apellidos;
                                    break;
                                }
                            }
                        }
                        ?>
                        <td><?php echo $nombre_doctor; ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
</table>