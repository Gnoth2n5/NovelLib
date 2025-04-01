<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    // Cấu hình Toastr toàn cục
    toastr.options = {
        "newestOnTop": true, // Thông báo mới nhất hiển thị ở trên cùng
        "progressBar": true, // Hiển thị thanh tiến trình
        "positionClass": "toast-top-right", // Vị trí: top-right (mặc định)
        "preventDuplicates": false, // Ngăn thông báo trùng lặp
        "showDuration": "300", // Thời gian hiển thị hiệu ứng (ms)
        "hideDuration": "1000", // Thời gian ẩn hiệu ứng (ms)
        "timeOut": "3000", // Thời gian tự động ẩn (ms)
        "extendedTimeOut": "1000", // Thời gian bổ sung nếu người dùng tương tác (ms)
        "showEasing": "swing", // Hiệu ứng hiển thị
        "hideEasing": "linear", // Hiệu ứng ẩn
        "showMethod": "fadeIn", // Phương thức hiển thị
        "hideMethod": "fadeOut" // Phương thức ẩn
    };
</script>

<!-- Hiển thị thông báo flash -->
@if (session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
@endif

@if (session('error'))
    <script>
        toastr.error("{{ session('error') }}");
    </script>
@endif

@if (session('info'))
    <script>
        toastr.info("{{ session('info') }}");
    </script>
@endif

@if (session('warning'))
    <script>
        toastr.warning("{{ session('warning') }}");
    </script>
@endif