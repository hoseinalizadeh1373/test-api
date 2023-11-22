
document.getElementById("dataForm").addEventListener("submit", function(event) {
    event.preventDefault(); // جلوگیری از ارسال فرم به صفحه دیگر

    var formData = $(this).serialize();

    $.ajax({
    url: "store.php", // مسیر فایل PHP
    type: "POST",
    data: formData, // ارسال داده‌های فرم
    success: function(response) {
        
        alert("با موفقیت ذخیره شد.");
    }
});

});


document.getElementById("btn_send_ping").addEventListener("click",function(){
document.getElementById("status_ping").style.color="orange";
document.getElementById("status_ping").innerText="sending ...";
    $.ajax({
        url:"index.php",
        type:"POST",
        success :function (response){
            
            document.getElementById("status_ping").innerText="";
            updateLogTable();
            
        },
        error :function(error){
            document.getElementById("status_ping").innerText="error ";
        },

    });
});




function toggleFields() {
   
    var selectElement = document.getElementById('tokenType');
    
    var token_div = document.getElementById('div-token');
    var username_div = document.getElementById('div-username');
    var password_div = document.getElementById('div-password');

    if (selectElement.value === 'token') {
        token_div.style.display = 'block';
        username_div.style.display = 'none';
        password_div.style.display = 'none';
    } else if (selectElement.value === 'basicAuth') {
        token_div.style.display = 'none';
        username_div.style.display = 'block';
        password_div.style.display = 'block';
    }
    else {
        token_div.style.display = 'block';
        username_div.style.display = 'block';
        password_div.style.display = 'block';
    }
}

function getData(data,id_table,regex){
    var previousRows = [];
var logContent = data.split("\n");
var tableBody = $(id_table + ' tbody');

logContent.forEach(function(log, index) {

if (index >= logContent.length - 4) {
    
    var logRegex    = regex;
    var logMatch = log.match(logRegex);
    var row = createTableRow(logMatch);
    previousRows.push(row);
    previousRows.sort();
    previousRows.reverse();
    tableBody.empty();
    previousRows.forEach(function(row) {
        tableBody.append(row);
    });
        }
    });

    function createTableRow(logMatch) {
    
    var timestamp = logMatch[1]; 
    var date = timestamp.split("T")[0];
    var time = timestamp.split("T")[1].split('.')[0];
    var status = logMatch[2].split('.')[1];
    var message = logMatch[3];

    var row = '<tr>' +
      '<td>' + date + '</td>' +
      '<td>' + time + '</td>' +
      '<td>' + status + '</td>' +
      '<td>' + message + '</td>' +
      '</tr>';
    
    return row;
  }
}