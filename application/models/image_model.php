<?php

    class Image_model extends Api_model {

        protected $_table_name = 'ml_images';
        protected $_primary_key = 'id';

        public function __construct()
        {
            parent::__construct();
        }
    }
