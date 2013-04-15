<?php if (! defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

    class Categories extends REST_Controller {
        public function __construct()
        {
            parent::__construct();

            $this->load->model('category_model');
        }

        public function index_get()
        {
            $images = $this->category_model->get( NULL, $this->get('limit') );

            if ($images)
            {
                $this->response($images, 200); // 200 being the HTTP response code
            }

            else
            {
                $this->response(array('error' => 'Couldn\'t find any images!'), 404);
            }
        }

        public function category_get()
        {
            if (! $this->get('id'))
            {
                $this->response(NULL, 400);
            }

            $category = $this->category_model->get( $this->get('id') );

            if ($category)
            {
                $this->response($category, 200); // 200 being the HTTP response code
            }

            else
            {
                $this->response(array('error' => 'Image could not be found'), 404);
            }
        }

        // Update
        public function categories_put()
        {
            $values = [
                'id' => $this->put('id'),
                'parent_id' => $this->put('parent_id'),
                'category' => $this->put('category'),
                'level' => $this->put('level')
            ];

            $result = $this->category_model->update( $values, $this->put('id') );

            if ($result)
            {
                $this->response(array('status' => 'success'));
            }
            else
            {
                $this->response(array('status' => 'failed'));
            }
        }

        public function categories_post()
        {

            $values = [
                'id' => $this->put('id'),
                'parent_id' => $this->put('parent_id'),
                'category' => $this->put('category'),
                'level' => $this->put('level')
            ];

            $result = $this->category_model->update($values);

            if ($result)
            {
                $this->response(array('status' => 'success'));
            }
            else
            {
                $this->response(array('status' => 'failed'));
            }
        }

        public function categories_delete($id)
        {
            $result = $this->category_model->delete($id);

            if ($result === FALSE)
            {
                $this->response(array('status' => 'failed'));
            }
            else
            {
                $this->response(array('status' => 'success'));
            }
        }
    }
