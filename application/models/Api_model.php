<?php

    class Api_model extends CI_Model {
        public function get($id)
        {
            $q = $this->db->get_where('ml_images', ['id' => $id]);

            return $q->num_rows() === 1 ? $q->row() : FALSE;
        }

        public function get_all($limit = NULL)
        {
            if (empty($limit))
            {
                $q = $this->db->get('ml_images');
            }
            else
            {
                $q = $this->db->get('ml_images', $limit);
            }

            return $q->num_rows() > 0 ? $q->result() : FALSE;
        }

        public function update_image($id, $values)
        {
            @$this->db
                ->where('id', $id)
                ->update('ml_images', $values);

            return $this->db->affected_rows() > 0 ? TRUE : FALSE;
        }

        public function create_image($values)
        {
            $this->db->insert('ml_images', $values);

            return $this->db->insert_id() > 0 ? $this->db->insert_id() : FALSE;
        }

        public function delete_image($id)
        {
            $this->db->delete('ml_images', ['id' => $id]);

            return $this->db->affected_rows() === 1 ? TRUE : FALSE;
        }
    }
