// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('.dataTable').DataTable({
    "pageLength": 25,
    "lengthMenu": [10, 25, 50, 100, 250, 500, 1000],
    "order": [[0, "desc"]]
  });
});