$(document).ready(function () {
    var offset = new Date().getTimezoneOffset();
  
    var utc_timestamp = new Date().getTime();
  
    /*Convert our time to universal Time coordinated / Universal Coordinated time */
  
    var utc_timestamp = timestamp + 60000 * offset;
  
    //Passing the values to hidden inputs upon form submission
     $("#submit").click(function (event) {
      $("#utc_timestamp").val(utc_timestamp);
      $("#time_zone_offset").val(offset);

      //.val() will get the values from the inputs made on the utc_timestamp and offset in the lab1.php 
    });
  });