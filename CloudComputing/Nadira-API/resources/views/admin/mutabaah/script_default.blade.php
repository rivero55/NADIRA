<script>
  

    $('.razBtn').on('click', function() {
        $(this).closest("tr").remove();
    });

    function decPoin(poin) {
        totalPoin -= poin
        $('#totalSkor').text(totalPoin);
    }

</script>
