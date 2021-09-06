$('#submitButton').on('click', function (e) {
        e.preventDefault();
    var name = $('#name_singer').val();
    $.ajax({
        url: " http://127.0.0.1:8000/api/singer/store",
        type: "POST",
        data: {
            name: name,
        },
        success: function (name) {
          return window.location.href = "http://127.0.0.1:8000/admin";
        },
        error: function () {
            alert("tên ca sĩ đã tồn tại")
        }
    });
});
