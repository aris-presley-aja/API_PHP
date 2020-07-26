<?php
    class movie_model extends CI_model {
        public function getMovie($id_series_movie = null) {
            if($id_series_movie === null) {
                return $this->db->get('series_movie')->result_array(); 
            } else {
                return $this->db->get_where('series_movie', ['id_series_movie' => $id_series_movie])->result_array();

            }
        }

        public function deleteMovie($id_series_movie) {
            $this->db->delete('series_movie', ['id_series_movie' => $id_series_movie]);
            return $this->db->affected_rows();
        }

        public function createMovie($data) {
            $this->db->insert('series_movie', $data);
            return $this->db->affected_rows();
        } 

        public function updateMovie($data, $id_series_movie) {
            $data['id_series_movie']=$id_series_movie;
            $this->db->update('series_movie', $data, ['id_series_movie' => $id_series_movie]);
            return $this->db->affected_rows();
        }
    }
?>