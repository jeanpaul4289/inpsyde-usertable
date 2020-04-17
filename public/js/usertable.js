$(document).ready( function () {
    $('#users_table').DataTable({
        "ajax": { 
            "url": my_script_object.ajax_url + "?action=get_users",
            "dataSrc": "",
            "cache": true,
            "error": function (xhr, error, code) {
                alert('An error has ocurred, please try again. - ' + code);
            }
        },
        "columns": [
            {"data": "id"},
            {"data": "name"},
            {"data": "username"},
            {"data": "email"}
        ],
        "columnDefs": [{
            "targets": [0,1,2],
            "data": "download_link",
            "render": function (data, type, full, meta) {
                return '<a class="link" data-id="' + full.id + '" href="#" rel="modal:open">' + data + '</a>';
            }
        }],
        "lengthChange": false,
        "pageLength": 5
    });

    $('#users_table').on("click", "a.link", function() {
        var id = $(this).data("id");
       
        this.blur(); // Manually remove focus from clicked link.
        $.ajax({
            type : "post",
            url : my_script_object.ajax_url,
            dataType: "json",
            cache: true,
            data : {action: "get_user", user_id: id, user_nonce: my_script_object.user_nonce},
            success: function(response) {
                var user_details = jsonToHTML(response);
                $('#dialog').html(user_details).dialog({
                    modal: true,
                    width: 500,
                    height: 500,
                });
            },
            error: function(response) {
                alert('An error has ocurred, please try again.');
            }
        });
    });

    function jsonToHTML(json_object) {
        var user_data = '';
        for(var attr in json_object) {
            if (typeof json_object[attr] === "object") {
                user_data += '<br/><b><u>' + attr + '</u></b><br/>' + jsonToHTML(json_object[attr]);
            } else {
                user_data += '<b>' + attr + '</b>: ' + json_object[attr] + '<br/>';
            }
        }
        return user_data;
    }
});