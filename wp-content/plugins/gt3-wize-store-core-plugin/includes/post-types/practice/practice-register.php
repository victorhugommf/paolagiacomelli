<?php


/**
* 
*/
class GT3PracticeRegister{

	public $cpt;
	public $dest_taxonomy;
    private $tag_taxonomy;
	private $slug;
	
	function __construct(){
		$this->cpt = 'projects';
		$this->taxonomy = 'projects-category';
		$this->slug =  'projects';
	}

	public function register(){
		$this->registerPostType();
		$this->registerTax();         
	}

	private function getSlug(){
		$slug  = $this->slug;
	}

	private function registerPostType(){

        register_post_type($this->cpt,
            array(
                'labels' 		=> array(
                    'name' 				=> __('Projects','gt3-wize-core' ),
                    'singular_name' 	=> __('Project','gt3-wize-core' ),
                    'add_item'			=> __('New Project','gt3-wize-core'),
                    'add_new_item' 		=> __('Add New Project','gt3-wize-core'),
                    'edit_item' 		=> __('Edit Project','gt3-wize-core')
                ),
                'public'		=>	true,
                'has_archive' => true,
                'rewrite' 		=> 	array('slug' => $this->slug),
                'menu_position' => 	5,
                'show_ui' => true,
                'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
                'menu_icon'  =>  'dashicons-chart-area'
            )
        );

	}

	private function registerTax() {
        $labels = array(
            'name' => __( 'Project Categories', 'gt3-wize-core' ),
            'singular_name' => __( 'Project Category', 'gt3-wize-core' ),
            'search_items' =>  __( 'Search Project Categories','gt3-wize-core' ),
            'all_items' => __( 'All Project Categories','gt3-wize-core' ),
            'parent_item' => __( 'Parent Project Category','gt3-wize-core' ),
            'parent_item_colon' => __( 'Parent Project Category:','gt3-wize-core' ),
            'edit_item' => __( 'Edit Project Category','gt3-wize-core' ),
            'update_item' => __( 'Update Project Category','gt3-wize-core' ),
            'add_new_item' => __( 'Add New Project Category','gt3-wize-core' ),
            'new_item_name' => __( 'New Project Category Name','gt3-wize-core' ),
            'menu_name' => __( 'Categories','gt3-wize-core' ),
        );

        register_taxonomy($this->taxonomy, array($this->cpt), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'projects-category' ),
        ));
        /*$dest_labels = array(
            'name' => __( 'Destinations', 'gt3-wize-core' ),
            'singular_name' => __( 'Destination', 'gt3-wize-core' ),
            'search_items' =>  __( 'Search Destinations','gt3-wize-core' ),
            'all_items' => __( 'All Destinations','gt3-wize-core' ),
            'parent_item' => __( 'Parent Destination','gt3-wize-core' ),
            'parent_item_colon' => __( 'Parent Destination:','gt3-wize-core' ),
            'edit_item' => __( 'Edit Destination','gt3-wize-core' ),
            'update_item' => __( 'Update Destination','gt3-wize-core' ),
            'add_new_item' => __( 'Add New Destination','gt3-wize-core' ),
            'new_item_name' => __( 'New Destination Name','gt3-wize-core' ),
            'menu_name' => __( 'Destinations','gt3-wize-core' ),
        );

        register_taxonomy($this->dest_taxonomy, array($this->cpt), array(
            'hierarchical' => true,
            'labels' => $dest_labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => $this->slug.'-category' ),
        ));

        $tag_labels = array(
            'name' => __( 'Tags', 'gt3-wize-core' ),
            'singular_name' => __( 'Tag', 'gt3-wize-core' ),
            'search_items' =>  __( 'Search Tags','gt3-wize-core' ),
            'all_items' => __( 'All Tags','gt3-wize-core' ),
            'parent_item' => __( 'Parent Tag','gt3-wize-core' ),
            'parent_item_colon' => __( 'Parent Tag:','gt3-wize-core' ),
            'edit_item' => __( 'Edit Tag','gt3-wize-core' ),
            'update_item' => __( 'Update Tag','gt3-wize-core' ),
            'add_new_item' => __( 'Add New Tag','gt3-wize-core' ),
            'new_item_name' => __( 'New Tag Name','gt3-wize-core' ),
            'menu_name' => __( 'Tags','gt3-wize-core' ),
        );

        register_taxonomy($this->tag_taxonomy, array($this->cpt), array(
            'hierarchical' => true,
            'labels' => $tag_labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => $this->slug.'-tag' ),
        ));*/

    }

    public function registerSingleTemplate($single){
        global $post;

        if($post->post_type == $this->cpt) {
            if(!file_exists(get_template_directory().'/single-'.$this->cpt.'.php')) {
                return plugin_dir_path( dirname( __FILE__ ) ) .'practice/templates/single-'.$this->cpt.'.php';
            }
        }

        return $single;  
    }

    /*public function registerArchiveTemplate($archive){
        global $post;

        if(is_post_type_archive ($this->cpt)) {
            if(!file_exists(get_template_directory().'/archive-'.$this->cpt.'.php')) {
                return plugin_dir_path( dirname( __FILE__ ) ) .'tour/templates/archive-'.$this->cpt.'.php';
            }
        }

        return $archive;  
    }*/

}



?>