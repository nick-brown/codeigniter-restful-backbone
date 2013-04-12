<?php if ( ! defined('BASEPATH')) {exit('No direct script access allowed');
}

class categories extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function category_get()
    {
        if (! $this->get('id'))
        {
            $this->response(NULL, 400);
        }

        $image = $this->api_model->get($this->get('id'));

        if ($image)
        {
            $this->response($image, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Image could not be found'), 404);
        }
    }

    public function categories_get()
    {
        $images = $this->api_model->get_all($this->get('limit'));

        if ($images)
        {
            $this->response($images, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any images!'), 404);
        }
    }

    // Update
    public function category_put()
    {
        $result = $this->api_model->update_image($this->put('id'), [
                                                                   'caption'  => $this->put('caption'),
                                                                   'cutting' => $this->put('cutting'),
                                                                   'sidebar' => $this->put('sidebar'),
                                                                   'engraving' => $this->put('engraving'),
                                                                   'marking' => $this->put('marking'),
                                                                   'imaging' => $this->put('imaging'),
                                                                   ]);
        if ($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }

        else
        {
            $this->response(array('status' => 'success'));
        }
    }

    public function image_post()
    {
        $result = $this->api_model->create_image([
                                                 'name' => $this->input->post('name'),
                                                 'cutting' => $this->input->post('cutting'),
                                                 'sidebar' => $this->input->post('sidebar'),
                                                 'engraving' => $this->input->post('engraving'),
                                                 'marking' => $this->input->post('marking'),
                                                 'imaging' => $this->input->post('imaging'),
                                                 'caption' => $this->post('caption'),
                                                 'material_id' => $this->input->post('material_id')
                                                 ]);

        if ($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }

        else
        {
            $this->response(array('status' => 'success'));
        }
    }

    public function image_delete($id)
    {
        $result = $this->api_model->delete_image($id);

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
