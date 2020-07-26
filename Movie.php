

<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Movie extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Movie_model', 'movie');
    }
    // Get Data
    public function index_get() {
        $id_series_movie = $this->get('id_series_movie');
        // jika id tidak ada (tidak panggil) 
        if($id_series_movie === null) {
            // maka panggil semua data
            $Movie = $this->movie->getMovie();
            // tapi jika id di panggil maka hanya id tersebut yang akan muncul pada data tersebut
        } else {
            $movie = $this->movie->getMovie($id_series_movie);
        }
        if($Movie) {
            $this->response([
                'status' => true,
                'data' => $Movie
            ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        
        }
    }
    // delete data
    public function index_delete() {
        $id_series_movie = $this->delete('id_series_movie');
        if($id_series_movie === null) {
            $this->response([
                'status' => false,
                'message' => 'provide an id'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        } else {
            if($this->movie->deleteMovie($id_series_movie) > 0) {
                // Ok
                $this->response([
                    'status' => true,
                    'id_series_movie' => $id_series_movie,
                    'message' => 'deleted success'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else {
                // id not found
                $this->response([
                    'status' => false,
                    'message' => 'id not found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            
            }
        }
    }
    // post data
    public function index_post() {
        $data = [
            'id_series_movie' => $this->post('id_series_movie'),
            'title_series_movie' => $this->post('title_series_movie'),
            'desc_series_movie' => $this->post('desc_series_movie'),
            'id_banner_series_movie' => $this->post('id_banner_series_movie'),
            'id_poster_series_movie' => $this->post('id_poster_series_movie'),
            'show_title_banner_series_movie' => $this->post('show_title_banner_series_movie'),
            'show_title_poster_series_movie' => $this->post('show_title_poster_series_movie'),
            'status' => $this->post('status'),            
            'created_time' => $this->post('created_time'),
            'created_by' => $this->post('created_by'),            
            'updated_time' => $this->post('updated_time'),                
            'updated_by' => $this->post('updated_by')
        ];
        if ($this->movie->createMovie($data) > null) {
            $this->response([
                'status' => true,
                'message' => 'new Movie has been created'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed create data'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    // update data
    public function index_put() {
        $id_series_movie = $this->put('id_series_movie');
        $data = [
            'id_series_movie' => $this->put('id_series_movie'),
            'title_series_movie' => $this->put('title_series_movie'),
            'desc_series_movie' => $this->put('desc_series_movie'),
            'id_banner_series_movie' => $this->put('id_banner_series_movie'),
            'id_poster_series_movie' => $this->put('id_poster_series_movie'),
            'show_title_banner_series_movie' => $this->put('show_title_banner_series_movie'),
            'show_title_poster_series_movie' => $this->put('show_title_poster_series_movie'),
            'status' => $this->put('status'),            
            'created_time' => $this->put('created_time'),
            'created_by' => $this->put('created_by'),            
            'updated_time' => $this->put('updated_time'),                
            'updated_by' => $this->put('updated_by')
        ];
        if ($this->movie->updateMovie($data, $id_series_movie) > null) {
            $this->response([
                'status' => true,
                'message' => 'update Movie has been updated'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
?>
