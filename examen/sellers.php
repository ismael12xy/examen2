<?php
    include "header.php";
    require "conexion.php";
    $db = conect();

    if($_SERVER['REQUEST_METHOD']=='POST'){
    $name= $_POST["name"];
    $email= $_POST["email"];
    $phone= $_POST["phone"];

    $query = "INSERT INTO sellers (nombre, email, telefono) VALUES "." ('$name', '$email', '$phone');";

    $response = mysqli_query($db, $query);

    try {
        $response = mysqli_query($db, $query);

        if ($response === false) {
            throw new Exception('Error en la consulta a la base de datos: ' . mysqli_error($db));
        }

        echo "Seller added successfully";
        
    } catch (Exception $e) {
        echo "Excepción capturada: " . $e->getMessage();
    }
    }
?>

<section>
    <h2>Sellers</h2>
    <div>
        <form action="sellers.php" method="post">
            <fieldset>
                <legend>Fill all fields to create a new seller</legend>
                <div>
                    <label for="name">name</label>
                    <input type="text" name="name" id="name" placeholder="Your name">
                </div>
                <div>
                    <label for="email">email</label>
                    <input type="email" name="email" id="email" placeholder="Your@email.com">
                </div>
                <div>
                    <label for="phone">phone</label>
                    <input type="tel" name="phone" id="phone" placeholder="Your phone number">
                </div>
                <div>
                    <button type="submit">Crear vendedor</button>
                </div>
            </fieldset>
        </form>
    </div>
</section>