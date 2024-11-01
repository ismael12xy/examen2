<?php
include "header.php";
require "conexion.php";

$db = conect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vendedor_id = $_POST['vendedor_id'];
    $propiedad_id = $_POST['propiedad_id'];
    $fecha_de_venta = $_POST['fecha_de_venta'];

    $query = "INSERT INTO sales (propiedad_id, vendedor_id, fecha_de_venta) 
              VALUES ('$propiedad_id', '$vendedor_id', '$fecha_de_venta');";

    try {
        $response = mysqli_query($db, $query);
        if ($response) {
            echo "<p>¡Venta registrada!</p>";
        } else {
            throw new Exception("Venta no registrada: " . mysqli_error($db));
        }
    } catch (Exception $e) {
        echo "<p>Error: {$e->getMessage()}</p>";
    }
}

try {
    $querySeller = "SELECT vendedor_id, nombre FROM sellers;";
    $queryProperty = "SELECT propiedad_id, direccion FROM properties;";

    $sellers = mysqli_query($db, $querySeller);
    $properties = mysqli_query($db, $queryProperty);

    if (!$sellers || !$properties) {
        throw new Exception("Error: " . mysqli_error($db));
    }
} catch (Exception $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
}
?>

<section>
    <h2>Formulario de Ventas</h2>
    <div>
        <form action="ventas.php" method="post">
            <fieldset>
                <legend>Complete todos los campos para registrar una nueva venta</legend>
                <div>
                    <label for="vendedor_id">Seleccione el vendedor: </label>
                    <select name="vendedor_id" id="vendedor_id">
                        <?php while ($seller = mysqli_fetch_assoc($sellers)) { ?>
                            <option value="<?php echo $seller['vendedor_id']; ?>"><?php echo $seller['nombre']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="propiedad_id">Seleccione la propiedad: </label>
                    <select name="propiedad_id" id="propiedad_id">
                        <?php while ($property = mysqli_fetch_assoc($properties)) { ?>
                            <option value="<?php echo $property['propiedad_id']; ?>"><?php echo $property['direccion']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="fecha_de_venta">Fecha de venta: </label>
                    <input required type="date" id="fecha_de_venta" name="fecha_de_venta" value="<?php echo date("Y-m-d") ?>">
                </div>
                <div>
                    <button type="submit">Enviar</button>
                </div>
            </fieldset>
        </form>
    </div>
</section>
