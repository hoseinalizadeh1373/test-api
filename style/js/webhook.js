$(document).ready(function() {
    updatepingTable(); // برای بارگذاری اولیه جدول

    setInterval(function() {
        updatepingTable(); // برای به روزرسانی جدول هر ۵ ثانیه
    }, 5000);
});

function updatepingTable() {
    fetch('pings.log')
        .then(response => {
            if (!response.ok) {
                throw new Error('فایل مورد نظر یافت نشد');
            }
            return response.text();
        })
        .then(data => {
           var regex =/\[(\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\.\d{6}(?:[\+\-]\d{2}:\d{2})?)]\s([^:]+):\s(.+)/;
             getData(data,"#pingTable",regex);
        })
        .catch(error => {
            console.error(error); // جهت نمایش خطا در کنسول مرورگر
        });
}