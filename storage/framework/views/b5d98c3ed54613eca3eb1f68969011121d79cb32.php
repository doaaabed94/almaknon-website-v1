<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18"><?php echo e($title); ?></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                     <?php if(isset($li_1)): ?>
                      <li class="breadcrumb-item">
                        <a href="javascript: void(0);">
                          <?php echo e($li_1); ?>

                        </a>
                      </li>
                     <?php endif; ?>
                     <?php if(isset($title_li)): ?>
                        <li class="breadcrumb-item active"><?php echo e($title_li); ?></li>
                     <?php else: ?>
                        <li class="breadcrumb-item active"><?php echo e($title); ?></li>
                     <?php endif; ?>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title --><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Member/Resources/views/common-components/breadcrumb.blade.php ENDPATH**/ ?>