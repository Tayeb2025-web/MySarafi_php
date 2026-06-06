
<?php
include 'auth/check_login.php';
?>

<!DOCTYPE html>
 
<html lang="en">
 
<head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Send</title>
       <link rel="stylesheet" href="styles/main.css">
       <link rel="stylesheet" href="styles/send.css">
</head>

<body>

           <aside class="sidebar">
                     <?php include 'components/sidebar.php'; ?>
              </aside>

       

       <div class="under-header">
              <header class="header">
              <?php include 'components/header.php'; ?>
               </header>

              <main class="page-content main-layout">

                     <section class="page-content send-page">

                            <div class="send-form-card">

                                   <div class="card-header">
                                          <h2>New Send Transaction</h2>
                                   </div>

                                   <?php 

                                          include 'backend/db.php';
                                          include 'backend/crud_classes.php';

                                          $send = new Send($conn);
                                          
                                   
                                      if(isset($_POST['send_transaction'])){
                                          $receiver_name = $_POST['receiver_name'];
                                          $receiver_fatherN = $_POST['receiver_fatherN'];
                                          $send_code = $_POST['code'];
                                          $send_amount = $_POST['amount'];
                                          $send_date = $_POST['date'];
                                          $send_to =  $_POST['send_to'];

                                          $send->insert($receiver_name ,$receiver_fatherN, $send_code, $send_amount,$send_date , $send_to );
                                           header("Location: send.php");
                                      }

                                   ?>

                                   <form action="" method="post" class="send-form">

                                          <div class="form-section">

                                                 <div class="form-row">
                                                        <div class="form-group">
                                                               <label>Receiver Name</label>
                                                               <input type="text" name="receiver_name" required>
                                                        </div>

                                                        <div class="form-group">
                                                               <label>Receiver F_Name</label>
                                                               <input type="text" name="receiver_fatherN">
                                                        </div>
                                                 </div>
                                          </div>

                                          <div class="form-section">
                                                 <div class="form-row">
                                                        <div class="form-group">
                                                               <label>Amount</label>
                                                               <input type="text" name="amount" required>
                                                        </div>

                                                        <div class="form-group">
                                                               <label>To Branch</label>
                                                               
                                                               <select required name="send_to">
                                                                 <option  value="">Select Branch</option>

                                                                 <?php 
                                                                      $branch = new Branch($conn);
                                                                      $branch_names = $branch-> read();
                                                                      foreach($branch_names as $row) {
                                                                                 ?>
                                                                 <option value="<?php echo $row['branch_id']; ?>"><?php echo $row['branch_name']; ?></option>

                                                                      <?php  } ?>
                                                               </select>
                                                        </div>

                                                 </div>
                                          </div>

                                          <div class="form-section">
                                                 <div class="form-row">
                                                        <div class="form-group">
                                                               <label>Date</label>
                                                               <input type="date" name="date">
                                                        </div>

                                                        <div class="form-group">
                                                               <label>Code</label>
                                                               <input type="text" name="code" required />
                                                        </div>

                                                 </div>
                                          </div>

                                          <div class="form-actions">
                                                 <button type="reset" class="cancel-btn">reset</button>
                                                 <button type="submit" name="send_transaction" class="save-btn">
                                                        Save Transaction
                                                 </button>
                                          </div>

                                   </form>

                            </div>

                            <div class="send-table-card">
                                   <div class="card-header">
                                          <h2>Send Transactions List</h2>
                                   </div>

                                   <div class="table-wrapper">
                                          <table class="send-table">
                                                 <thead>
                                                        <tr>
                                                               <th>ID</th>
                                                               <th>Receiver</th>
                                                               <th>Receiver_FN</th>
                                                               <th>Amount</th>
                                                               <th>Sent To</th>
                                                               <th>Date</th>
                                                               <th>Code</th>

                                                        </tr>
                                                 </thead>

                                                 
                                                 <tbody>
                                           <?php 
                                                 $send_data = $send->read();
                                                 
                                                 foreach($send_data as $send_row) {
                                                                                                 ?>
                                                        <tr>
                                                               <td><?php echo $send_row['send_id'];  ?></td>
                                                               <td><?php echo $send_row['that_reciever_name'];  ?></td>
                                                               <td><?php echo $send_row['that_reciever_fatherName'];  ?></td>
                                                               <td><?php echo $send_row['send_amount'];  ?></td>
                                                               <td><?php echo $send_row['branch_name'];      ?></td>
                                                               <td><?php echo $send_row['send_date'];  ?></td>
                                                               <td><?php echo $send_row['send_code'];  ?></td>
                                                        </tr>

                                                        <?php } ?>
                                                 </tbody>
                                          </table>
                                   </div>
                            </div>

                     </section>


              </main>
       </div>

</body>

</html>