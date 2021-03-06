<?php
class Items extends CI_Controller {
    

    public function __construct()
    {
            parent::__construct();
            $this->load->model('items_model');
    }

    public function index()
    {
            $data['items'] = $this->items_model->get_items();
            $data['title'] = 'News archive';

            $this->load->view('templates/header', $data);
            $this->load->view('items/index', $data);
            $this->load->view('templates/footer');
    }

    public function view($slug = NULL)
    {
        $data['item'] = $this->items_model->get_items($slug);

        if (empty($data['item']))
        {
                show_404();
        }

        $data['title'] = $data['item']['title'];

        $this->load->view('templates/header', $data);
        $this->load->view('items/view', $data);
        $this->load->view('templates/footer');
    }
    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a news item';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'text', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('items/create');
            $this->load->view('templates/footer');

        }
        else
        {
            $this->items_model->set_items();
            $this->load->view('items/success',$data);
        }
    }
    public function test()
    {
        $this->load->helper('url');
        
        var_dump(array("site_url"=>site_url('/items/creafte'),"base_url"=>base_url('/items/create')));
    }
}
?>