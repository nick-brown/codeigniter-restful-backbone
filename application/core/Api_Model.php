<?php

    class Api_Model extends CI_Model {

        protected $_table_name = '';
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

        public function update($values, $id = NULL)
        {
            if ($id === NULL)
            {
                $this->db->insert($this->_table_name, $values);

                $id = $this->db->insert_id();
            }
            else
            {
                $this->db
                    ->where($this->_primary_key, $id)
                    ->update($this->_table_name, $values);
            }

            return $id;
        }

        public function delete($id)
        {
            $this->db->delete($this->_table_name, [$this->_primary_key => $id]);

            return $this->db->affected_rows() === 1 ? $id : FALSE;
        }
    }
