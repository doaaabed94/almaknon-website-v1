<?php if(isset($options)): ?>
    <?php
        $_X = array_merge([
            'id'          => null,
            'name'        => null,
            'type'        => 'text',
            'label'       => null,
            'placeholder' => null,
            'help'        => null,
            'class'       => null,
            'container_attributes' => null,
            'attr'        => null,
            'value'       => null,
            'view'        => 'DEFAULT', //INLINE | DEFAULT
            'label_size'  => 'col-lg-3',
            'input_size'  => 'col-lg-8',
            'container_class'  => null,
            'disabled'    => false,
            'readonly'    => false,
            'errors'      => $errors,
            'showErrors'  => true,
        ], $options);
    ?>
    <?php if($_X['view'] == 'INLINE'): ?>
        <div class="form-group row <?php echo $_X['container_class']; ?>" <?php echo $_X['container_attributes']; ?>>
            <?php if($_X['label']): ?>
                <label class="<?php echo $_X['label_size']; ?> col-form-label"><?php echo $_X['label']; ?></label>
            <?php endif; ?>
            <div class="<?php echo $_X['input_size']; ?>">
                <input name="<?php echo $_X['name']; ?>" type="<?php echo $_X['type']; ?>" class="form-control <?php echo $_X['errors']->has($_X['name']) ? 'is-invalid' : ''; ?> <?php echo $_X['class']; ?>" placeholder="<?php echo e($_X['placeholder']); ?>" value="<?php echo e($_X['value']); ?>" <?php echo $_X['attr']; ?> <?php echo $_X['readonly'] ? 'readonly=""' : ''; ?> <?php echo $_X['disabled'] ? 'disabled=""' : ''; ?>>
                <?php if($_X['errors']->has($_X['name']) && $_X['showErrors']): ?>
                    <div class="invalid-feedback"><?php echo $_X['errors']->first($_X['name']); ?></div>
                <?php endif; ?>
                <?php if($_X['help']): ?>
                    <span class="form-text text-muted"><?php echo $_X['help']; ?></span>
                <?php endif; ?>
            </div>
        </div>
    <?php elseif($_X['view'] == 'DEFAULT'): ?>
        <div class="form-group <?php echo $_X['container_class']; ?>" <?php echo $_X['container_attributes']; ?>>
            <?php if($_X['label']): ?>
                <label><?php echo $_X['label']; ?></label>
            <?php endif; ?>
            <input name="<?php echo $_X['name']; ?>" type="<?php echo $_X['type']; ?>" class="form-control <?php echo $_X['errors']->has($_X['name']) ? 'is-invalid' : ''; ?> <?php echo $_X['class']; ?>" placeholder="<?php echo e($_X['placeholder']); ?>" value="<?php echo e($_X['value']); ?>" <?php echo $_X['attr']; ?> <?php echo $_X['readonly'] ? 'readonly=""' : ''; ?> <?php echo $_X['disabled'] ? 'disabled=""' : ''; ?>>
            <?php if($_X['errors']->has($_X['name']) && $_X['showErrors']): ?>
                <div class="invalid-feedback"><?php echo $_X['errors']->first($_X['name']); ?></div>
            <?php endif; ?>
            <?php if($_X['help']): ?>
                <span class="form-text text-muted"><?php echo $_X['help']; ?></span>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endif; ?><?php /**PATH /home/u587692534/domains/almaknon.com/public_html/Modules/Member/Resources/views/common-components/inputs/text.blade.php ENDPATH**/ ?>