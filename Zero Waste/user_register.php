<?php

include 'materials/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}
;

if (isset($_POST['submit'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email,]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if (empty($_POST["name"])) {
      $name_error = "Name is required";
  } else {
      $name = input_data($_POST["name"]);
      if (!preg_match("/^(?=.{4,20}$)[a-zA-Z]+(?: [a-zA-Z]+){0,2}$/", $name)) {
          $name_error = "Only alphabets and white space are allowed";
      }
  }
  if (empty($_POST["email"])) {
      $email_error = "Email is required";
  } else {
      $email = input_data($_POST["email"]);

      if (!preg_match("/^[a-z\d\._-]+@([a-z\d-]+\.)+[a-z]{2,6}$/", $email)) {
          $email_error = "Invalid email format";
      }
  }

   if ($select_user->rowCount() > 0) {
      $message[] = 'email already exists!';
   } else {
      if ($pass != $cpass) {
         $message[] = 'confirm password not matched!';
         
      } else {
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");
         $insert_user->execute([$name, $email, $cpass]);
         $message[] = 'registered successfully, login now please!';
      }
   }

}
function input_data($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'materials/user_header.php'; ?>

   <section class="form-container">

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
         <h3>রেজিস্ট্রেশন করুন</h3>
         <input type="text" name="name" required placeholder="enter your username" maxlength="20" class="box"><?php if (isset($name_error))
                        echo $name_error; ?>
         <input type="email" name="email" required placeholder="enter your email" maxlength="50" class="box"
            oninput="this.value = this.value.replace(/\s/g, '')"> <?php if (isset($email_error))
                        echo $email_error; ?>
         <input type="password" name="pass" required placeholder="enter your password" maxlength="20" class="box"
            oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="cpass" required placeholder="confirm your password" maxlength="20" class="box"
            oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="submit" value="রেজিস্টার" class="btn" name="submit">
         <p>আগের একাউন্ট আছে?</p>
         <a href="user_login.php" class="option-btn">লগইন করুন</a>
      </form>

   </section>




   <?php include 'materials/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>