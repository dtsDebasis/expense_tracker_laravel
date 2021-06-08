$( document ).ready(function() {
    console.log( "Expense page" );
    get_list();
    var opened = false;
    $("#expense_form").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var id = $("#edit_id").val();
        var member_id = $("#member_id").val();
        var amount = $("#amount").val();


        var url = '';
        var data = {};
        if (id) {
            data = {
                "expense_id": id,
                "member_id": member_id,
                "amount": amount
            };
            url = '/api/v1/update_expense';
        } else {
            data = {
                "member_id": member_id,
                "amount": amount
            };
            url = '/api/v1/add_expense';
        }

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (response) {
                if (response.status == 201 || response.status == 200) {
                    console.log(response);
                    get_list();
                    location.reload();
                    $("#expense_form").trigger("reset");
                    $('.add_btn').click();
                    //$('.error-msg').hide();
                }
            },
            error: function (request, status, error) {
                $('.error-msg').show();
            }
        });

    });

    function get_list() {
        $.ajax({
            url: '/api/v1/get_all_expenses',
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
                        var i = 1;
                        response.forEach(expense => {
                            //console.log(expense);
                            var inner_html = null;
                            inner_html = "<tr>";
                            inner_html = inner_html+'<th scope="row">'+i+'</th>';
                            inner_html = inner_html+'<td>'+expense.member.full_name+'</td>';
                             //inner_html = inner_html+'<td>'+expense.created_at+'</td>';
                            inner_html = inner_html+'<td>Rs.'+expense.amount+'</td>';
                            inner_html = inner_html+'<td><button expense_id="'+expense.id+'" member_id="'+expense.member_id+'" amount="'+expense.amount+'" type="button" class="btn btn-light expense_edit_btn">Edit</button></td>';
                            inner_html = inner_html+'</tr>';
                            summary_section.append(inner_html);
                            i++;
                        });
                    } else {
                        var inner_html = null;
                        inner_html = "<td>";
                        inner_html = inner_html+'<td>No data</td>';
                        inner_html = inner_html+'</tr>';
                        summary_section.append(inner_html);
                    }
                }
                //console.log(response);
            }
        });
    }
    $(".add_btn").click(function(){

        opened = true;
    });
    $(document.body).on('click','.expense_edit_btn', function(e) {
        $("#expense_form").trigger("reset");
        var expense_id = $(this).attr("expense_id");
        var member_id = $(this).attr("member_id");
        var amount = $(this).attr("amount");
        $("#edit_id").val(expense_id);
        $("#member_id").val(member_id);
        $("#amount").val(amount);

        if (!opened) {
          $('.add_btn').click();
        }
        //alert(expense_id);
    });
});
