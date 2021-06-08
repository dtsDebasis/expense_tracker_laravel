$(document).ready(function () {
    console.log("Teams page");
    get_list();
    $('.error-msg').hide();
    $("#team_mate").submit(function (e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var id = $("#edit_id").val();
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var email = $("#email").val();

        var data = {
            "id": id,
            "first_name": first_name,
            "last_name": last_name,
            "email": email
        }
        var url = '';
        if (id) {
            url = '/api/v1/member_update';
        } else {
            url = '/api/v1/member_add';
        }
        //var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: data, // serializes the form's elements.
            success: function (response) {
                if (response.status == 201) {
                    get_list();
                    $("#team_mate").trigger("reset");
                    $('.add_btn').click();
                    $('.error-msg').hide();
                }
            },
            error: function (request, status, error) {
                $('.error-msg').show();
            }
        });
    });

    function get_list() {
        $.ajax({
            url: '/api/v1/member_list',
            cache: false,
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                var response = null;
                var summary_section = $('.team-list');
                if (data.status == 200) {
                    response = data.data;
                    //console.log(response);
                    summary_section.html("");
                    if (response.length > 0) {

                        response.forEach(team => {
                            //console.log(team);
                            var inner_html = null;
                            inner_html = '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">';
                            inner_html = inner_html + '<div class="d-flex w-100 justify-content-between">';
                            inner_html = inner_html + '<h5 class="mb-1">' + team.full_name + '</h5>';
                            inner_html = inner_html + '<small>last expense: 0 days ago</small>';
                            inner_html = inner_html + '</div>';
                            inner_html = inner_html + '<small>' + team.first_name + ' has to pay Rs. ' + team.total_amount_to_give + '</small><br>';
                            inner_html = inner_html + '<small>' + team.first_name + ' should receive Rs. ' + team.total_amount_to_receive + '</small>';
                            inner_html = inner_html + '</a>';
                            summary_section.append(inner_html);
                        });
                    } else {
                        var inner_html = null;
                        inner_html = '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">';
                        inner_html = inner_html + '<div class="d-flex w-100 justify-content-between">';
                        inner_html = inner_html + '<h5 class="mb-1">Please Add Your First Teammate</h5>';
                        inner_html = inner_html + '</div>';
                        inner_html = inner_html + '</a>';
                        summary_section.append(inner_html);
                    }
                }
                //console.log(response);
            }
        });
    }
});
