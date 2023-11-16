<?php

require("./vendor/autoload.php");
require("simotelApi.php");
require("simotelConfig.php");

?>
<html>
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محتویات فایل لاگ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body class="" >
<div class="container">
  <div class="row">
  <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h1>Send Request Ping </h1>
          </div>
          <div class="card-body">
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="dataForm" method="post">
            <div class="mb-3">
                <label for="serverAddress" class="form-label">آدرس سرور:</label>
                <input type="text" class="form-control" name="serverAddress" id="serverAddress" required value="<?php echo  isset($data) == true ? $data['simotelApi']['server_address'] : ""?>">
            </div>
            <div class="mb-3">
            <label for="tokenType" class="form-label">نوع احراز هویت:</label>
                <select class="form-control" id="tokenType" name="tokenType"  required onchange="toggleFields()">
                
                    <option value="token" <?php echo(isset($data) == true) && $data['simotelApi']['api_auth'] == "token" ? "selected" : ""?>>token</option>
                    <option value="basicAuth" <?php echo(isset($data) == true) && $data['simotelApi']['api_auth'] == "basicAuth" ? "selected" : ""?>>basicAuth</option>
                    <option value="both" <?php echo(isset($data) == true) && $data['simotelApi']['api_auth'] == "both" ? "selected" : ""?>>both</option>
                    
                </select>
            </div>
            <div class="mb-3" id="div-token">
                <label for="token" class="form-label" >توکن:</label>
                <input type="text" class="form-control" name="token" id="token" value="<?php echo  isset($data) == true ? $data['simotelApi']['api_key'] : ""?>" required>
            </div>
            <div class="mb-3" id="div-username">
                <label for="username" class="form-label">نام کاربری:</label>
                <input type="text" class="form-control" name="username" id="username" value="<?php echo  isset($data) == true ? $data['simotelApi']['api_user'] : ""?>" required>
            </div>
            <div class="mb-3" id="div-password">
                <label for="password" class="form-label">رمز عبور:</label>
                <input type="password" class="form-control" name="password" id="password" value="<?php echo  isset($data) == true ? $data['simotelApi']['api_pass'] : "" ?>" required>
            </div>
           
            <button type="submit" class="btn btn-primary">ثبت</button>
        </form>

      </div>
      
    </div>
  </div>
</div>
  
  <div class="row align-items-center">
    <div class="col-3">
    <label for="server_address" class="form-label">simotel server :</label>
    </div>
    <div class="col-6">
    <input type="text" class="form-control" name="username" id="username" value="<?php echo  isset($data) == true ? $data['simotelApi']['server_address'] : ""?>" required>
    </div>
    <div class="col-1">
    <button type="button" class="btn " id="btnsetting" onclick="toggleFields()" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class="bi bi-gear"></i>
    </button>
    </div>
  </div>
  <div class="row align-items-center mt-2">
    <div class="col-4">
      <button class="btn btn-info" id="btn_send_ping">send request<i class="m-2 bi bi-send" ></i></button>
    </div>
    <div class="col-3">
      <span id="status_ping"> </span>
    </div>
  </div>
  <table id="logTable" class="table">
            <thead>
                <tr>
                    <th>تاریخ</th>
                    <th>زمان</th>
                    <th>وضعیت</th>
                    <th>پیام</th>
                  </tr>
            </thead>
            <tbody></tbody>
        </table>
  </div>
          </div>
        </div>
     
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h1>Reply From Server</h1>
          </div>
          <div class="card-body">
          <table id="pingTable" class="table">
            <thead>
                <tr>
                <th>تاریخ</th>
                <th>زمان</th>
                    <th>وضعیت</th>
                    <th>پیام</th>
                     
                </tr>
            </thead>
            <tbody></tbody>
        </table>
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="/style/js/index.js"></script>
<script src="/style/js/webhook.js"></script>
<script>
$(document).ready(function() {
  
    toggleFields(); // فراخوانی اولیه تابع toggleFields

     updateLogTable(); // برای بارگذاری اولیه جدول

    setInterval(function() {
        updateLogTable(); // برای به روزرسانی جدول هر ۵ ثانیه
    }, 5000);

  
    
});

function updateLogTable() {
  
  document.getElementById("status_ping").innerText="";

    fetch('logs.log')
        .then(response => {
            if (!response.ok) {
                throw new Error('فایل مورد نظر یافت نشد');
            }
            return response.text();
        })
        .then(data => {
          var regexx=/\[(\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\.\d{6}(?:[\+\-]\d{2}:\d{2})?)]\s([^:]+):\s(.+)/;
           getData(data,'#logTable',regexx);

        
        })
        .catch(error => {
            console.log(error); // جهت نمایش خطا در کنسول مرورگر
        });
}
</script>

</body>
</html>
