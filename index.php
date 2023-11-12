<?php

require("./vendor/autoload.php");
require("simotelApi.php");

?>

<html>
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محتویات فایل لاگ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="
https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js
"></script>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body class="container" dir="rtl">
  <table id="logTable" class="table">
            <thead>
                <tr>
                    <th>ردیف</th>
                    <th>محتوا</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
<script>
$(document).ready(function() {
    updateLogTable(); // برای بارگذاری اولیه جدول

    setInterval(function() {
        updateLogTable(); // برای به روزرسانی جدول هر ۵ ثانیه
    }, 5000);
});

function updateLogTable() {
    fetch('logs.log')
        .then(response => {
            if (!response.ok) {
                throw new Error('فایل مورد نظر یافت نشد');
            }
            return response.text();
        })
        .then(data => {
            var logContent = data.split("\n");
            var tableBody = $('#logTable tbody');
            tableBody.empty();

            logContent.forEach(function(log, index) {
                var row = $('<tr>');
                row.append($('<td>').text(index + 1));
                row.append($('<td>').text(log));

                tableBody.append(row);
            });
        })
        .catch(error => {
            console.error(error); // جهت نمایش خطا در کنسول مرورگر
        });
}
</script>

</body>
</html>
