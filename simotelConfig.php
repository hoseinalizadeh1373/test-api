<?php

if(file_exists('data.json')){
  $jsonString = file_get_contents('data.json');
  $data = json_decode($jsonString, true);

}


?>
<html>
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محتویات فایل webhook ping</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="
https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js
"></script>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body class="container" dir="rtl">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link bg-secondary text-light mx-1 rounded " aria-current="page" href="/index.php">ارسال و تست api </a>
        </li>
        <li class="nav-item">
          <a class="nav-link bg-secondary text-light mx-2 rounded" href="/WebHookApiView.php">نمایش لاگ های دریافتی</a>
        </li>
        <li class="nav-item">
          <a class="nav-link bg-secondary text-warning mx-2 rounded active" >تنظیمات سرور </a>
        </li>
       
      </ul>
    </div>
  </div>
</nav>
<div class="container">
        <h1>فرم ذخیره اطلاعات</h1>
        <form id="dataForm" method="post">
            <div class="mb-3">
                <label for="serverAddress" class="form-label">آدرس سرور:</label>
                <input type="text" class="form-control" name="serverAddress" id="serverAddress" required value="<?php echo  isset($data)==true ?$data['simotelApi']['server_address'] : ""?>">
            </div>
            <div class="mb-3">
                <label for="token" class="form-label">توکن:</label>
                <input type="text" class="form-control" name="token" id="token" value="<?php echo  isset($data)==true ?$data['simotelApi']['api_key'] : ""?>" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">نام کاربری:</label>
                <input type="text" class="form-control" name="username" id="username" value="<?php echo  isset($data)==true ?$data['simotelApi']['api_user'] : ""?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">رمز عبور:</label>
                <input type="password" class="form-control" name="password" id="password" value="<?php echo  isset($data)==true ?$data['simotelApi']['api_pass'] : "" ?>" required>
            </div>
            <div class="mb-3">
                <label for="tokenType" class="form-label">نوع توکن:</label>
                <select class="form-control" id="tokenType" name="tokenType" value="<?php echo  isset($data)==true ?$data['simotelApi']['api_auth'] : ""?>" required>
                    <option value="token">token</option>
                    <option value="basicAuth">basicAuth</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">ثبت</button>
        </form>
    </div>

    <script>
        document.getElementById("dataForm").addEventListener("submit", function(event) {
            event.preventDefault(); // جلوگیری از ارسال فرم به صفحه دیگر

            // دریافت مقادیر ورودی فرم
            var serverAddress = document.getElementById("serverAddress").value;
            var token = document.getElementById("token").value;
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var tokenType = document.getElementById("tokenType").value;

            var formData = $(this).serialize();

            $.ajax({
            url: "store.php", // مسیر فایل PHP
            type: "POST",
            data: formData, // ارسال داده‌های فرم
            success: function(response) {
                console.log(response); // پاسخ دریافتی از سمت سرور
                alert("با موفقیت ذخیره شد.");
            }
        });
      


        });
    </script>

</body>
</html>
