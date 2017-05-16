<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tilbud extends MX_Controller {
    private $language = "";
    private $message = "";
	function __construct(){
        parent::__construct();
        $this->session->set_userdata(array('url'=>uri_string()));
        $this->load->model('tilbud_model','tilbud');
        $this->language = $this->lang->lang();
    }
    function index($page=0,$category=0){
        $meta = $this->general_model->getMetaData(3);
        $data['title'] = ($meta->meta_title)?$meta->meta_title:"";
        $data['meta_title'] = ($meta->meta_title)?$meta->meta_title:"";
        $data['meta_keywords'] = ($meta->meta_keywords)?$meta->meta_keywords:"";
        $data['meta_description'] = ($meta->meta_description)?$meta->meta_description:"";
        
        $config['base_url'] = base_url().$this->language.'/tilbud/index/';
        $config['total_rows'] = $this->tilbud->getNum();
        $config['per_page'] = $this->config->item('numberpage');
        $config['num_links'] = 2;
        $config['uri_segment'] = $this->uri->total_segments();
        $this->pagination->initialize($config);
        $data['list'] = $this->tilbud->getData($config['per_page'],(int)$page);
        $data['pagination'] = $this->pagination->create_links();
        /** Clear session search products */
        $SearchPro = array('postfrom' => '', 'postto' => '', 'pricefrom' => '', 'priceto' => '', 'category_id' => '');
        $this->session->unset_userdata($SearchPro);
        
        $user = $this->session->userdata('user');
        $wishlist = array();
        if($data['list']&&$user){
            foreach($data['list'] as $rows){
                $check = $this->tilbud->checkWishlist($user->id,$rows->id);
                if($check){
                    $wishlist[] = array(
                        'id' => $rows->id,
                    );
                }else{
                    $wishlist[] = array(
                        'id' => 0,
                    );
                }
                
            }
        }
        $data['wishlist'] = $wishlist;
        $data['category'] = $this->tilbud->getCategory();
        $data['category_id'] = "";
        $data['postfrom'] = "";
        $data['postto'] = "";
        $data['pricefrom'] = "";
        $data['priceto'] = "";
        
        $data['user'] = $this->session->userdata('user');
		$data['page'] = 'tilbud/index';
		$this->load->view('templates', $data);
	}
    function search($page=0,$category_id=0){
        $meta = $this->general_model->getMetaData(3);
        $data['title'] = ($meta->meta_title)?$meta->meta_title:"";
        $data['meta_title'] = ($meta->meta_title)?$meta->meta_title:"";
        $data['meta_keywords'] = ($meta->meta_keywords)?$meta->meta_keywords:"";
        $data['meta_description'] = ($meta->meta_description)?$meta->meta_description:"";
        if($category_id){
            $this->session->set_userdata('category_id', $category_id);
            $search['category_id'] = $category_id;
        }else{
            $search['category_id'] = $this->session->userdata('category_id');
        }
        if($this->input->post()){
            $postfrom = $this->input->post('postfrom');
            $postto = $this->input->post('postto');
            $pricefrom = $this->input->post('pricefrom');
            $priceto = $this->input->post('priceto');
            if($postfrom){
                $this->session->set_userdata('postfrom', $postfrom);
                $search['postfrom'] = $this->session->userdata('postfrom');
            }else{
                $this->session->unset_userdata('category');
                $search['postfrom'] = "";
            }
            if($postto){
                $this->session->set_userdata('postto', $postto);
                $search['postto'] = $this->session->userdata('postto');
            }else{
                $this->session->unset_userdata('postto');
                $search['postto'] = "";
            }
            if($pricefrom){
                $this->session->set_userdata('pricefrom', $pricefrom);
                $search['pricefrom'] = $this->session->userdata('pricefrom');
            }else{
                $this->session->unset_userdata('pricefrom');
                $search['pricefrom'] = "";
            }
            if($priceto){
                $this->session->set_userdata('priceto', $priceto);
                $search['priceto'] = $this->session->userdata('priceto');
            }else{
                $this->session->unset_userdata('priceto');
                $search['priceto'] = "";
            }
        }else{
            $search['postfrom'] = $this->session->userdata('postfrom');
            $search['postto'] = $this->session->userdata('postto');
            $search['pricefrom'] = $this->session->userdata('pricefrom');
            $search['priceto'] = $this->session->userdata('priceto');
        }
        $data['postfrom'] = $search['postfrom'];
        $data['postto'] = $search['postto'];
        $data['pricefrom'] = $search['pricefrom'];
        $data['priceto'] = $search['priceto'];
        $config['base_url'] = base_url().$this->language.'/tilbud/search/';
        $config['total_rows'] = $this->tilbud->getNum($search);
        $config['per_page'] = $this->config->item('numberpage');
        $config['num_links'] = 2;
        $config['uri_segment'] = $this->uri->total_segments();
        $this->pagination->initialize($config);
        $data['list'] = $this->tilbud->getData($config['per_page'],(int)$page,$search);
        $data['pagination'] = $this->pagination->create_links();
        $user = $this->session->userdata('user');
        $wishlist = array();
        if($data['list']&&$user){
            foreach($data['list'] as $rows){
                $check = $this->tilbud->checkWishlist($user->id,$rows->id);
                if($check){
                    $wishlist[] = array(
                        'id' => $rows->id,
                    );
                }else{
                    $wishlist[] = array(
                        'id' => 0,
                    );
                }
                
            }
        }
        $data['wishlist'] = $wishlist;
        
        $data['category'] = $this->tilbud->getCategory();
        $data['category_id'] = $search['category_id'];
        $data['user'] = $this->session->userdata('user');
		$data['page'] = 'tilbud/index';
		$this->load->view('templates', $data);
	}
    function detail($id){
        $meta = $this->general_model->getMetaData(3);
        $data['title'] = ($meta->meta_title)?$meta->meta_title:"";
        $data['meta_title'] = ($meta->meta_title)?$meta->meta_title:"";
        $data['meta_keywords'] = ($meta->meta_keywords)?$meta->meta_keywords:"";
        $data['meta_description'] = ($meta->meta_description)?$meta->meta_description:"";
        
        $data['item'] = $this->tilbud->getItem($id);
        $data['image'] = $this->tilbud->getImage($id);
        $search['category_id'] = $data['item']->category_id;
        $ignore[] = $id;
        $data['list'] = $this->tilbud->getData(2,0,$search,$ignore);
		$data['page'] = 'tilbud/detail';
		$this->load->view('templates', $data);
    }
    
    function cart(){
        $meta = $this->general_model->getMetaData(3);
        $data['title'] = ($meta->meta_title)?$meta->meta_title:"";
        $data['meta_title'] = ($meta->meta_title)?$meta->meta_title:"";
        $data['meta_keywords'] = ($meta->meta_keywords)?$meta->meta_keywords:"";
        $data['meta_description'] = ($meta->meta_description)?$meta->meta_description:"";
        
        $dataCart = array();
        if($this->cart->total_items()>0){
            foreach ($this->cart->contents() as $row){
                $pro = $this->tilbud->getItem($row['id']);
                $cart['rowid'] = $row['rowid'];
                $cart['id'] = $row['id'];
                $cart['qty'] = $row['qty'];
                $cart['name'] = $pro->name;
                $cart['price'] = $pro->price;
                $cart['image'] = $pro->image;
                $cart['description'] = $pro->description;
                $dataCart[] = (object)$cart;
            }
        }
        else{
            $this->cart->destroy();
        }
        $data['list'] = $dataCart;
        $data['total'] = $this->cart->total();
		$data['page'] = 'tilbud/cart';
		$this->load->view('templates', $data);
    }
    
    function checkout(){
        $meta = $this->general_model->getMetaData(3);
        $data['title'] = ($meta->meta_title)?$meta->meta_title:"";
        $data['meta_title'] = ($meta->meta_title)?$meta->meta_title:"";
        $data['meta_keywords'] = ($meta->meta_keywords)?$meta->meta_keywords:"";
        $data['meta_description'] = ($meta->meta_description)?$meta->meta_description:"";

        $dataCart = array();
        if($this->cart->total_items()>0){
            foreach ($this->cart->contents() as $row){
                $pro = $this->tilbud->getItem($row['id']);
                $cart['rowid'] = $row['rowid'];
                $cart['id'] = $row['id'];
                $cart['qty'] = $row['qty'];
                $cart['name'] = $pro->name;
                $cart['price'] = $pro->price;
                $cart['image'] = $pro->image;
                $cart['description'] = $pro->description;
                $dataCart[] = (object)$cart;
            }
        }
        else{
            $this->cart->destroy();
            redirect(site_url('tilbud/cart'));
        }
        $data['user'] = $this->session->userdata('user');
        $data['list'] = $dataCart;
        $data['total'] = $this->cart->total();
        
		$data['page'] = 'tilbud/checkout';
		$this->load->view('templates', $data);
    }
    
    function success(){
        $meta = $this->general_model->getMetaData(3);
        $data['title'] = ($meta->meta_title)?$meta->meta_title:"";
        $data['meta_title'] = ($meta->meta_title)?$meta->meta_title:"";
        $data['meta_keywords'] = ($meta->meta_keywords)?$meta->meta_keywords:"";
        $data['meta_description'] = ($meta->meta_description)?$meta->meta_description:"";
        
        //Update Order
        $DB['bl_active'] = 1;
        $DB['payment'] = time();
        $this->tilbud->saveOrder($DB, $this->session->userdata('ID'));
        
        //Clear Order
        $this->cart->destroy();
        $this->session->unset_userdata('orderID');
        $this->session->unset_userdata('ID');

		$data['page'] = 'tilbud/success';
		$this->load->view('templates', $data);
    }
    function cancel(){
        $meta = $this->general_model->getMetaData(3);
        $data['title'] = ($meta->meta_title)?$meta->meta_title:"";
        $data['meta_title'] = ($meta->meta_title)?$meta->meta_title:"";
        $data['meta_keywords'] = ($meta->meta_keywords)?$meta->meta_keywords:"";
        $data['meta_description'] = ($meta->meta_description)?$meta->meta_description:"";
        
        $this->cart->destroy();
        $this->session->unset_userdata('orderID');
        $this->session->unset_userdata('ID');
        
		$data['page'] = 'tilbud/cancel';
		$this->load->view('templates', $data);
    }
    function callback(){
        //Check callback and save
        
        
    }
    
    
    /** Action function*/
    function wishlist(){
        $userID = $this->input->post('user');
        $productID = $this->input->post('product');
        if(checkLogin()){
            $user = $this->session->userdata('user');
            if($user->id == $userID){
                $this->tilbud->addWishlist($userID, $productID);
                $data['status'] = true;
            }else{
                $data['status'] = false;
            }
        }
        header('Content-Type: application/json');
		echo json_encode($data);
        return;
    }
    function insert(){
        $dataCart = array(
            'id'      => $this->input->post('id'),
            'qty'     => $this->input->post('qty'),
            'name'    => 'Name',
            'price'   => $this->input->post('price'),
        );
        $add = $this->cart->insert($dataCart);
        if($add){
            $data['status'] = true;
        }else{
            $data['status'] = false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
        return;
    }
    function update($rowid=NULL, $id=NULL, $qty=0){
        $data = array(
            'rowid' => $rowid,
            'qty'   => $qty
        );
        $this->cart->update($data);
        if($id){
            $this->session->unset_userdata($id);
        }
        redirect(site_url('tilbud/cart'));  
    }
    
    /** */
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */