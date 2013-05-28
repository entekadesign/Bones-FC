<?php global $wpalchemy_media_access; ?>

<div class="my_meta_control wpa_post">

    <div class="my_meta_field_container">
        <?php
        $mb->the_field('image_id');
        $image_id = ($mb->get_the_value() ? $mb->get_the_value() : $wpalchemy_media_access->generic_imgid);
        $image_attrs = wp_get_attachment_image_src( $image_id, 'full');
        $image_url = $image_attrs[0];
        $thumb_attrs = wp_get_attachment_image_src( $image_id, 'fc-medium');
        $thumb_url = $thumb_attrs[0];
        ?>
        <input type="hidden" id="image_id" name="<?php $mb->the_name(); ?>" class="image_id" value="<?php echo $image_id; ?>"/>

        <?php $wpalchemy_media_access->setGroupName('img')->setInsertButtonLabel('Insert Image')->setTab('type'); ?>

        <p class="label">Image</p>
        <div class="img_container">
            <img src="<?php echo $image_url; ?>" id="image_entire" class="image_entire" alt="" />
            <p class="img_caption">Entire image</p>
        </div>
        <div class="img_container">
            <?php echo '<img src="' . $thumb_url . '" id="image_mob" class="image_mob" alt="" />'; ?>
            <p class="img_caption">Mobile (296x183)</p>
        </div>
        <p>
            <p id="image_url_wpa" class="image_url_wpa"><?php echo $image_url; ?></p>
            <?php //echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $image_url)); ?>
            <?php echo $wpalchemy_media_access->getButton(array('label' => 'Add Image')); ?>
        </p>
    </div>

</div>