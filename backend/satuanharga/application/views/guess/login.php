<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login | Satuan Harga</title>
<style>
body {
  font-family: Arial, Helvetica, sans-serif; 
  background-color: #8ca1c0;
  background-image: url('<?=base_url()?>public/img/morowali-login.jpg');
  background-size: 100%;
  background-attachment: fixed;
  background-position: center;; 
  background-repeat: no-repeat; 
  background-position: 100% 30%;
}

form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

.wrapper {
  padding: 50px;
  padding-left: 35%;
  padding-right: 35%;
  min-width: 300px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>
<div class="wrapper">
  <h2>Login Form</h2>

  <form action="<?=base_url('admin/login')?>" method="POST">

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="user" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="pass" required>
          
      <button type="submit">Login</button>
    </div>

  </form>
</div>


</body>
</html>
