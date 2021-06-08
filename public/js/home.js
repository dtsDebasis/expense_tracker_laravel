$( document ).ready(function() {
    console.log( "Home page" );
    $.ajax({
        url: '/api/v1/get_summary/30',
        cache: false,
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            var response = null;
            var summary_section = $('.summary_section');
            if (data.status == 200) {
                response = data.data;
                var inner_html = null;
                if (response.highest_expense_by) {
                   inner_html = '<h1 class="display-4">Rs.'+response.total_spent+' spent in '+response.total_no_transaction+' transactions</h1>';
                   inner_html = inner_html+'<p class="lead" style="max-width: 650px; margin: 1.5em auto 0">'+response.total_no_member+' team mates have spend Rs.'+response.total_spent+' in the last '+response.summary_of+' days with '+response.total_no_transaction+' transactions. Team mate with most spending is '+response.highest_expense_by+' with Rs.'+response.highest_expense_amount+' spent.</p>';

                } else {
                    inner_html = `<h1 class="display-4">Cobold's Expense Monitor</h1>`;
                }
                summary_section.html(inner_html);
            }
            console.log(response);
        }
    });
});
