<?php 
          $username = 'root';
          $password = '';
          $dbname = 'mysarafi';

          try {
               $conn = new PDO("mysql:host=localhost;port=3344;dbname={$dbname}", $username, $password);
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
          } catch(PDOException $e) {
                die("خطای اتصال به دیتابیس: " . $e->getMessage());
          }
?>