<?php
require_once plugin_dir_path( __FILE__ ) . '../class/class-wp-list-table.php';

class Filter_Network_Users extends WP_List_Table_Extra {

  public $exclude_super_admins;

  function __construct() {
    parent::__construct( array(
      'singular'=> 'filter_network_user', //Singular label
      'plural' => 'filter_network_users', //plural label, also this well be one of the table css class
      'ajax'      => false
    ) );
  }

  /**
  * Add extra markup in the toolbars before or after the list
  * @param string $which, helps you decide if you add the markup after (bottom) or before (top) the list
  */
  function extra_tablenav( $which ) {
    if ( $which == "top" ){
      //The code that goes before the table is here
      echo '<style>.tablenav.top{height:auto !important;}</style>';
      $selected_roles = isset($_POST[ 'role' ]) ? $_POST[ 'role' ] : ['administrator'];
      $exclude_super_admins = isset($_POST[ 'exclude_sa' ]) ? true : false;


      echo ' <select multiple name="role[]" style="float:none;">';
      $r = '';
      $editable_roles = array_reverse( get_editable_roles() );
      foreach ( $editable_roles as $role => $details ) {
        $name = translate_user_role($details['name'] );
        if (  in_array($role,$selected_roles) ) {
          $r .= "\n\t<option selected='selected' value='" . esc_attr( $role ) . "'>$name</option>";
        } else {
          $r .= "\n\t<option value='" . esc_attr( $role ) . "'>$name</option>";
        }
      }
      echo $r;
      echo '</select>';


      $sites = get_sites();
      $selected_site = isset($_POST[ 'blog_id' ]) ? $_POST[ 'blog_id' ] : '0';
      echo ' <select name="blog_id" style="float:none;">
      <option value="0">All</option>';

      foreach($sites as $site){
        $selected = $site->blog_id == $selected_site ? ' selected="selected"' : '';
        echo '<option value="' . $site->blog_id . '"' . $selected . '>' . $site->domain . '</option>';
      }
      // echo '<input type="submit" class="button" value="Filter">';
      echo '</select>';

      // $selected = $role->name == $selected_site ? ' selected="selected"' : '';
      echo '<input type="checkbox" name="exclude_sa" value="true" ';
      echo $exclude_super_admins ? 'checked': '';
      echo '> Exclude Super Admins';
      echo '<input type="submit" class="button" value="Filter">';
      // echo '</div>';
    }
  }

  function get_columns() {
    $c = array(
      // 'id' => __( 'ID' ),
      'username' => __( 'Username' ),
      // 'name'     => __( 'Name' ),
      'email'    => __( 'Email' ),
      'role'     => __( 'Role' ),
      'site'     => __( 'Sites' ),
      'registration_date'     => __( 'Registered at' ),
    );

    return $c;
  }

  function prepare_items() {
    $selected_role = isset($_POST[ 'role' ] ) ? $_POST[ 'role' ] : 'administrator';
    $this->exclude_super_admins = isset($_POST[ 'exclude_sa' ]) ? $_POST[ 'exclude_sa' ] : false;
    $this->_column_headers = array(
      $this->get_columns(),
      array(),
      array()
    );
    $records= [];
    if (isset($_REQUEST['blog_id']) && $_REQUEST['blog_id'][0] !== '0') {

      $site_users = get_users(array('blog_id' => $_REQUEST['blog_id'], 'role__in' => $selected_role));
      array_push($records,$site_users);

    }
    else {
      $sites = get_sites();
      foreach($sites as $site ) {

        $records[] = get_users(
          array(
            // 'fields' => array( 'site_id' ),
            'blog_id' => $site->id,
            'role__in' => $selected_role
          )
        );

      }
    }
    $this->items = $records;

  }

  function display_rows() {
    $records = $this->items;
    list( $columns, $hidden, $sortable, $primary ) = $this->get_column_info();
    if(!empty($records)){
      foreach ($records as $sites)
      {      foreach($sites as $rec){

        echo (is_super_admin($rec->ID) && $this->exclude_super_admins) ? '<tr id="record_'.$rec->ID.'" style="display:none;">' : '<tr id="record_'.$rec->ID.'">';

        foreach ( $columns as $column_name => $column_display_name ) {
          $class = "class='$column_name column-$column_name'";
          $style = "";
          if ( in_array( $column_name, $hidden ) ) $style = ' style="display:none;"';
          $attributes = $class . $style;

          switch ( $column_name ) {
            // case "id":  echo '<td '.$attributes.'>'.stripslashes($rec->ID).'</td>';     break;
            case "username":
            if (is_super_admin($rec->ID)) {
              echo '<td '.$attributes.'><b>'.stripslashes($rec->user_login).'</b> - Super Admin </td>';
            } else {

              echo '<td '.$attributes.'>'.stripslashes($rec->user_login).'</td>';
            }

            break;
            case "email": echo '<td '.$attributes.'>'.stripslashes($rec->user_email).'</td>'; break;
            // case "name": echo '<td '.$attributes.'>'.$rec->display_name.'</td>'; break;
            case "site":
            $users_blogs = get_blogs_of_user($rec->ID);
            echo '<td '.$attributes.'>';

            foreach ($users_blogs as $users_blog ) {
              echo '<a href="'.$users_blog->siteurl.'">'.$users_blog->blogname.'</a><br />';
            }
            echo '</td>';

            break;
            case "role":
            echo '<td '.$attributes.'>';

            foreach ($rec->roles as $role ) {
              echo '<div>'.$role.'</div><br />';
            }
            echo '</td>';

            break;
            case "registration_date": echo '<td '.$attributes.'>'.$rec->user_registered.'</td>'; break;
          }
        }
        echo'</tr>';
      }}
    }
  }

}
