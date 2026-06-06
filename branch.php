
<?php
include 'auth/check_login.php';
?>

<!DOCTYPE html>

<html lang="en"> 
       <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Branch</title>
         <link rel="stylesheet" href="styles/main.css">
         <link rel="stylesheet" href="styles/branch.css">
       </head>

 <body style="display: flex;">

          <aside class="sidebar">
                     <?php include 'components/sidebar.php'; ?>
              </aside>

       

       <div class="under-header">
          <header class="header">
              <?php include 'components/header.php'; ?>
          </header>
             
               <main class="page-content">

               
                    
               <div class="table-container">
                    <button id="openAddModal" class="branch_add">➕ Add</button>
              
                    <!--  -->

                   <table>
                    <tr>
                         <th>Name</th>
                         <th>Address</th>
                         <th>Partner</th>
                         <th>Phone</th>
                         <th colspan="2">Edit</th>
                        
                    </tr>

                    <?php 
                        include 'backend/db.php';
                        include 'backend/crud_classes.php';

                        $branch = new Branch($conn);


                        //adding a branch
                        if(isset($_POST['save_branch'])) {
                        $branch_name = $_POST['branch_name'];
                        $branch_address = $_POST['branch_address'];
                        $branch_partner = $_POST['branch_partner'];
                        $branch_phone = $_POST['branch_phone'];

                        $branch->insert($branch_name , $branch_address , $branch_partner , $branch_phone);

                        }

                        //editing a branch
                        if(isset($_POST['edit_branch'])){
                         $branch_id_edit = $_GET['branch_id_edit'];
                         $b_name = $_POST['b_name'];
                         $b_address = $_POST['b_address'];
                         $b_partner = $_POST['b_partner'];
                         $b_phone = $_POST['b_phone'];

                         $branch->update($b_name , $b_address , $b_partner , $b_phone , $branch_id_edit);
                         header('location:branch.php');
                        }

                        


                      // deleting branch
                      if(isset($_GET['branch_id_delete'])) {
                        $branch_id_delete = $_GET['branch_id_delete'];

                        $branch->delete($branch_id_delete);
                         header('location:branch.php');
                      }
                        ?>

                        <?php   
                           //  reading branch
                        $data = $branch->read();
                            foreach($data as $row) { ?>
                    <tr>
                         <td><?php echo $row['branch_name']; ?></td>
                         <td><?php echo $row['branch_address']; ?></td>
                         <td><?php echo $row['branch_partner']; ?></td>
                         <td><?php echo $row['branch_phone']; ?></td>
                         <td><a  class="edit-btn" href=" branch.php?branch_id_edit=<?php echo $row['branch_id']; ?>">Edit</a></td>
                        
                         
                         <td><a class="delete-btn" href="branch.php?branch_id_delete=<?php echo $row['branch_id']; ?>">Delete</a></td>
                    </tr>
                    <?php } ?>

                   </table>
                    </div>
        
               </main>
       </div>

     


             <!-- modal for adding branch -->
     <div id="add_modal-overlay" class="modal-overlay">

               <div class="branch-modal"> 

                    <div class="modal-header">
                         <h2 class="modal-title">🏢 Add New Branch</h2>
                         <button type="button" class="modal-close"> &times;</button>
                    </div>

                    <form action="" method="post" class="branch-form">

                         <div class="form-group">
                              <label for="branch_name">Branch Name</label>
                              <input
                                   type="text"
                                   id="branch_name"
                                   name="branch_name"
                                   placeholder="Enter branch name">
                         </div>

                         <div class="form-group">
                              <label for="branch_address">Address</label>
                              <input
                                   type="text"
                                   id="branch_address"
                                   name="branch_address"
                                   placeholder="Enter address">
                         </div>

                         <div class="form-group">
                              <label for="branch_partner">Partner Name</label>
                              <input
                                   type="text"
                                   id="branch_partner"
                                   name="branch_partner"
                                   placeholder="Enter partner name">
                         </div>

                         <div class="form-group">
                              <label for="branch_phone">Phone Number</label>
                              <input
                                   type="text"
                                   id="branch_phone"
                                   name="branch_phone"
                                   placeholder="Enter phone number">
                         </div>

                         <div class="modal-actions">
                              <button id="closeAddModal" type="button" class="cancel-btn">
                                   Cancel
                              </button>

                              <button type="submit" name="save_branch" class="save-btn">
                                   Save Branch
                              </button>
                         </div>

                    </form>

                   </div>

     </div>


      <!-- editing modal -->
     
     <div id="edit_modal-overlay" class="modal-overlay"  style="<?php echo isset($_GET['branch_id_edit']) ? 'display:flex;' : 'display:none;'; ?>">

               <div class="branch-modal"> 

                    <div class="modal-header">
                         <h2 class="modal-title">🏢 Edit New Branch</h2>
                         <button type="button" class="modal-close"> &times;</button>
                    </div>

                      <?php
                    if(isset($_GET['branch_id_edit'])) {
                       $branch_id_edit = $_GET['branch_id_edit'];
                        $one_branch = $branch->read_one($branch_id_edit); 
                    
                     ?>

                    <form action="" method="post" class="branch-form">

                    
                         <div class="form-group">
                              <label for="branch_name">Branch Name</label>
                              <input
                                   type="text"
                                   id="branch_name"
                                   name="b_name"
                                   placeholder="Enter branch name"
                                   value="<?php echo $one_branch['branch_name']; ?>"
                                   >
                              
                         </div>

                         <div class="form-group">
                              <label for="b_address">Address</label>
                              <input
                                   type="text"
                                   id="branch_address"
                                   name="b_address"
                                   placeholder="Enter address"
                                   value="<?php echo $one_branch['branch_address']; ?>"
                                   >
                         </div>

                         <div class="form-group">
                              <label for="branch_partner">Partner Name</label>
                              <input
                                   type="text"
                                   id="branch_partner"
                                   name="b_partner"
                                   placeholder="Enter partner name"
                                    value="<?php echo $one_branch['branch_partner']; ?>"
                                   >
                         </div>

                         <div class="form-group">
                              <label for="branch_phone">Phone Number</label>
                              <input
                                   type="text"
                                   id="branch_phone"
                                   name="b_phone"
                                   placeholder="Enter phone number"
                                    value="<?php echo $one_branch['branch_phone']; ?>"
                                   >
                         </div>
                         

                         <div class="modal-actions">
                              <a href="branch.php" id="closeEditModal" type="button" class="cancel-btn">
                                   Cancel
                              </a>

                              <button type="submit" name="edit_branch" class="save-btn">
                                   Edit Branch
                              </button>
                         </div>

                    </form>

                   </div>

        </div>

        <?php } ?>

       
          <script>
               const add_modal = document.getElementById('add_modal-overlay');
               const edit_modal = document.getElementById('edit_modal-overlay');

               document.getElementById('openAddModal').onclick = function () {
               add_modal.style.display = 'flex';
               };

               document.getElementById('closeAddModal').onclick = function () {
               add_modal.style.display = 'none';
               };

               document.getElementById('openEditModal').onclick = function () {
               edit_modal.style.display = 'flex';
               };

               document.getElementById('closeEditModal').onclick = function () {
               window.location
               };
          </script>
   </body>
</html>
