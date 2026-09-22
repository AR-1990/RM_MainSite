<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?> - Proty Real Estate</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo e(url('assets-admin/css/app.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('assets-admin/css/components.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('assets-admin/css/custom.css')); ?>">
    
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo e(url('assets-admin/css/style.css')); ?>">
    
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(url('assets-admin/bundles/ionicons/css/ionicons.min.css')); ?>">
    
    <!-- Custom CSS -->
    <?php echo $__env->yieldPushContent('css'); ?>
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <!-- Header -->
            <?php echo $__env->make('admin.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <!-- Sidebar -->
            <?php echo $__env->make('admin.layout.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <!-- Main Content -->
            <div class="main-content">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            
            <!-- Footer -->
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; <?php echo e(date('Y')); ?> <div class="bullet"></div> Proty Real Estate
                </div>
                <div class="footer-right">
                    Version 1.0.0
                </div>
            </footer>
        </div>
    </div>

    <!-- jQuery (Load First) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- General JS Scripts -->
    <script src="<?php echo e(url('assets-admin/js/app.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets-admin/js/scripts.js')); ?>"></script>
    <script src="<?php echo e(url('assets-admin/js/custom.js')); ?>"></script>
    
    <!-- Sweet Alert -->
    <script src="<?php echo e(url('assets-admin/bundles/sweetalert/sweetalert.min.js')); ?>"></script>
    
    <!-- Toastr -->
    <script src="<?php echo e(url('assets-admin/bundles/izitoast/js/iziToast.min.js')); ?>"></script>
    
    <!-- DataTables -->
    <script src="<?php echo e(url('assets-admin/bundles/datatables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets-admin/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')); ?>"></script>
    
    <!-- Chart.js -->
    <script src="<?php echo e(url('assets-admin/bundles/chartjs/chart.min.js')); ?>"></script>
    <!-- ApexCharts (for dashboard charts) -->
    <script src="<?php echo e(url('assets-admin/bundles/apexcharts/apexcharts.min.js')); ?>"></script>
    
    <!-- Select2 -->
    <script src="<?php echo e(url('assets-admin/bundles/select2/dist/js/select2.full.min.js')); ?>"></script>
    
    <!-- Summernote -->
    <script src="<?php echo e(url('assets-admin/bundles/summernote/summernote-bs4.js')); ?>"></script>
    
    <!-- Dropzone -->
    <script src="<?php echo e(url('assets-admin/bundles/dropzonejs/min/dropzone.min.js')); ?>"></script>
    
    <!-- CKEditor -->
    <script src="<?php echo e(url('assets-admin/bundles/ckeditor/ckeditor.js')); ?>"></script>

    <!-- Page Specific JS -->
    <?php echo $__env->yieldPushContent('js'); ?>
    
    <!-- Custom Scripts -->
    <script>
        // Global AJAX setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        // Success message function
        function showSuccess(message) {
            iziToast.success({
                title: 'Success!',
                message: message,
                position: 'topRight'
            });
        }
        
        // Error message function
        function showError(message) {
            iziToast.error({
                title: 'Error!',
                message: message,
                position: 'topRight'
            });
        }
        
        // Warning message function
        function showWarning(message) {
            iziToast.warning({
                title: 'Warning!',
                message: message,
                position: 'topRight'
            });
        }
        
        // Info message function
        function showInfo(message) {
            iziToast.info({
                title: 'Info!',
                message: message,
                position: 'topRight'
            });
        }
        
        // Confirm delete function
        function confirmDelete(url, message = 'Are you sure you want to delete this item?') {
            Swal.fire({
                title: 'Are you sure?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create a form and submit
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = $('meta[name="csrf-token"]').attr('content');
                    
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    
                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
        
        // Initialize tooltips
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            
            // Initialize Select2
            $('.select2').select2();
            
            // Initialize Summernote
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            
            // Initialize DataTables
            $('.datatable').DataTable({
                responsive: true,
                pageLength: 25,
                order: [[0, 'desc']]
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\AR\Desktop\rm\resources\views/admin/layout/app.blade.php ENDPATH**/ ?>