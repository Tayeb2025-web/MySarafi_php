
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
     <link rel="stylesheet" href="styles/receive.css">
</head>

<body style="display: flex;">
              <aside class="sidebar">
                     <?php include 'components/sidebar.php'; ?>
              </aside>

     

     <div class="under-header">
          <header class="header">
          <?php include 'components/header.php'; ?>
            </header>
         
          <main class="page-content receive-page">

               <!-- <div class="receive-header">
                    <div>
                         <h1>Receive Money</h1>
                         <p>Manage incoming transfers from other branches</p>
                    </div>
               </div> -->

               <?php
               include 'backend/db.php';
               include 'backend/crud_classes.php';
               $branch = new Branch($conn);
               $receive = new Receive($conn);

               if (isset($_POST['add_receive'])) {
                    $receiver_name = $_POST['this_receiver_name'];
                    $receiver_fatherN = $_POST['this_receiver_fatherName'];
                    $receive_code = $_POST['receive_code'];
                    $receive_amount = $_POST['receive_amount'];
                    $receive_date = $_POST['receive_date'];
                    $received_from =  $_POST['received_from'];

                    $receive->insert($receiver_name, $receiver_fatherN, $receive_code, $receive_amount, $receive_date, $received_from);
                    // header("Location: receive.php");
                    // exit();
               }

                   // paying by search
               if (isset($_POST['pay_from_search'])) {
                    $receiver_id = $_POST['receiver_id_to_pay'];
                    $receive->update($receiver_id);
                    // header("Location: receive.php");
                    // exit();
               }
                        // paying by table
               if (isset($_GET['receive_id_pay'])) {
                    $receive_id = $_GET['receive_id_pay'];
                    $receive->update($receive_id);

                    // header("Location: receive.php");
                    // exit();
               }
               ?>
               <div class="receive-grid">

                    <div class="receive-card register-card">
                         <div class="card-header">
                              <h2> Register Incoming Transfer</h2>
                         </div>

                         <form action="" method="post" class="receive-form">

                              <div class="form-row">
                                   <div class="form-group">
                                        <label>Receiver Name</label>
                                        <input required type="text" name="this_receiver_name" placeholder="Enter receiver name">
                                   </div>

                                   <div class="form-group">
                                        <label>Father Name</label>
                                        <input required type="text" name="this_receiver_fatherName" placeholder="Enter father name">
                                   </div>
                              </div>

                              <div class="form-row">
                                   <div class="form-group">
                                        <label>Receive Code</label>
                                        <input required type="text" name="receive_code" placeholder="Enter receive code">
                                   </div>

                                   <div class="form-group">
                                        <label>Amount</label>
                                        <input required type="text" name="receive_amount" placeholder="Enter amount">
                                   </div>
                              </div>

                              <div class="form-row">
                                   <div class="form-group">
                                        <label>From Branch</label>
                                        <select required name="received_from">
                                             <option value="">Select branch</option>
                                             <?php
                                             $branch_data = $branch->read();
                                             foreach ($branch_data as $branch_id) {
                                             ?>
                                                  <option value="<?php echo $branch_id['branch_id'];  ?>"><?php echo $branch_id['branch_name'];  ?></option>
                                             <?php  } ?>
                                        </select>
                                   </div>

                                   <div class="form-group">
                                        <label  >Date</label>
                                        <input required type="date" name="receive_date">
                                   </div>
                              </div>

                              <button type="submit" name="add_receive" class="save-receive-btn">
                                   Save Incoming Transfer
                              </button>

                         </form>
                    </div>

                    <div class="receive-side">

                         <div class="receive-card search-card">
                              <!-- <div class="card-header">
                                   <h2>Search Transfer by Code</h2>
                              </div> -->


                              <form action="" method="POST" class="search-form">
                                   <div class="form-group">
                                        <!-- <label>Receive Code</label> -->
                                        <div class="search-row">
                                             <input required type="text" name="search_code" placeholder="Enter receive code">
                                             <button type="submit" name="search_code_btn" class="search-btn">Search</button>
                                        </div>
                                   </div>
                              </form>
                         </div>


                         <?php

                         $searched_receive_data = null;
                         if (isset($_POST['search_code_btn'])) {
                              $searched_code = $_POST['search_code'];
                              $searched_receive_data = $receive->search_by_code($searched_code);

                              if (!$searched_receive_data) {
                                   echo '<div class="error-message">هیچ تراکنشی با این کد پیدا نشد</div>';
                              }
                         }


                         ?>

                              <div class="receive-card details-card">
                                   <div class="card-header">
                                        <h2>Transfer Details</h2>
                                   </div>

                                   <div class="details-box">
                                        <div class="details-row">
                                             <span>Receiver Name</span>
                                             <!-- <strong>-</strong> -->
                                             <strong><?php echo  $searched_receive_data['this_receiver_name'] ?? '-'; ?></strong>
                                        </div>

                                        <div class="details-row">
                                             <span>Father Name</span>
                                             <!-- <strong>-</strong> -->
                                             <strong><?php echo  $searched_receive_data['this_receiver_fatherName'] ?? '-'; ?></strong>
                                        </div>

                                        <div class="details-row">
                                             <span>Receive Code</span>
                                             <!-- <strong>-</strong> -->
                                             <strong><?php echo  $searched_receive_data['receive_code'] ?? '-'; ?></strong>
                                        </div>

                                        <div class="details-row">
                                             <span>Amount</span>
                                             <!-- <strong>-</strong> -->
                                             <strong><?php echo  $searched_receive_data['receive_amount'] ?? '-'; ?></strong>
                                        </div>

                                        <div class="details-row">
                                             <span>From Branch</span>
                                             <!-- <strong>-</strong> -->
                                             <strong><?php echo  $searched_receive_data['receive_from'] ?? '-'; ?></strong>
                                        </div>

                                        <div class="details-row">
                                             <span>Date</span>
                                             <!-- <strong>-</strong> -->
                                             <strong><?php echo  $searched_receive_data['receive_date'] ?? '-'; ?></strong>
                                        </div>

                                        <div class="details-row">
                                             <span>Status</span>
                                             <strong class=" 

                                              <?php
                                                  if ($searched_receive_data['status'] == 'paid') {
                                                       echo 'paid status-badge';
                                                  } elseif ($searched_receive_data['status'] == 'pending') {
                                                       echo 'pending status-badge';
                                                  } else {
                                                       echo '';
                                                  }

                                                  ?>
                                              
                                              ">


                                                  <?php echo  $searched_receive_data['status'] ?? '-'; ?>

                                             </strong>
                                        </div>
                                   </div>

                                   <div class="details-actions">

                                        <?php if (isset($searched_receive_data['status']) && $searched_receive_data['status'] == 'pending'): ?>
                                             <form action="" method="POST" style="display: inline-block;">
                                                  <input type="hidden" name="receiver_id_to_pay" value="<?php echo $searched_receive_data['receiver_id']; ?>">
                                                  <button type="submit" name="pay_from_search" class="pay-btn">
                                                       Pay Money
                                                  </button>
                                             </form>
                                        <?php else: ?>
                                             <button type="button" disabled class="pay-btn-disabled">
                                                  Pay Money
                                             </button>
                                        <?php endif; ?>
                                        <a href="receive.php" class="clear-btn">
                                             Clear
                                        </a>
                                   </div>
                              </div>

                    </div>


               </div>

               <div class="receive-card history-card">
                    <div class="card-header">
                         <h2>Incoming Transfers History</h2>
                    </div>

                    <div class="table-wrapper">
                         <table class="receive-table">
                              <thead>
                                   <tr>
                                        <th>ID</th>
                                        <th>Receiver Name</th>
                                        <th>Father Name</th>
                                        <th>Amount</th>
                                        <th>Received From</th>
                                        <th>Date</th>
                                        <th>Receive Code</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                   </tr>
                              </thead>

                              <tbody>
                                   <?php
                                   $receive_data = $receive->read();

                                   
                                   foreach ($receive_data as $row) {
                                   ?>
                                        <tr>
                                             <td><?php echo $row['receiver_id']; ?></td>
                                             <td><?php echo $row['this_receiver_name']; ?></td>
                                             <td><?php echo $row['this_receiver_fatherName']; ?></td>
                                             <td><?php echo $row['receive_amount']; ?></td>
                                             <td><?php echo $row['branch_name']; ?></td>
                                             <td><?php echo $row['receive_date']; ?></td>
                                             <td><?php echo $row['receive_code']; ?></td>

                                             <td>
                                                  <span class="status-badge <?php echo ($row['status'] == 'paid') ? 'paid' : 'pending'; ?> ">

                                                       <?php echo $row['status']; ?>

                                                  </span>
                                             </td>
                                             <td>
                                                  <?php if ($row['status'] == 'pending') {  ?>


                                                       <a href='receive.php?receive_id_pay=<?php echo $row['receiver_id']; ?>' class='pay-small-btn'>Pay</a>

                                                  <?php
                                                  } else {
                                                       echo "-";
                                                  }
                                                  ?>

                                             </td>
                                        </tr>
                                   <?php } ?>
                              </tbody>
                         </table>
                    </div>



               </div>

          </main>
     </div>

</body>

</html>