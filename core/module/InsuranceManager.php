<?php
/**
 * Insurance Manager Class
 *
 * Handles insurance categories and content rendering
 */

namespace JTheme\Classes;

class InsuranceManager {

    public function get_top_level_services() {
        return get_posts([
            'post_type' => 'insurance',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'post_parent' => 0
        ]);
    }

    public function get_subservices($parent_id) {
        return get_posts([
            'post_type' => 'insurance',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'post_parent' => $parent_id
        ]);
    }

    public function has_subservices($service_id) {
        return !empty($this->get_subservices($service_id));
    }

    public function get_service_icon($service_id) {
        $icon_id = get_post_meta($service_id, 'insurance_icon', true);
        if ($icon_id) {
            $icon_url = wp_get_attachment_image_url($icon_id, 'thumbnail');
            if ($icon_url) return $icon_url;
        }
        return get_template_directory_uri() . '/assets/images/default-insurance-icon.svg';
    }

    public function render_service_card($service, $is_active = false) {
        $icon_url = $this->get_service_icon($service->ID);
        $has_subservices = $this->has_subservices($service->ID);
        $action_type = $has_subservices ? 'navigate' : 'link';
        $target_url = $has_subservices ? '#' : get_permalink($service->ID);
        ?>
        <div class="services-card <?php echo $is_active ? 'active' : ''; ?>"
             data-service-id="<?php echo $service->ID; ?>"
             data-action-type="<?php echo $action_type; ?>"
             data-target-url="<?php echo esc_url($target_url); ?>">
            <div class="services-card_img_container">
                <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($service->post_title); ?>">
            </div>
            <p><?php echo esc_html($service->post_title); ?></p>
            <?php if ($has_subservices): ?>
                <span class="subcategory-indicator">▶</span>
            <?php endif; ?>
        </div>
        <?php
    }

    public function render_service_content($service_id) {
        $service = get_post($service_id);
        if (!$service || $service->post_type !== 'insurance') {
            echo '<div class="error-message">خدمت مورد نظر یافت نشد.</div>';
            return;
        }
    
        $subservices = $this->get_subservices($service_id);
        $parent_hierarchy = $this->get_parent_hierarchy($service_id);
        ?>
        <div class="category-section mt-12 pt-4 border-t border-primary-bule/20">
            <?php if (!empty($parent_hierarchy) && count($parent_hierarchy) > 1): ?>
                <div class="breadcrumb text-right mb-4 text-gray-500 text-sm">
                    <?php foreach ($parent_hierarchy as $parent): ?>
                        <span data-service-id="<?php echo $parent->ID; ?>" class="breadcrumb-item cursor-pointer hover:text-primary-blue">
                            <?php echo $parent->post_title; ?>
                        </span>
                        <?php if ($parent !== end($parent_hierarchy)) echo ' / '; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
    
            <h2 class="hidden md:block text-xl font-bold mb-6 text-right"><?php echo esc_html($service->post_title); ?></h2>
    
            <?php if (!empty($subservices)): ?>
                <div class="main-services-grid">
                    <div class="flex justify-center gap-4">
                        <?php foreach ($subservices as $sub): ?>
                            <?php $this->render_service_card($sub); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="category-description text-right mb-6 text-gray-600">
                    <?php echo wpautop($service->post_content); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }
    
    public function get_parent_hierarchy($service_id) {
        $hierarchy = [];
        $current = get_post($service_id);

        while ($current && $current->post_parent > 0) {
            $hierarchy[] = $current;
            $current = get_post($current->post_parent);
        }

        $hierarchy[] = $current; // add root
        return array_reverse($hierarchy);
    }

    public function get_parent_services_by_category($category_id) {
        return get_posts([
            'post_type' => 'insurance',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'post_parent' => 0,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'tax_query' => [
                [
                    'taxonomy' => 'insurance_category',
                    'field' => 'term_id',
                    'terms' => $category_id
                ]
            ]
        ]);
    }
}
?>