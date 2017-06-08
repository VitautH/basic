/**
 * Created by Vitaut on 24.05.2017.
 */
$(document).ready(function () {
     function filter() {
         var data = $( "form#filter_form" ).serialize();

         $.ajax({
                 url: '/products/filter',
             type: 'POST',
            data:  data,
         success: function(data) {
           $('.products').html(data);

         }
     });
     }
    $('#filter_submit').click(filter);

})