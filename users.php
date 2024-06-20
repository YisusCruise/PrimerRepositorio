<?php
include 'includes/database.php';
include 'includes/config.php';
include 'includes/functions.php';
include 'includes/header.php';
secure();

if (isset($_GET['delete'])) {
    
    if ($stm = $connect->prepare("DELETE FROM table_users WHERE `Users_Id` = ?;")) {
        
        $stm->bind_param('i',$_GET["delete"]);
        $stm->execute();
    
        
        set_message('Se dio de baja el usuario correctamente ');
        header('Location: users.php');
        $stm->close();
        
        
    
    }else {
        echo "No se pudo";
    }
    }

if ($stm = $connect->prepare('SELECT*FROM table_users;')) {
    $stm->execute();
    $result = $stm->get_result();


    if ($result->num_rows) {

        ?>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="display-1">Users</div>
                    <table class="table table-striped table-hover">
                        <tr>
                            <th> Nombre de usuario</th>
                            <th> Correo</th>
                            <th> Estatus</th>
                            <th> Edit | Delete</th>
                        </tr>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['users_username']; ?></td>
                                <td><?php echo $row['users_email']; ?></td>
                                <td><?php echo $row['users_status']; ?></td>
                                <td><a href="users_edit.php?id=<?php echo $row['Users_Id'];?>">Editar|</a>
                                <a href="users.php?delete=<?php echo $row['Users_Id'];?>">Eliminar</a>
                                </td>
                            </tr>

                        <?php } ?>
                        <a href="users_add.php"> Agregar nuevo usuario </a>
                    </table>
                </div>
            </div>
        </div>

        <?php
    } else {
        $stm->close();

    }
} else {
    echo "No se pudo";
}


include 'includes/footer.php';
?>