<?php

    class Api_model extends CI_Model {

        protected $_table_name = 'ml_images';
        protected $_primary_key = 'id';

        public function __construct()
        {
            parent::__construct();
        }

        public function get($id = NULL, $limit = NULL)
        {
            if ($id !== NULL)
            {
                $this->db->where($this->_primary_key, $id);

                $method = 'row';
            }
            else
            {
                $limit = empty($limit) ? '18446744073709551615' : $limit;

                $this->db->limit($limit);

                $method = 'result';
            }

            return $this->db->get($this->_table_name)->$method();
        }

        public function update($id, $values)
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
