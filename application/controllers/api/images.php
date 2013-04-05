<?php if ( ! defined('BASEPATH')) {exit('No direct script access allowed');
}

class Images extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data = [
            1 => [ 'id' => 1, 'name' => 'img1000.jpg' ],
            2 => [ 'id' => 2, 'name' => 'img1001.jpg' ],
            3 => [ 'id' => 3, 'name' => 'img1002.jpg' ],
        ];
    }

    public function images_get()
    {
        $data = array('returned: '. $this->get('id'));
        $this->response($data);
    }

    public function images_post()
    {
        $data = array('returned: '. $this->post('id'));
        $this->response($data);
    }

    public function images_put()
    {
        $data = array('returned: '. $this->put('id'));
        $this->response($data);
    }

    public function images_delete()
    {
        $data = array('returned: '. $this->delete('id'));
        $this->response($data);
    }
}
