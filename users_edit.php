<?php
include 'includes/database.php';
include 'includes/config.php';
include 'includes/functions.php';
include 'includes/header.php';
secure();

if (isset($_POST['editUsername'])) {
    
    if ($stm = $connect->prepare("UPDATE table_users SET `users_username` = ? ,`users_email` = ? , `users_password` = ? , `users_status` = ? WHERE `Users_Id` = ?;")) {
        $hashed = SHA1($_POST['editPassword']);
        $stm->bind_param('ssssi',$_POST['editUsername'],$_POST['editEmail'], $hashed,$_POST['active_user'],$_GET["id"]);
        $stm->execute();
    
        
        set_message('Se actualizo correctamente el usuario: ');
        header('Location: users.php');
        $stm->close();
        
        
    
    }else {
        echo "No se pudo";
    }
    }

if (isset($_GET["id"])) {
    if ($stm = $connect->prepare("SELECT * FROM `table_users` WHERE `Users_Id` = ? ")) {
        
        $stm->bind_param('s',$_GET['id']);
        $stm->execute();

        $result = $stm->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
           
        
    

        ?>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="display-1">Edit Users</div>
                    <form method="post">

                        <!-- Username input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="editUsername" name="editUsername" class="form-control" value="<?php echo $user['users_username']; ?>"/>
                            <label class="form-label" for="registerUsername">Username</label>
                        </div>

                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="email" id="editEmail" name="editEmail" class="form-control" value="<?php echo $user['users_email']; ?>"/>
                            <label class="form-label" for="registerEmail">Email</label>
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="password" id="editPassword" name="editPassword" class="form-control" value="<?php echo $user['users_password']; ?>"/>
                            <label class="form-label" for="registerPassword">Password</label>
                        </div>

                         <!-- active check -->
                         <div  class="form-outline mb-4">
                            <select name="active_user" class="form-select" id="active_user">
                            <option <?php echo ($user['users_password']) ? "Selected": "" ?> value="1">Active</option>
                            <option <?php echo ($user['users_password']) ? "": "Selected" ?> value="0">Inactive</option>
                            </select>
                        </div>


                        <!-- Submit button -->
                        <button  type="submit" class="btn btn-primary btn-block mb-3">Agregar</button>
                    </form>                    
                </div>
            </div>
        </div>

        <?php
 }
 $stm->close();
}else{
echo "No hay usuario"; 

}
}else{
echo "No hay usuario"; 

}   

include 'includes/footer.php';
?>