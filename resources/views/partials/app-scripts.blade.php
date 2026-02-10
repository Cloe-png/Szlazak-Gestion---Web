<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof bootstrap !== 'undefined') {
            document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(function (el) {
                new bootstrap.Dropdown(el);
            });

            document.querySelectorAll('.toast').forEach(function (el) {
                const toast = new bootstrap.Toast(el, { autohide: true });
                toast.show();
            });
        }
    });
</script>
