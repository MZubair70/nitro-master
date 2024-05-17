
    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- Daterangepicker js -->
    <script src="assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="assets/vendor/daterangepicker/daterangepicker.js"></script>

    <!-- Apex Charts js -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>

    <!-- Vector Map js -->
    <script src="assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

    <!-- Dashboard App js -->
    <script src="assets/js/pages/dashboard.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

    <script>
        
        document.getElementById('ab-list').addEventListener('input', function() {
            var inputText = this.value.trim();
            var listContainer = document.getElementById('inputList');
            listContainer.innerHTML = ''; // Clear previous list items
            if (inputText) {
                var items = inputText.split(',').map(function(item) {
                    return item.trim();
                });
                items.forEach(function(item) {
                    var li = document.createElement('li');
                    li.textContent = item;
                    listContainer.appendChild(li);
                });
            }
        });
    </script>

</body>
</html>