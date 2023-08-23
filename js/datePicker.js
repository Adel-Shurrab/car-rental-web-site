$(document).ready(function () {
  $("#datepicker").datepicker({
    minDate: new Date(2023, 1 - 1, 1),
  });

  $("#timepicker").on("click", function () {
    $("#timepicker").removeClass("time");
  });
});
