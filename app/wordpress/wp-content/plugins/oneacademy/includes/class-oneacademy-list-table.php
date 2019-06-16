<?php

if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Oneacademy_List_Table extends WP_List_Table {

    public function __construct() {
        parent::__construct(array(
            'singular' => 'Oneacademy Course',
            'plural' => 'Oneacademy Courses',
            'ajax' => false,
            'screen' => 'oneacademy',
        ));
    }

    public function get_columns() {
        return array(
            'id' => __('ID', 'oneacademy'),
            'name' => __('Name', 'oneacademy'),
            'sku' => __('SKU', 'oneacademy'),
            'categories' => __('Categories', 'oneacademy'),
            'date' => __('Date', 'oneacademy'),
        );
    }

    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items() {
        $usersearch = isset($_REQUEST['s']) ? wp_unslash(trim($_REQUEST['s'])) : '';
        $per_page = $this->get_items_per_page('edit_product_per_page', 20);
        $paged = $this->get_pagenum();
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();
        $query = new WC_Product_Query(array(
            'limit' => -1,
            'type' => 'mdl_course',
            'return' => 'ids',
        ));
        $wp_products = $query->get_products();
        foreach ($wp_products as $product_id) {
            $product = wc_get_product($product_id);
            $data[] = array(
                'id' => $product->get_id(),
                'name' => $product->get_title(),
                'sku' => $product->get_sku('edit'),
                'categories' => wc_get_product_category_list($product->get_id()), //woo_wallet()->wallet->get_wallet_balance( $user->ID ),
                'date' => wc_string_to_datetime($product->get_date_created('edit'))->date_i18n(wc_date_format())
            );
        }


        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
        $this->set_pagination_args(array(
            'total_items' => count($wp_products),
            'per_page' => $per_page,
        ));
    }

    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns() {
        return array('id');
    }

    /**
     * Define the sortable columns
     *
     * @return Array
     */
//    public function get_sortable_columns() {
//        $sortable_columns = array(
//            'date' => array('date', false),
//        );
//        return $sortable_columns;
//    }

    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default($item, $column_name) {
        switch ($column_name) {
            case 'id':
            case 'name':
            case 'sku':
            case 'categories':
            case 'date':
                return $item[$column_name];
            default:
                return print_r($item, true);
        }
    }

    /**
     * Get title column value.
     *
     * Recommended. This is a custom column method and is responsible for what
     * is rendered in any column with a name/slug of 'title'. Every time the class
     * needs to render a column, it first looks for a method named
     * column_{$column_title} - if it exists, that method is run. If it doesn't
     * exist, column_default() is called instead.
     *
     * This example also illustrates how to implement rollover actions. Actions
     * should be an associative array formatted as 'slug'=>'link html' - and you
     * will need to generate the URLs yourself. You could even ensure the links are
     * secured with wp_nonce_url(), as an expected security measure.
     *
     * @param object $item A singular item (one full row's worth of data).
     * @return string Text to be placed inside the column <td>.
     */
    protected function column_name($item) {
        $actions['view'] = sprintf(
                '<a href="%1$s">%2$s</a>', get_permalink($item['id']), _x('View', 'List table row action', 'wp-list-table-example')
        );
        $actions['edit'] = sprintf(
                '<a href="%1$s">%2$s</a>', get_edit_post_link($item['id']), _x('Edit', 'List table row action', 'wp-list-table-example')
        );

        $actions['trash'] = sprintf(
                '<a href="%1$s">%2$s</a>', get_delete_post_link($item['id']), _x('Trash', 'List table row action', 'wp-list-table-example')
        );
        // Return the title contents.
        return sprintf('%1$s <span style="color:silver;">(ID: %2$s)</span>%3$s', $item['name'], $item['id'], $this->row_actions($actions)
        );
    }

    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data($a, $b) {
        // Set defaults
        $orderby = 'date';
        $order = 'asc';
        // If orderby is set, use this as the sort column
        if (!empty($_GET['orderby'])) {
            $orderby = $_GET['orderby'];
        }
        // If order is set use this as the order
        if (!empty($_GET['order'])) {
            $order = $_GET['order'];
        }
        $result = strcmp($a[$orderby], $b[$orderby]);
        if ($order === 'asc') {
            return $result;
        }
        return -$result;
    }

}
