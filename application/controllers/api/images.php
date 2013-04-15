<?php if (! defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

    class Images extends REST_Controller {
        public function __construct()
        {
            parent::__construct();

            $this->load->model('image_model');
        }

        public function image_get()
        {
            if ($this->get('id'))
            {
                $image = $this->image_model->get( $this->get('id') );
            }
            else
            {
                $image = $this->image_model->get( NULL, $this->get('limit') );
            }

            if ($image)
            {
                $this->response($image, 200); // 200 being the HTTP response code
            }
            else
            {
                $this->response(array('error' => 'Couldn\'t find any images!'), 404);
            }
        }


        // Update
        public function image_put()
        {
            $values = [
                'caption'   => $this->put('caption'),
                'cutting'   => $this->put('cutting'),
                'sidebar'   => $this->put('sidebar'),
                'engraving' => $this->put('engraving'),
                'marking'   => $this->put('marking'),
                'imaging'   => $this->put('imaging'),
            ];

            $result = $this->image_model->update( $values, $this->put('id') );

            if ($result)
            {
                $this->response(array('status' => 'success'));
            }
            else
            {
                $this->response(array('status' => 'failed'));
            }
        }

        public function image_post()
        {
            $values = [
                'name' => $this->input->post('name'),
                'cutting' => $this->input->post('cutting'),
                'sidebar' => $this->input->post('sidebar'),
                'engraving' => $this->input->post('engraving'),
                'marking' => $this->input->post('marking'),
                'imaging' => $this->input->post('imaging'),
                'caption' => $this->post('caption'),
                'material_id' => $this->input->post('material_id')
            ];

            $result = $this->image_model->update($values);

            if ($result)
            {
                $this->response(array('status' => 'success'));
            }
            else
            {
                $this->response(array('status' => 'failed'));
            }
        }

        public function image_delete()
        {
            $id = $this->uri->segment(4);

            $result = $this->image_model->delete( $id );

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
