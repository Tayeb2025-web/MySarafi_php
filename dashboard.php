
<?php
include 'auth/check_login.php';
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="styles/main.css">
  <link rel="stylesheet" href="styles/dashboard.css">
</head>

<body style="display: flex;">
 
  <aside class="sidebar">
      <?php include 'components/sidebar.php'; ?>
    </aside>

   

  <div class="under-header">

    <header class="header">
    <?php include 'components/header.php'; ?>
   </header>

    <?php
    include 'backend/db.php';
    $sent_amount_sql = "SELECT SUM(send_amount) as total_sent_amount From send";
    $sent_amount_stm = $conn->prepare($sent_amount_sql);
    $sent_amount_stm->execute();
    $sent_amount = $sent_amount_stm->fetch(PDO::FETCH_ASSOC);

    $sent_persons_sql = "SELECT COUNT(*) as all_sent_persons From send";
    $sent_persons_stm = $conn->prepare($sent_persons_sql);
    $sent_persons_stm->execute();
    $sent_persons = $sent_persons_stm->fetch(PDO::FETCH_ASSOC);



    $receive_amount_sql = "SELECT SUM(receive_amount) as total_receive_amount From receive";
    $receive_amount_stm = $conn->prepare($receive_amount_sql);
    $receive_amount_stm->execute();
    $receive_amount = $receive_amount_stm->fetch(PDO::FETCH_ASSOC);

    $receive_persons_sql = "SELECT COUNT(*) as all_receive_persons From receive";
    $receive_persons_stm = $conn->prepare($receive_persons_sql);
    $receive_persons_stm->execute();
    $receive_persons = $receive_persons_stm->fetch(PDO::FETCH_ASSOC);



    $given_amount_sql = "SELECT SUM(receive_amount) as total_given_amount From receive where status ='paid'";
    $given_amount_stm = $conn->prepare($given_amount_sql);
    $given_amount_stm->execute();
    $given_amount = $given_amount_stm->fetch(PDO::FETCH_ASSOC);

    $given_persons_sql = "SELECT COUNT(*) as all_given_persons From receive where status ='paid'";
    $given_persons_stm = $conn->prepare($given_persons_sql);
    $given_persons_stm->execute();
    $given_persons = $given_persons_stm->fetch(PDO::FETCH_ASSOC);



    $pending_amount_sql = "SELECT SUM(receive_amount) as total_pending_amount From receive where status ='pending'";
    $pending_amount_stm = $conn->prepare($pending_amount_sql);
    $pending_amount_stm->execute();
    $pending_amount = $pending_amount_stm->fetch(PDO::FETCH_ASSOC);

    $pending_persons_sql = "SELECT COUNT(*) as all_pending_persons From receive where status ='pending'";
    $pending_persons_stm = $conn->prepare($pending_persons_sql);
    $pending_persons_stm->execute();
    $pending_persons = $pending_persons_stm->fetch(PDO::FETCH_ASSOC);


    $earned = ($sent_amount['total_sent_amount']*5)/100 + ($given_amount['total_given_amount']*5)/100 ;
     

    ?>

    <main class="page-content dashboard-page">

      <div class="cards-container">

        <div class="cards sent-container">
          <p class="sent-container-header">مجموع ارسالی</p>
          <div class="sent-container-inside">
              <div class="sent_amount_money">
                <span>مقدار</span>
                <span><?php echo $sent_amount['total_sent_amount']; ?> افغانی</span>
              </div>

              <div class="sent_persons">
                <span>اشخاص</span>
                <span><?php echo $sent_persons['all_sent_persons']; ?> نفر</span>
              </div>
          </div>
        </div>


          <div class="cards">
             <p class="sent-container-header">مجموع دریافتی</p>
              <div class="sent-container-inside">
                    <div class="sent_amount_money">
                      <span>مقدار</span>
                      <span><?php echo $receive_amount['total_receive_amount']; ?> افغانی</span>
                    </div>

                   <div class="sent_persons">
                      <span>اشخاص</span>
                      <span><?php echo $receive_persons['all_receive_persons']; ?> نفر</span>
                   </div>
              </div>
          </div>

          <div class="cards"> 
           <p class="sent-container-header">مجموع تحویل شده به افراد</p>
          <div class="sent-container-inside">
              <div class="sent_amount_money">
                <span>مقدار</span>
                <span><?php echo $given_amount['total_given_amount']; ?> افغانی</span>
              </div>

              <div class="sent_persons">
                <span>اشخاص</span>
                <span><?php echo $given_persons['all_given_persons']; ?> نفر</span>
              </div>
          </div>
          </div>


          <div class="cards">
                  <p class="sent-container-header">مجموع  باقی از افراد</p>
          <div class="sent-container-inside">
              <div class="sent_amount_money">
                <span>مقدار</span>
                <span><?php echo $pending_amount['total_pending_amount']; ?> افغانی</span>
              </div>

              <div class="sent_persons">
                <span>اشخاص</span>
                <span><?php echo $pending_persons['all_pending_persons']; ?> نفر</span>
              </div>
          </div>
               
          </div>




          <div class="cards"> 
                  <p class="earn-container-header"> 
                      درآمد
                </p>
                <div class="sent-container-inside earned">
                <span>
                  <?php 
                    echo $earned; 
                    ?>
                    افغانی
                </span>
                </div>
          </div>

      </div>

    </main>
  </div>

</body>

</html>