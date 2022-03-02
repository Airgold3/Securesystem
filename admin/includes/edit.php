<?php

/*
This file is part of SecureSystem.
Copyright (C) 2022 Santiago Fernández, Airgold3 
    SecureSystem is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    SecureSystem is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with SecureSystem.  If not, see <https://www.gnu.org/licenses/>.
*/

  include_once("../includes/process.php");
  if (!isset($_SESSION['email'])) {
      header('Location: ../login.php');
  }else{
    include_once("../../includes/connection.php");
    include_once("checkidexist.php");
    if($row['num'] > 0){
      include_once('header.php');
      include_once('navbar.php');
      $id = $_GET['id'];
      $query = $con->prepare("
        SELECT * FROM users WHERE id = :id;
        ");
      $query->bindParam(":id", $id);
      $query->execute();
      $person = $query->fetch(PDO::FETCH_OBJ);
    }else{
      header('Location: ../tables.php');
    }
 }

?>

<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Edit Admin Profile </h6>
    </div>
    <div class="card-body">

        <form method="POST" action="editprocess.php">


          <div class="form-group">
            <label> ID </label>
            <input type="text" name="id2" value="<?php echo $person->id; ?>" class="form-control" placeholder="Put a Username" disabled>
          </div>
          <div class="form-group">
            <label> Username </label>
            <input type="text" name="txt2username" value="<?php echo $person->username; ?>" class="form-control" placeholder="Put a Username" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="txt2email" value="<?php echo $person->email; ?>" class="form-control" placeholder="Put a Email" required>
          </div>
            
          <div class="form-group">
            <label>Status Email</label>
            <?php
            $status_email = $person->status_email;
            ?>
            <select class="form-control" name="txt2status_email">
              <option value="<?php if($status_email == "0"){ echo "0";}else{echo "1";} ?>"><?php if($status_email == "0"){ echo "Pending";}else{echo "Verified";} ?></option>
              <option value="<?php if($status_email == "0"){ echo "1";}else{echo "0";} ?>"><?php if($status_email == "0"){ echo "Verified";}else{echo "Pending";} ?></option>
            </select>
         
          </div>
          <div class="form-group">
            <label>Rank</label>
            <?php
            $rank = $person->rank;
            ?>
            <select class="form-control" name="txt2rank">
              <option value="<?php if($rank == "0"){ echo "0";}else{echo "1";} ?>"><?php if($rank == "0"){ echo "User";}else{echo "Admin";} ?></option>
              <option value="<?php if($rank == "0"){ echo "1";}else{echo "0";} ?>"><?php if($rank == "0"){ echo "Admin";}else{echo "User";} ?></option>
            </select>
         
          </div>
          <input type="hidden" name="oculto">
          <input type="hidden" name="id2" value="<?php echo $person->id; ?>">
          <a href="../tables.php" class="btn btn-danger"> Cancel </a>
          <input type="submit" class="btn btn-primary" value="Save"></button>
        </form>
    </div>
  </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</div>
<!-- /.container-fluid-->

<?php
include_once('scripts.php');
include_once('footer.php');
?>
