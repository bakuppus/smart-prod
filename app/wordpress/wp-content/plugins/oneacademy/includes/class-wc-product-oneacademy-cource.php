<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class WC_Product_Mdl_Course extends WC_Product_Simple {

    /**
     * Get internal type.
     *
     * @return string
     */
    public function get_type() {
        return 'mdl_course';
    }

}

new WC_Product_Mdl_Course();
