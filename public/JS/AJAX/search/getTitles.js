var availableTags = [];
$.ajax({
    type: "POST",
    url: "/ajaxTitlePost",
    success: function (data) {
        for (var i = 0; i < data.a[0]["topic"].length; i++) {
            availableTags.push(data.a[0]['topic'][i]['topic']);
        }
    },
});