<?php

class GT3PostTypesRegister{
    private static
        $instance = null;

    private $postTypes = array();
    private $allShortcodes = array();
  
    /**
     * @return Returns current instance of class
     */
    
    public static function getInstance() {
        if(self::$instance == null) {
            return new self;
        }

        return self::$instance;
    }

    public function register(){
        /*$this->postTypes['tour'] = new GT3TourRegister();*/
        $this->postTypes['team'] = new GT3TeamRegister();
        $this->postTypes['practice'] = new GT3PracticeRegister();
        foreach ($this->postTypes as $postType) {
            $postType->register();
        }

        if(class_exists('Vc_Manager')) {  
          $list = array(
              'team',
              'page'
          );
          vc_set_default_editor_post_types( $list );
        }
    }

    public function shortcodes(){
        /*new GT3Tour();*/
        //new GT3TourSearch();
        new GT3Practice();
    }

    private function __clone() {}
    private function __construct() {}
    private function __wakeup() {}
}
