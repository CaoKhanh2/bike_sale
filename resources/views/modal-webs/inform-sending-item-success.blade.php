
@if (Session::has('success-guiformthanhcong-guest'))

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: "{{ Session::get('success-guiformthanhcong-guest') }}",
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                toast: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
        });
    </script>

    <style>
        body {
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
    </style>
@endif
