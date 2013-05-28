<?php global $wpalchemy_media_access; ?>

<div class="my_meta_control wpa_portfolio">

    <div class="wpa_group">
        <div class="my_meta_field_container postbox">
            <?php $mb->the_field('link'); ?>
            <label for="<?php $mb->the_name(); ?>" class="label">Site URL (include 'http://')</label>
            <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
            <?php $mb->the_field('title'); ?>
            <label for="<?php $mb->the_name(); ?>" class="label">Link title attribute</label>
            <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
            <?php $mb->the_field('alt'); ?>
            <label for="<?php $mb->the_name(); ?>" class="label">Link alt attribute</label>
            <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/>
            <?php $metabox->the_field('hidelink'); ?>
            <p><input type="checkbox" name="<?php $metabox->the_name(); ?>" value="1"<?php if ($metabox->get_the_value()) echo ' checked="checked"'; ?>/> Hide link</p>            
        </div>
    </div>

    <?php while($mb->have_fields_and_multi('views')): ?>
    <?php $mb->the_group_open(); ?>

        <a href="#" class="dodelete button">Remove View</a>
        <div class="my_meta_field_container postbox">
            <?php
            $mb->the_field('image_id');
            if (!$mb->is_last())
            {
                $image_id = ($mb->get_the_value() ? $mb->get_the_value() : $wpalchemy_media_access->generic_imgid);
            } else
            {
                $image_id = null;
            }
            $image_attrs = wp_get_attachment_image_src( $image_id, 'full');
            $image_url = $image_attrs[0];
            $thumb_attrs = wp_get_attachment_image_src( $image_id, 'fc-small');
            $thumb_url = $thumb_attrs[0];
            ?>

            <input type="hidden" id="image_id-n<?php $mb->the_index(); ?>" name="<?php $mb->the_name(); ?>" class="image_id" value="<?php echo $image_id; ?>"/>

            <?php $wpalchemy_media_access->setGroupName('img-n'. $mb->get_the_index())->setInsertButtonLabel('Insert Image')->setTab('type'); ?>

            <p class="label">Image</p>
            <div class="img_container clearfix">
                <img src="<?php echo $image_url; ?>" id="image_entire_id-n<?php $mb->the_index(); ?>" class="image_entire" alt="" />
                <p class="img_caption">Entire image</p>
            </div>
            <div class="img_container clearfix">
                <?php echo '<img src="' . $thumb_url . '" id="image_mob_id-n' . $mb->get_the_index() . '" class="image_mob" alt="" />'; ?>
                <p class="img_caption">Mobile (216x133)</p>
            </div>
            <p>
                <p id="image_url_wpa-n<?php $mb->the_index(); ?>" class="image_url_wpa"><?php echo $image_url; ?></p>
                <?php echo $wpalchemy_media_access->getButton(array('label' => 'Add Image')); ?>
            </p>         
        </div>
        <div class="my_meta_field_container postbox">
            <?php $mb->the_field('description'); ?>
            <label for="<?php $mb->the_name(); ?>" class="label">Description</label>
                <?php
                    $args = array( 'media_buttons' => false, 'textarea_name' => $mb->get_the_name(), 'textarea_rows' => '5', 'teeny' => false,);
                    $description_id = 'description_id-n' . $mb->get_the_index();
                    $contnt = html_entity_decode($mb->get_the_value());
                    wp_editor( $contnt, $description_id, $args);
                ?>
        </div>
    <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>

    <p><a href="#" class="docopy-views button">Add New View</a></p>

</div>