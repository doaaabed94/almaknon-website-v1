<?php if(isset($options)): ?>
    <?php
        $_X = array_merge([
            'id'          => null,
            'name'        => null,
            'label'       => null,
            'help'        => null,
            'class'       => null,
            'container_class' => null,
            'attr'        => null,
            'value'       => null,
            'view'        => 'DEFAULT', //INLINE | DEFAULT
            'label_size'  => 'col-lg-3',
            'input_size'  => 'col-lg-8',
            'size'        => null,
            'nullable'    => false,
            'nullable_v'  => null,
            'options'     => [],
            
            'text'        => function($K, $X){ return null; },
            'values'      => function($K, $X){ return null; },
            'subText'     => function($K, $X){ return null; },
            'option_attr' => function($K, $X){ return null; },
            'select'      => function($K, $X, $selected){ return false; },
            'disable'     => function($K, $X, $selected){ return false; },
            'disabled'    => false,
            'searchable'  => false,
            'errors'      => $errors,
            'showErrors'  => true,
        ], $options);
    ?>
    <?php if( $_X['view'] == 'INLINE' ): ?>
        <div class="form-group row">
            <label class="<?php echo $_X['label_size']; ?> col-form-label"><?php echo $_X['label']; ?></label>
            <div class="<?php echo $_X['input_size']; ?> <?php echo $_X['container_class']; ?>">
                <select name="<?php echo $_X['name']; ?>" class="form-control kt-selectpicker <?php echo $_X['errors']->has($_X['name']) ? 'is-invalid' : ''; ?> <?php echo $_X['class']; ?>" <?php echo (!is_null($_X['size'])) ? 'data-size="'. $_X['size'] .'"' : ''; ?> <?php echo $_X['attr']; ?> <?php echo $_X['disabled'] ? 'disabled=""' : ''; ?> <?php echo $_X['searchable'] ? 'data-live-search="true"' : ''; ?>>
                    <?php if( !is_null($_X['nullable']) ): ?>
                        <option value="<?php echo $_X['nullable_v']; ?>"><?php echo $_X['nullable']; ?></option>
                    <?php endif; ?>
                    <?php $__currentLoopData = $_X['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option 
                            <?php if( $attr = $_X['option_attr']($i, $option) ): ?> <?php echo $attr; ?> <?php endif; ?>
                            value="<?php echo $_X['values']($i, $option); ?>" 
                            data-subtext="<?php echo $_X['subText']($i, $option); ?>"
                            <?php if( $_X['select']($i, $option, $_X['value']) ): ?> selected="" <?php endif; ?>
                            <?php if( $_X['disable']($i, $option, $_X['value']) ): ?> disabled="" <?php endif; ?>>
                            <?php echo $_X['text']($i, $option); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($_X['errors']->has($_X['name']) && $_X['showErrors']): ?>
                    <div class="invalid-feedback"><?php echo $_X['errors']->first($_X['name']); ?></div>
                <?php endif; ?>
                <?php if($_X['help']): ?>
                    <span class="form-text text-muted"><?php echo $_X['help']; ?></span>
                <?php endif; ?>
            </div>
        </div>
    <?php elseif($_X['view'] == 'DEFAULT'): ?>
        <div class="form-group <?php echo $_X['container_class']; ?>">
            <label><?php echo $_X['label']; ?></label>
            <select name="<?php echo $_X['name']; ?>" class="form-control kt-selectpicker <?php echo $_X['errors']->has($_X['name']) ? 'is-invalid' : ''; ?> <?php echo $_X['class']; ?>" <?php echo (!is_null($_X['size'])) ? 'data-size="'. $_X['size'] .'"' : ''; ?> <?php echo $_X['attr']; ?> <?php echo $_X['disabled'] ? 'disabled=""' : ''; ?> <?php echo $_X['searchable'] ? 'data-live-search="true"' : ''; ?>>
                <?php if( !is_null($_X['nullable']) ): ?>
                    <option value="<?php echo $_X['nullable_v']; ?>"><?php echo $_X['nullable']; ?></option>
                <?php endif; ?>
                <?php $__currentLoopData = $_X['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option 
                        value="<?php echo $_X['values']($i, $option); ?>" 
                        data-subtext="<?php echo $_X['subText']($i, $option); ?>"
                        <?php if( $_X['select']($i, $option, $_X['value']) ): ?> selected="" <?php endif; ?>>
                        <?php echo $_X['text']($i, $option); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php if($_X['errors']->has($_X['name']) && $_X['showErrors']): ?>
                <div class="invalid-feedback"><?php echo $_X['errors']->first($_X['name']); ?></div>
            <?php endif; ?>
            <?php if($_X['help']): ?>
                <span class="form-text text-muted"><?php echo $_X['help']; ?></span>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endif; ?><?php /**PATH C:\Users\isc\Desktop\almaknon.com\Modules/Member\Resources/views/common-components/inputs/select.blade.php ENDPATH**/ ?>