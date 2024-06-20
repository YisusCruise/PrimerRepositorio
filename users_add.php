<?php
include 'includes/database.php';
include 'includes/config.php';
include 'includes/functions.php';
include 'includes/header.php';
secure();

if (isset($_POST['registerUsername'])) {
    
if ($stm = $connect->prepare("INSERT INTO table_users (`users_username`, `users_email`,`users_password`,`users_status`) VALUES (?,?,?,?)")) {
    $hashed = SHA1($_POST['registerPassword']);
    $stm->bind_param('ssss',$_POST['registerUsername'],$_POST['registerEmail'], $hashed,$_POST['active_user']);
    $stm->execute();

    
    set_message('Se creo correctamente el usuario: ');
    header('Location: users.php');
    $stm->close();
    
    

}else {
    echo "No se pudo";
}
}
    

        ?>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="display-1">Add Users</div>
                    <form method="post">

                        <!-- Username input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="registerUsername" name="registerUsername" class="form-control" />
                            <label class="form-label" for="registerUsername">Username</label>
                        </div>

                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="email" id="registerEmail" name="registerEmail" class="form-control" />
                            <label class="form-label" for="registerEmail">Email</label>
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="password" id="registerPassword" name="registerPassword" class="form-control" />
                            <label class="form-label" for="registerPassword">Password</label>
                        </div>

                         <!-- active check -->
                         <div  class="form-outline mb-4">
                            <select name="active_user" class="form-select" id="active_user">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                            </select>
                        </div>


                        <!-- Submit button -->
                        <button  type="submit" class="btn btn-primary btn-block mb-3">Agregar</button>
                    </form>                    
                </div>
            </div>
        </div>

        <?php
    

include 'includes/footer.php';
?>