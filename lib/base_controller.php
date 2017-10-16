<?php

  class BaseController{

    public static function get_yllapitaja_logged_in(){
      $user = User::find($user_id);

      return $user;
    }

    public static function get_user_logged_in(){
      if(isset($_SESSION['user'])){
        $user_id = $_SESSION['user'];
        // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
        $user = User::find($user_id);

        return $user;
      }
      return null;
    }

    public static function check_logged_in(){
      if(!isset($_SESSION['user'])){
        Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
      }
    }

    public static function check_admin(){
      if(!isset($_SESSION['yllapitaja'])){
        return 1;
      }
      return null;
    }

    public static function paging_options($total_count) {
      $page_size = 10;
      $pages = ceil($total_count / $page_size);
      $page = 1;
      $prev_page = 1;
      $options = array(
        'page' => 1,
        'prev_page' => 1,
        'next_page' => 1,
        'pages' => $pages,
        'page_size' => $page_size,
      );

      if(isset($_GET['page'])) {
        $page = $_GET['page'];
        $options['page'] = $page;
        if ($page > 1) {
          $options['prev_page'] = $page - 1;
        }
        if ($pages > $page) {
          $options['next_page'] = $page + 1;
        } else if ($pages == $page) {
          $options['next_page'] = $page;
        }
      }
      return $options;
    }

  }
