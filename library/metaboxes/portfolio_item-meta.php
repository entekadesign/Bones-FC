<?php global $wpalchemy_media_access; ?>

<div class="my_meta_control">

    
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
            <?php $mb->the_field('image_id'); ?>
            <?php $image_id = $mb->get_the_value(); ?>
            <input type="hidden" id="image_id-n<?php $mb->the_index(); ?>" name="<?php $mb->the_name(); ?>" class="image_id" value="<?php echo $image_id; ?>"/>

            <?php $mb->the_field('imgurl'); ?>
            <?php $wpalchemy_media_access->setGroupName('img-n'. $mb->get_the_index())->setInsertButtonLabel('Insert Image')->setTab('type'); ?>

            <p class="label">Image</p>
            <div class="img_container clearfix">
                <img src="<?php $mb->the_value(); ?>" id="img_thumbnail_id-n<?php $mb->the_index(); ?>" class="img_thumbnail" alt="" />
                <p class="img_caption">Entire image</p>
            </div>
            <div class="img_container clearfix">
                <?php
                $view_indx = $mb->get_the_index();            
                $image_url = $mb->get_the_value();
                //$thumb_url = pathinfo($image_url, PATHINFO_DIRNAME) . '/' . pathinfo($image_url, PATHINFO_FILENAME) . '-216x133.' . pathinfo($image_url, PATHINFO_EXTENSION);
                //wp_enqueue_script('my_thumb_url_script');
                //$my_data = array('thumb_url' => __($thumb_url));
                //wp_localize_script('my_thumb_url_script', 'fc_thumb_url', $my_data);
                //$thumb_pth = str_replace(site_url(), $_SERVER['DOCUMENT_ROOT'], $thumb_url);
                //$thumb_pth = str_replace(site_url(), '..', $thumb_url);
                //echo wp_get_attachment_url($image->ID);
                //echo '<img src="'; if (realpath($thumb_url)) $thumb_url; echo '" id="img_mob_thumb_id-n' . $view_indx . '" class="img_mob_thumb" alt="" />';
                //$thumb_id = 'img_mob_thumb_id-n' . $view_indx;
                //$attrs = array( 'id' => $thumb_id, 'class' => 'img_mob_thumb', );
                //echo wp_get_attachment_image( $image_id, 'fc-clients-thumb-mob-tab', false, $attrs );
                $thumb_attrs = wp_get_attachment_image_src( $image_id, 'fc-clients-thumb-mob-tab');
                echo '<img src="' . $thumb_attrs[0] . '" id="img_mob_thumb_id-n' . $view_indx . '" class="img_mob_thumb" alt="" />';
                ?>
                <p class="img_caption">Mobile (216x133)</p>
            </div>
            <p>
                <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $image_url)); ?>
                <?php echo $wpalchemy_media_access->getButton(array('label' => 'Add Image')); ?>
            </p>
            <?php $mb->the_field('thumb_url'); ?>
            <input type="hidden" id="thumb_url-n<?php $mb->the_index(); ?>" name="<?php $mb->the_name(); ?>" class="thumb_url" value="<?php echo $thumb_attrs[0]; ?>"/>            
        </div>
        <div class="my_meta_field_container postbox">
            <?php $mb->the_field('description'); ?>
            <label for="<?php $mb->the_name(); ?>" class="label">Description</label>
                <?php
                    $args = array( 'media_buttons' => false, 'textarea_name' => $mb->get_the_name(), 'textarea_rows' => '5', 'teeny' => false,);
                    $description_id = 'description_id-n' . $view_indx;
                    $contnt = html_entity_decode($mb->get_the_value());
                    wp_editor( $contnt, $description_id, $args);
                ?>
        </div>
    <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>

    <p><a href="#" class="docopy-views button">Add New View</a></p>

</div>