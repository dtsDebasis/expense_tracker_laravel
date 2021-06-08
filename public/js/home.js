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

    $.ajax({
        url: '/api/v1/get_all_member_splits',
        cache: false,
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            var response = null;
            var summary_section = $('.transaction');
            if (data.status == 200) {
                response = data.data;
                var inner_html = null;
                if (response.length > 0) {
                    console.log(response);
                    response.forEach(member => {
                        inner_html = '<div class="col-lg-12" style="margin: 1em 0;">';
                        inner_html = inner_html+'<h2>'+member.first_name+' '+member.last_name+'</h2>';
                        inner_html = inner_html+'<ul class="list-group">';

                        member.splits.forEach(split => {
                           if (split.type == 'give') {
                            inner_html = inner_html+'<li class="list-group-item bg-danger text-white">'+split.display_text+'</li>';

                           } else {
                            inner_html = inner_html+'<li class="list-group-item bg-success text-white">'+split.display_text+'</li>';

                           }
                        });

                        inner_html = inner_html+'</ul>';
                        inner_html = inner_html+'</div>';
                        summary_section.append(inner_html);
                    });

                } else {
                    //inner_html = `<h1 class="display-4">Cobold's Expense Monitor</h1>`;
                }

            }
            //console.log(response);
        }
    });
});
