<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends MX_Controller {
	private $language = "";
    private $message = "";
    function __construct(){
        parent::__construct();
        $this->session->set_userdata(array('url'=>uri_string()));
        $this->load->model('user_model', 'user');
        $this->load->library('user_agent');
        $this->language = $this->lang->lang();
    }

    /**
     * @param $meta
     * @param $data
     */
    public function addMeta($meta, &$data){
        $data['title'] = ($meta->meta_title)?$meta->meta_title:"";
        $data['meta_title'] = ($meta->meta_title)?$meta->meta_title:"";
        $data['meta_keywords'] = ($meta->meta_keywords)?$meta->meta_keywords:"";
        $data['meta_description'] = ($meta->meta_description)?$meta->meta_description:"";
    }

    function index(){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);
        if(!checkLogin()){
            redirect(site_url('home/index'));
        }
        /** Clear session search USER */
        $SearchUser = array('year_from' => '', 'year_to' => '', 'height_from' => '', 'height_to' => ''
                            , 'gender' => '', 'relationship' => '', 'children' => '', 'ethnic_origin' => ''
                            , 'religion' => '', 'training' => '', 'body' => '');
        $this->session->unset_userdata($SearchUser);
        
        $data['user'] = $this->session->userdata('user');
        $data['item'] = $this->user->getUser($data['user']->id);
        $data['tilbud'] = $this->user->getMyTilbud($data['user']->id);
		$data['page'] = 'user/index';
		$this->load->view('templates', $data);
	}

    function profile($id){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);
        if(!checkLogin()){
            redirect(site_url('home/index'));
        }
        $data['user'] = $this->session->userdata('user');
        $data['item'] = $this->user->getUser($id);
        $photo = $this->user->getPhoto($id);
        if($photo){
            $data['avatar'] = $photo[0]->image;
        }else{
            $data['avatar'] = "";
        }
        actionUser($data['user']->id,$id,'View',1);
        $data['favorite'] = $this->user->checkFavorite($data['user']->id,$id);
        
		$data['page'] = 'user/profile';
		$this->load->view('templates', $data);
    }
    
    function b2b(){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);
        if(!checkLogin()){
            redirect(site_url('home/index'));
        }
        $data['user'] = $this->session->userdata('user');
		$data['page'] = 'user/b2b';
		$this->load->view('templates', $data);
    }
    /** Photo*/
    function myphoto(){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);
        if(!checkLogin()){
            redirect(site_url('home/index'));
        }
        $data['user'] = $this->session->userdata('user');
        $data['list'] = $this->user->getPhoto($data['user']->id);
		$data['page'] = 'user/myphoto';
		$this->load->view('templates', $data);
    }
    function uploadPhoto(){
        $user = $this->session->userdata('user');
        $config['upload_path'] = $this->config->item('root')."uploads/photo/";
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= $this->config->item('maxupload');
		$config['encrypt_name']	= TRUE;  //rename to random string image
        $this->load->library('upload', $config);
        if(isset($_FILES['myImage']['name'])){
            $data_img = $this->upload->do_multi_upload('myImage');
			if ($data_img){	
				$data_img = $data_img;
			}else {
				$data_img[] = NULL;
			}
		}else {
			$data_img[] = NULL;
		}
        //Save image to DB
        $list = array();
        $DB['userID'] = $user->id;
        $DB['dt_create'] = date('Y-m-d H:i:s');
        $DB['bl_active'] = 1;
        if($data_img){
            $i=0;
            foreach($data_img as $row){
                $DB['image'] = $row['file_name'];
                $id = $this->user->savePhoto($DB);
                $list[$i]['image'] = $row['file_name'];
                $list[$i]['id'] = $id;
                $i++;
            }
        }
        $data['list'] = $list;
        $this->load->view('ajax/myphoto', $data);
        /**
        $images_arr = array();
    	foreach($_FILES['myImage']['name'] as $key=>$val){
    		$image_name = $_FILES['myImage']['name'][$key];
    		$tmp_name 	= $_FILES['myImage']['tmp_name'][$key];
    		$size 		= $_FILES['myImage']['size'][$key];
    		$type 		= $_FILES['myImage']['type'][$key];
    		$error 		= $_FILES['myImage']['error'][$key];
    		//display images without stored
    		$extra_info = getimagesize($_FILES['myImage']['tmp_name'][$key]);
        	$images_arr[] = "data:" . $extra_info["mime"] . ";base64," . base64_encode(file_get_contents($_FILES['myImage']['tmp_name'][$key]));
    	}
        if($images_arr){
            $i = 0;
    		foreach($images_arr as $image_src){ ?>
                <li id="show_images_<?php echo $i;?>" class="portfolio isotope-item">
                    <div style="width: 150px !important; height: 150px !important; overflow: hidden;">
                        <a class="portfolio_img" href="javascript:void(0)">
                            <img src="<?php echo $image_src;?>" width="100%" height="100%" alt="" class="img-responsive"/>                                        
                        </a>
                    </div>
                    <a href="javascript:void(0)" onclick="deleteImages('show_images_<?php echo $i;?>');"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                </li>
    	<?php $i++; }}
        */
    }
    
    function mydeal(){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);
        if(!checkLogin()){
            redirect(site_url('home/index'));
        }
        $data['user'] = $this->session->userdata('user');
        $data['tilbud'] = $this->user->getMyTilbud($data['user']->id);
		$data['page'] = 'user/mydeal';
		$this->load->view('templates', $data);
    }
    /** Message*/
    function mymessages(){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);
        if(!checkLogin()){
            redirect(site_url('home/index'));
        }
        $data['user'] = $this->session->userdata('user');
        $message = $this->user->getListMessage($data['user']->id);
        $list = "";
        if($message){
            $i = 0;
            foreach($message as $row){
                $userSend = $this->user->getUser($row->user_from);
                if($userSend){
                    $list[$i] = $userSend;
                    $list[$i]->notSeen = $this->user->getNotSeen($data['user']->id,$row->user_from);
                    $latestMessage = $this->user->getLatestMessage($data['user']->id,$row->user_from);
                    $list[$i]->message = $latestMessage->message;
                    $list[$i]->dt_create = $latestMessage->dt_create;
                    $i++;
                }
            }
        }
        $data['list'] = $list;
		$data['page'] = 'user/mymessages';
		$this->load->view('templates', $data);
    }
    function messages($id){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);
        if(!checkLogin()){
            redirect(site_url('home/index'));
        }
        $data['user'] = $this->session->userdata('user');
        $data['item'] = $this->user->getUser($id);
        $data['messages'] = $this->user->getMessages($data['user']->id,$id);
        $this->user->clearNotSeen($data['user']->id,$id);
		$data['page'] = 'user/messages';
		$this->load->view('templates', $data);
    }
    function sendMessage(){
        $user = $this->session->userdata('user');
        if($user){
            $DB['user_from'] = $user->id;
            $DB['user_to'] = $this->input->post('user_to');
            $DB['message'] = $this->input->post('message');
            $DB['seen'] = 1;
            $DB['dt_create'] = date('Y-m-d H:i:s');
            $DB['bl_active'] = 1;
            $this->user->saveMessage($DB);
            $item = $this->user->getUser($user->id);
            actionUser($user->id,$DB['user_to'],'Message',3);
            $html = '<div class="row">
                         <div class="col-sm-3">
                            <h5>'.$item->name.'</h5>
                            <p>'.getTimeDifference(strtotime($DB['dt_create'])).'</p>
                        </div>
                        <div class="col-sm-9">
                            <p>'.$DB['message'].'</p>
                        </div>
                    </div>';
            echo $html;
            return;
        }
        echo "";
        return;
    }
    function deleteMessage($userID){
        if(!checkLogin()){
            redirect(site_url('home/index'));
        }
        $user = $this->session->userdata('user');
        $this->user->deleteMessage_FT($user->id,$userID);
        $this->user->deleteMessage_TF($user->id,$userID);
        redirect(site_url('user/mymessages'));
    }
    /** Invitation*/
    function myinvitationer(){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);
        if(!checkLogin()){
            redirect(site_url('home/index'));
        }
        $data['user'] = $this->session->userdata('user');
        $dating = $this->user->getDating($data['user']->id);
        $list = "";
        if($dating){
            $i=0;
            foreach($dating as $row){
                $images = $this->user->getImageDating($row->id);
                $user = $this->user->getUserDating($row->id);
                $userApproved = $this->user->getUserApproved($row->id);
                if($row->order_item){
                    $pro = $this->user->getDatingOrderItem($row->order_item);
                    if($pro){
                        $list[$i]['proID'] = $pro->product_id;
                        $list[$i]['proName'] = $pro->name;
                        $list[$i]['title'] = $pro->name;
                        $list[$i]['description'] = $pro->description;
                        $list[$i]['company'] = $pro->company;
                        $list[$i]['image'] = $pro->image;
                        $list[$i]['listimage'] = NULL;
                    }else{
                        $list[$i]['proID'] = "";
                        $list[$i]['proName'] = "";
                        $list[$i]['title'] = $row->title;
                        $list[$i]['description'] = $row->content;
                        $list[$i]['company'] = "";
                        $list[$i]['image'] = "";
                        $list[$i]['listimage'] = NULL;
                    }
                }else{
                    $list[$i]['proID'] = "";
                    $list[$i]['proName'] = "";
                    $list[$i]['title'] = $row->title;
                    $list[$i]['description'] = $row->content;
                    $list[$i]['company'] = "";
                    if($images){
                        $list[$i]['image'] = $images[0]->image;
                        $list[$i]['listimage'] = $images;
                    }else{
                        $list[$i]['image'] = NULL;
                        $list[$i]['listimage'] = NULL;
                    }
                }
                $list[$i]['id'] = $row->id;
                $list[$i]['name'] = $row->name;
                if($row->type == 1 || $row->type == 3){
                    $list[$i]['time'] = @number_format($row->times/count($user), 1, '.', '');
                }else{
                    $list[$i]['time'] = $row->times;
                }
                $list[$i]['time'] = $row->times;
                $timeEnd = $row->times_end;
                if($timeEnd > time()){
                    //Show munber user left
                    $list[$i]['user'] = 'De resterende '.count($user).' personer';
                }else{
                    //Show number user have accepted
                    $list[$i]['user'] = 'Har '.count($userApproved).' personer deltage';
                }
                $i++;
            }
        }
        $data['list'] = $list;
		$data['page'] = 'user/myinvitationer';
        //Clear session when created invitation
        $this->session->unset_userdata('invita');
        $this->session->unset_userdata('listUser');
		$this->load->view('templates', $data);
    }
    function deleteinvitationer($id){
        if(!checkLogin()){
            redirect(site_url('home/index'));
        }
        //Delete dating - user - image
        $ok = $this->user->deleteDating($id);
        if($ok){
            $this->user->deleteUser($id);
            $this->user->deleteImage($id);
        }
        redirect(site_url('user/myinvitationer'));
    }
    
    function myinvitationerjoin(){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);
        if(!checkLogin()){
            redirect(site_url('home/index'));
        }
        $data['user'] = $this->session->userdata('user');
        $dating = $this->user->getDatingByUser($data['user']->id);
        $list = "";
        if($dating){
            $i=0;
            foreach($dating as $row){
                $images = $this->user->getImageDating($row->id);
                $user = $this->user->getUserDating($row->id);
                if($row->order_item){
                    $pro = $this->user->getDatingOrderItem($row->order_item);
                    if($pro){
                        $list[$i]['proID'] = $pro->product_id;
                        $list[$i]['proName'] = $pro->name;
                        $list[$i]['title'] = $pro->name;
                        $list[$i]['description'] = $pro->description;
                        $list[$i]['company'] = $pro->company;
                        $list[$i]['image'] = $pro->image;
                        $list[$i]['listimage'] = NULL;
                    }else{
                        $list[$i]['proID'] = "";
                        $list[$i]['proName'] = "";
                        $list[$i]['title'] = $row->title;
                        $list[$i]['description'] = $row->content;
                        $list[$i]['company'] = "";
                        $list[$i]['image'] = "";
                        $list[$i]['listimage'] = NULL;
                    }
                }else{
                    $list[$i]['proID'] = "";
                    $list[$i]['proName'] = "";
                    $list[$i]['title'] = $row->title;
                    $list[$i]['description'] = $row->content;
                    $list[$i]['company'] = "";
                    if($images){
                        $list[$i]['image'] = $images[0]->image;
                        $list[$i]['listimage'] = $images;
                    }else{
                        $list[$i]['image'] = NULL;
                        $list[$i]['listimage'] = NULL;
                    }
                }
                $list[$i]['id'] = $row->id;
                $list[$i]['name'] = $row->name;
                $list[$i]['nameUser'] = $row->nameUser;
                $list[$i]['facebook'] = $row->facebook;
                if($row->facebook && $row->avatar){
                    $list[$i]['avatar'] = $row->avatar;
                }else{
                    $photo = $this->user->getPhoto($row->userID);
                    if($photo){
                        $list[$i]['avatar'] = $photo[0]->image;
                    }else{
                        $list[$i]['avatar'] = "";
                    }
                }
                $list[$i]['datinguserID'] = $row->datinguserID;
                $list[$i]['accept'] = $row->accept;
                if($row->type == 1 || $row->type == 3){
                    $list[$i]['time'] = number_format($row->times/count($user), 1, '.', '');
                }else{
                    $list[$i]['time'] = $row->times;
                }
                $list[$i]['time'] = $row->times;
                $i++;
            }
        }
        $data['list'] = $list;
		$data['page'] = 'user/myinvitationerjoin';
		$this->load->view('templates', $data);
    }
    function deletemyinvitationerjoin($id){
        if(!checkLogin()){
            redirect(site_url('home/index'));
        }
        //Delete dating of user
        $this->user->deleteDatingUser($id);
        redirect(site_url('user/myinvitationerjoin'));
    }
    
    function myinvitationerapproved(){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);
        if(!checkLogin()){
            redirect(site_url('home/index'));
        }
        $data['user'] = $this->session->userdata('user');
        $dating = $this->user->getDatingApproved($data['user']->id);
        $list = "";
        if($dating){
            $i=0;
            foreach($dating as $row){
                $images = $this->user->getImageDating($row->id);
                $userApproved = $this->user->getUserApproved($row->id);
                if($row->order_item){
                    $pro = $this->user->getDatingOrderItem($row->order_item);
                    if($pro){
                        $list[$i]['proID'] = $pro->product_id;
                        $list[$i]['proName'] = $pro->name;
                        $list[$i]['title'] = $pro->name;
                        $list[$i]['description'] = $pro->description;
                        $list[$i]['company'] = $pro->company;
                        $list[$i]['image'] = $pro->image;
                        $list[$i]['listimage'] = NULL;
                    }else{
                        $list[$i]['proID'] = "";
                        $list[$i]['proName'] = "";
                        $list[$i]['title'] = $row->title;
                        $list[$i]['description'] = $row->content;
                        $list[$i]['company'] = "";
                        $list[$i]['image'] = "";
                        $list[$i]['listimage'] = NULL;
                    }
                }else{
                    $list[$i]['proID'] = "";
                    $list[$i]['proName'] = "";
                    $list[$i]['title'] = $row->title;
                    $list[$i]['description'] = $row->content;
                    $list[$i]['company'] = "";
                    if($images){
                        $list[$i]['image'] = $images[0]->image;
                        $list[$i]['listimage'] = $images;
                    }else{
                        $list[$i]['image'] = NULL;
                        $list[$i]['listimage'] = NULL;
                    }
                }
                $list[$i]['id'] = $row->id;
                $list[$i]['name'] = $row->name;
                if($userApproved){
                    $j=0;
                    foreach($userApproved as $rs){
                        $users[$j]['nameUser'] = $rs->nameUser;
                        $users[$j]['facebook'] = $rs->facebook;
                        if($rs->facebook && $rs->avatar){
                            $users[$j]['avatar'] = $rs->avatar;
                        }else{
                            $photo = $this->user->getPhoto($rs->user);
                            if($photo){
                                $users[$j]['avatar'] = $photo[0]->image;
                            }else{
                                $users[$j]['avatar'] = "";
                            }
                        }
                        $j++;
                    }
                }else{
                    $users = "";
                }
                $list[$i]['listUser'] = $users;
                $i++;
            }
        }
        $data['list'] = $list;
		$data['page'] = 'user/myinvitationerapproved';
		$this->load->view('templates', $data);
    }
    
    function favorit($page=0){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);
        if(!checkLogin()){
            redirect(site_url('home/index'));
        }
        /** Clear session search USER */
        $SearchUser = array('year_from' => '', 'year_to' => '', 'height_from' => '', 'height_to' => ''
                            , 'gender' => '', 'relationship' => '', 'children' => '', 'ethnic_origin' => ''
                            , 'religion' => '', 'training' => '', 'body' => '');
        $this->session->unset_userdata($SearchUser);
        
        $data['user'] = $this->session->userdata('user');
        $config['base_url'] = base_url().$this->language.'/user/favorit/';
        $config['total_rows'] = $this->user->getNumFavorite($data['user']->id);
        $config['per_page'] = $this->config->item('numberpage');
        $config['num_links'] = 2;
        $config['uri_segment'] = $this->uri->total_segments();
        $this->pagination->initialize($config);
        $listUsers = $this->user->getFavorite($config['per_page'],(int)$page,$data['user']->id);
        $data['pagination'] = $this->pagination->create_links();
        if($listUsers){
            $i=0;
            foreach($listUsers as $row){
                $users[$i]['id'] = $row->id;
                $users[$i]['name'] = $row->name;
                $users[$i]['birthday'] = $row->birthday;
                $users[$i]['code'] = $row->code;
                $users[$i]['facebook'] = $row->facebook;
                if($row->facebook && $row->avatar){
                    $users[$i]['avatar'] = $row->avatar;
                }else{
                    $photo = $this->user->getPhoto($row->id);
                    if($photo){
                        $users[$i]['avatar'] = $photo[0]->image;
                    }else{
                        $users[$i]['avatar'] = "";
                    }
                }
                $i++;
            }
        }else{
            $users = "";
        }
        $data['list'] = $users;
        
		$data['page'] = 'user/favorit';
		$this->load->view('templates', $data);
    }
    
    function positiv($page=0){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);
        if(!checkLogin()){
            redirect(site_url('home/index'));
        }
        /** Clear session search USER */
        $SearchUser = array('year_from' => '', 'year_to' => '', 'height_from' => '', 'height_to' => ''
                            , 'gender' => '', 'relationship' => '', 'children' => '', 'ethnic_origin' => ''
                            , 'religion' => '', 'training' => '', 'body' => '');
        $this->session->unset_userdata($SearchUser);
        
        $data['user'] = $this->session->userdata('user');
        
        $config['base_url'] = base_url().$this->language.'/user/positiv/';
        $config['total_rows'] = $this->user->getNumPositiv($data['user']->id);
        $config['per_page'] = $this->config->item('numberpage');
        $config['num_links'] = 2;
        $config['uri_segment'] = $this->uri->total_segments();
        $this->pagination->initialize($config);
        $listUsers = $this->user->getPositiv($config['per_page'],(int)$page,$data['user']->id);
        $data['pagination'] = $this->pagination->create_links();
        if($listUsers){
            $i=0;
            foreach($listUsers as $row){
                $users[$i]['id'] = $row->id;
                $users[$i]['name'] = $row->name;
                $users[$i]['birthday'] = $row->birthday;
                $users[$i]['code'] = $row->code;
                $users[$i]['facebook'] = $row->facebook;
                if($row->facebook && $row->avatar){
                    $users[$i]['avatar'] = $row->avatar;
                }else{
                    $photo = $this->user->getPhoto($row->id);
                    if($photo){
                        $users[$i]['avatar'] = $photo[0]->image;
                    }else{
                        $users[$i]['avatar'] = "";
                    }
                }
                $i++;
            }
        }else{
            $users = "";
        }
        $data['list'] = $users;
        $favorite = array();
        if($data['list']&&$data['user']){
            foreach($data['list'] as $row){
                $check = $this->user->checkFavorite($data['user']->id,$row['id']);
                if($check){
                    $favorite[] = array(
                        'id' => $row['id'],
                    );
                }else{
                    $favorite[] = array(
                        'id' => 0,
                    );
                }
                
            }
        }
        $data['favorite'] = $favorite;
        
		$data['page'] = 'user/positiv';
		$this->load->view('templates', $data);
    }
    
    function browsing($page=0,$invita=NULL){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);
        if($invita){
            $this->session->set_userdata('invita',$invita);
        }
        $user = $this->session->userdata('user');
        if($user){
            $ignore[] = $user->id;
        }else{
            $ignore = "";
        }
        /** Search browsing*/
        if($this->input->post()){
            $year = date('Y', time());
            $year_from = $year - $this->input->post('year_to');
            $year_to = $year - $this->input->post('year_from');
            $height_from = $this->input->post('height_from');
            $height_to = $this->input->post('height_to');
            $gender = $this->input->post('gender');
            //Array
            $relationship = $this->input->post('relationship');
            $children = $this->input->post('children');
            $ethnic_origin = $this->input->post('ethnic_origin');
            $religion = $this->input->post('religion');
            $training = $this->input->post('training');
            $body = $this->input->post('body');
            $smoking = $this->input->post('smoking');
            if($year_from){
                $search_1 = array('year_from' => $year_from);
            }else{
                $search_1 = array();
            }
            if($year_to){
                $search_2 = array('year_to' => $year_to);
            }else{
                $search_2 = array();
            }
            if($height_from){
                $search_3 = array('height_from' => $height_from);
            }else{
                $search_3 = array();
            }
            if($height_to){
                $search_4 = array('height_to' => $height_to);
            }else{
                $search_4 = array();
            }
            if($gender){
                $search_5 = array('gender' => $gender);
            }else{
                $search_5 = array();
            }
            if($relationship){
                $search_6 = array('relationship' => $relationship);
            }else{
                $search_6 = array();
            }
            if($children){
                $search_7 = array('children' => $children);
            }else{
                $search_7 = array();
            }
            if($ethnic_origin){
                $search_8 = array('ethnic_origin' => $ethnic_origin);
            }else{
                $search_8 = array();
            }
            if($religion){
                $search_9 = array('religion' => $religion);
            }else{
                $search_9 = array();
            }
            if($training){
                $search_10 = array('training' => $training);
            }else{
                $search_10 = array();
            }
            if($body){
                $search_11 = array('body' => $body);
            }else{
                $search_11 = array();
            }
            if($smoking){
                $search_12 = array('smoking' => $smoking);
            }else{
                $search_12 = array();
            }
            
            $search = array_merge($search_1,$search_2,$search_3,$search_4,$search_5,$search_6,$search_7,$search_8,$search_9,$search_10,$search_11,$search_12);
            $this->session->set_userdata($search); 
        }else{
            $search['year_from'] = $this->session->userdata('year_from');
            $search['year_to'] = $this->session->userdata('year_to');
            $search['height_from'] = $this->session->userdata('height_from');
            $search['height_to'] = $this->session->userdata('height_to');
            $search['gender'] = $this->session->userdata('gender');
            $search['relationship'] = $this->session->userdata('relationship');
            $search['children'] = $this->session->userdata('children');
            $search['ethnic_origin'] = $this->session->userdata('ethnic_origin');
            $search['religion'] = $this->session->userdata('religion');
            $search['training'] = $this->session->userdata('training');
            $search['body'] = $this->session->userdata('body');
            $search['smoking'] = $this->session->userdata('smoking');
        }
        if(isset($search['year_from'])){
            $data['year_from'] = date('Y',time())-$search['year_to'];
        }else{
            $data['year_from'] = "";
        }
        if(isset($search['year_to'])){
            $data['year_to'] = date('Y',time())-$search['year_from'];
        }else{
            $data['year_to'] = "";
        }
        if(isset($search['height_from'])){
            $data['height_from'] = $search['height_from'];
        }else{
            $data['height_from'] = "";
        }
        if(isset($search['height_to'])){
            $data['height_to'] = $search['height_to'];
        }else{
            $data['height_to'] = "";
        }
        if(isset($search['gender'])){
            $data['gender'] = $search['gender'];
        }else{
            $data['gender'] = "";
        }
        if(isset($search['relationship'])){
            $data['relationship'] = $search['relationship'];
        }else{
            $data['relationship'] = "";
        }
        if(isset($search['children'])){
            $data['children'] = $search['children'];
        }else{
            $data['children'] = "";
        }
        if(isset($search['ethnic_origin'])){
            $data['ethnic_origin'] = $search['ethnic_origin'];
        }else{
            $data['ethnic_origin'] = "";
        }
        if(isset($search['religion'])){
            $data['religion'] = $search['religion'];
        }else{
            $data['religion'] = "";
        }
        if(isset($search['training'])){
            $data['training'] = $search['training'];
        }else{
            $data['training'] = "";
        }
        if(isset($search['body'])){
            $data['body'] = $search['body'];
        }else{
            $data['body'] = "";
        }
        if(isset($search['smoking'])){
            $data['smoking'] = $search['smoking'];
        }else{
            $data['smoking'] = "";
        }

        $config['base_url'] = base_url().$this->language.'/user/browsing/';
        $config['total_rows'] = $this->user->getNum($search,$ignore);
        $config['per_page'] = $this->config->item('numberpage');
        $config['num_links'] = 2;
        $config['uri_segment'] = $this->uri->total_segments();
        $this->pagination->initialize($config);
        $listUsers = $this->user->getBrowsing($config['per_page'],(int)$page,$search,$ignore);
        $data['pagination'] = $this->pagination->create_links();
        if($listUsers){
            $i=0;
            foreach($listUsers as $row){
                $users[$i]['id'] = $row->id;
                $users[$i]['name'] = $row->name;
                $users[$i]['birthday'] = $row->birthday;
                $users[$i]['code'] = $row->code;
                $users[$i]['facebook'] = $row->facebook;
                if($row->facebook && $row->avatar){
                    $users[$i]['avatar'] = $row->avatar;
                }else{
                    $photo = $this->user->getPhoto($row->id);
                    if($photo){
                        $users[$i]['avatar'] = $photo[0]->image;
                    }else{
                        $users[$i]['avatar'] = "";
                    }
                }
                $i++;
            }
        }else{
            $users = "";
        }
        $data['list'] = $users;
        $favorite = array();
        if($data['list']&&$user){
            foreach($data['list'] as $row){
                $check = $this->user->checkFavorite($user->id,$row['id']);
                if($check){
                    $favorite[] = array(
                        'id' => $row['id'],
                    );
                }else{
                    $favorite[] = array(
                        'id' => 0,
                    );
                }
                
            }
        }
        $data['favorite'] = $favorite;
        $data['invita'] = $this->session->userdata('invita');
        $data['user'] = $user;
        $data['num'] = $config['total_rows'];
		$data['page'] = 'user/browsing';
		$this->load->view('templates', $data);
    }
    
    /** User*/
    function register(){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);
        if($this->input->post()){
            $user = $this->user->getUser(NULL,$this->input->post('email'),NULL,NULL,NULL,1);
            if($user){
                $data['status'] = false;
                $data['message'] = 'E-mail er allerede registeret!';
                header('Content-Type: application/json');
        		echo json_encode($data);
                return;
            }
            $DB['name'] = $this->input->post('name');
            $DB['email'] = $this->input->post('email');
            $DB['password'] = md5($this->input->post('password'));
            $DB['code'] = $this->input->post('code');
            $DB['payment'] = $this->input->post('payment');
            $DB['day'] = $this->input->post('day');
            $DB['month'] = $this->input->post('month');
            $DB['year'] = $this->input->post('year');
            $DB['birthday'] = $this->input->post('day').'/'.$this->input->post('month').'/'.$this->input->post('year');
            $DB['type'] = 1;
            $DB['groups'] = 1; //1: register - 2: facebook - 3: google
            $DB['os'] = $this->agent->platform();
            $DB['ip'] = $this->input->ip_address();
            $mobile = $this->agent->mobile();
            if($mobile){
                $DB['device'] = 'Mobile';
            }else{
                $DB['device'] = 'Desktop';
            }
            $DB['dt_create'] = date('Y-m-d H:i:s');
            $DB['bl_active'] = 1;
            $this->session->set_userdata('email',$DB['email']);
            $this->session->set_userdata('password',$DB['password']);
            $id = $this->user->saveUser($DB);
            $this->session->set_userdata('userid',$id);
            if($DB['payment']==1 && $id){
                $this->session->set_userdata('payment',true);
                $data['status'] = true;
                $data['payment'] = true;
                $data['message'] = '';
                header('Content-Type: application/json');
        		echo json_encode($data);
                return;
            }
            if($id){
                $data['status'] = true;
                $data['message'] = '';
            }else{
                $data['status'] = false;
                $data['message'] = 'Fejl-system, skal du handling igen!';
            }
            $data['payment'] = false;
            header('Content-Type: application/json');
    		echo json_encode($data);
            return;
        }
		$data['page'] = 'user/register';
		$this->load->view('templates', $data);
    }
    /** PAYMENT*/
    function success(){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);
        
        $payment = $this->session->userdata('payment');
        $userid = $this->session->userdata('userid');
        if($payment){
            //Update payment
            $DB['type'] = 2;
            $DB['bl_active'] = 1;
            $DB['paymenttime'] = time();
        }else{
            $DB['bl_active'] = 1;
        }
        $this->user->saveUser($DB,$userid);
        $this->session->unset_userdata('userid');
        $this->session->unset_userdata('payment');
        $data['page'] = 'user/success';
		$this->load->view('templates', $data);
    }
    function cancel(){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);
        
        $this->session->unset_userdata('userid');
        $this->session->unset_userdata('payment');
        
		$data['page'] = 'user/cancel';
		$this->load->view('templates', $data);
    }
    function callback(){
        //Check callback and save
        
        
    }
    /** END PAYMENT*/
    function update(){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);
        if(!checkLogin()){
            redirect(site_url('home/index'));
        }
        $user = $this->session->userdata['user'];
        if($this->input->post()){
            $DB['name'] = $this->input->post('name');
            $DB['day'] = $this->input->post('day');
            $DB['month'] = $this->input->post('month');
            $DB['year'] = $this->input->post('year');
            $DB['birthday'] = $this->input->post('day').'/'.$this->input->post('month').'/'.$this->input->post('year');
            $DB['code'] = $this->input->post('code');
            $DB['gender'] = $this->input->post('gender');
            $DB['height'] = $this->input->post('height');
            $DB['relationship'] = $this->input->post('relationship');
            $DB['children'] = $this->input->post('children');
            $DB['ethnic_origin'] = $this->input->post('ethnic_origin');
            $DB['religion'] = $this->input->post('religion');
            $DB['training'] = $this->input->post('training');
            $DB['body'] = $this->input->post('body');
            $DB['smoking'] = $this->input->post('smoking');
            $DB['slogan'] = $this->input->post('slogan');
            $DB['description'] = $this->input->post('description');
            if($this->input->post('password')&&$this->input->post('repassword')){
                if($this->input->post('password')!=$this->input->post('repassword')){
                    $this->session->set_flashdata('message',"Password incorrect");
                    redirect(site_url('user/update'));
                }else{
                    $DB['password'] = md5($this->input->post('password'));
                }
            }
            $id = $this->user->saveUser($DB,$user->id);
            if($id){
                $this->session->set_flashdata('message',"Update sucessful");
                redirect(site_url('user/index'));
            }else{
                $this->session->set_flashdata('message',"Update error!");
                redirect(site_url('user/update'));
            }
        }
        $data['user'] = $user;
        $data['item'] = $this->user->getUser($user->id);
		$data['page'] = 'user/update';
		$this->load->view('templates', $data);
    }
    function upgrade(){
        
        
        
    }
    function forgotpass(){
        $meta = $this->general_model->getMetaData(2);
        $data = array();
        $this->addMeta($meta, $data);

        
		$data['page'] = 'user/forgotpass';
		$this->load->view('templates', $data);
    }
    
    function login(){
        $email = $this->input->post('email',true);
        $password = md5($this->input->post('password',true));
        //Login b2b
        $b2b = $this->user->getB2b('',$email,$password);
        if($b2b){
            $b2b->b2b = true;
            $this->session->set_userdata('isLoginSite',true);
            $this->session->set_userdata('user',$b2b);
            $this->user->updateLogin($b2b->id,true);
            $data['status'] = true;
            $data['b2b'] = true;
            header('Content-Type: application/json');
    		echo json_encode($data);
            return;
        }
        //Login user
        $user = $this->user->getUser('',$email,$password);
        if($user){
            $data['status'] = true;
            $user->b2b = false;
            $this->session->set_userdata('isLoginSite',true);
            $this->session->set_userdata('user',$user);
            $this->user->updateLogin($user->id,false);
        }else{
            $data['status'] = false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
        return;
    }
    function autoLogin(){
        $email = $this->session->userdata('email');
	    $password = $this->session->userdata('password');
        if($email && $password){
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('password');
            $b2b = $this->user->getB2b('',$email,$password);
            if($b2b){
                $b2b->b2b = true;
                $this->session->set_userdata('isLoginSite',true);
                $this->session->set_userdata('user',$b2b);
                $this->user->updateLogin($b2b->id,true);
                redirect(site_url('user/b2b'));
                return;
            }
            //Login user
            $user = $this->user->getUser('',$email,$password);
            if($user){
                $data['status'] = true;
                $user->b2b = false;
                $this->session->set_userdata('isLoginSite',true);
                $this->session->set_userdata('user',$user);
                $this->user->updateLogin($user->id,false);
                redirect(site_url('user/index'));
                return;
            }else{
                redirect(site_url('home/index'));
                return;
            }
        }else{
            redirect(site_url('home/index'));
            return;
        }
    }
    function loginFB(){
        $post = $this->input->post('response',true);
		if($post){
            $DB['name']        = $post['name'];
            $DB['email']       = $post['email'];
            $DB['facebook']    = $post['id'];
            $DB['os'] = $this->agent->platform();
            $DB['ip'] = $this->input->ip_address();
            $mobile = $this->agent->mobile();
            if($mobile){
                $DB['device'] = 'Mobile';
            }else{
                $DB['device'] = 'Desktop';
            }
            if($post['gender'] == 'male'){
                $DB['gender'] = 2;
            }else if($post['gender'] == 'female'){
                $DB['gender'] = 1;
            }else{
                $DB['gender'] = 0;
            }
            $DB['avatar']      = 'https://graph.facebook.com/'.$post['id'].'/picture?type=large';
			$DB['login'] = date('Y-m-d H:i:s');
			$DB['bl_active'] = 1;
            $check = $this->user->getUser('',$DB['email'],'',$DB['facebook']);
            if($check){
				$id = $check->id;
				$id = $this->user->saveUser($DB,$id);
                $user = $this->user->getUser($id);
                $user->b2b = false;
                $this->session->set_userdata('user', $user);
            }else{
                $DB['dt_create'] = date('Y-m-d H:i:s');
                $DB['type'] = 1;
                $DB['groups'] = 2; //1: register - 2: facebook - 3: google
				$id = $this->user->saveUser($DB);
				$user = $this->user->getUser($id);
                $user->b2b = false;
                $this->session->set_userdata('user', $user);
			}
            $this->session->set_userdata('isLoginSite', true);
            $data['status'] = true;
        }else{
            $data['status'] = false;
        }    
		header('Content-Type: application/json');
		echo json_encode($data);
        return;
    }
    
    function logout(){
        /** Login*/
        $Login = array('isLoginSite' => '', 'user' => '', 'email' => '', 'password' => '');
        $this->session->unset_userdata($Login);
        /** UserID to payment gold member*/
        $this->session->unset_userdata('userid');
        $this->session->unset_userdata('payment');
        /** Order*/
        $this->cart->destroy();
        $this->session->unset_userdata('orderID');
        $this->session->unset_userdata('ID');
        /** Invitation*/
        $Invitation = array('datingID' => '', 'invita' => '', 'listUser' => '');
        $this->session->unset_userdata($Invitation);
        /** Clear session search USER */
        $SearchUser = array('year_from' => '', 'year_to' => '', 'height_from' => '', 'height_to' => ''
                            , 'gender' => '', 'relationship' => '', 'children' => '', 'ethnic_origin' => ''
                            , 'religion' => '', 'training' => '', 'body' => '');
        $this->session->unset_userdata($SearchUser);
        
        redirect(site_url());
    }
    
    /** Action function*/
    function checkEmail(){
        $email = $this->input->post('email',true);
        $id = $this->user->getUser('',$email);
        if($id){
            $data['status'] = true;
        }else{
            $data['status'] = false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
        return;
    }
    function addFavorite(){
        $userID = $this->input->post('user',true);
        $user = $this->session->userdata('user');
        if($user && $userID){
            $DB['user_from'] = $user->id;
            $DB['user_to'] = $userID;
            $DB['dt_create'] = date('Y-m-d H:i:s');
            $DB['bl_active'] = 1;
            $id = $this->user->addFavorite($DB);
            if($id){
                actionUser($user->id,$userID,'Favorite',2);
                $data['status'] = true;
            }else{
                $data['status'] = false;
            }
        }else{
            $data['status'] = false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
        return;
    }
    function removeFavorite(){
        $userID = $this->input->post('user',true);
        $user = $this->session->userdata('user');
        if($user && $userID){
            $id = $this->user->removeFavorite($user->id,$userID);
            if($id){
                $data['status'] = true;
            }else{
                $data['status'] = false;
            }
        }else{
            $data['status'] = false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
        return;
    }
    function acceptDating(){
        $id = $this->input->post('id',true);
        $DB['accept'] = 1;
        $DB['dt_update'] = date('Y-m-d H:i:s');
        $id = $this->user->acceptDating($DB,$id);
        $isDated = $this->user->checkOrCreateDatedUser($id);
        if($id && $isDated == true){
            $data['status'] = true;
        }else{
            $data['status'] = false;
        }
        header('Content-Type: application/json');
		echo json_encode($data);
        return;
    }
    function getUserJoin(){
        $id = $this->input->post('id',true);
        $listUsers = $this->user->getUserDating($id);
        if($listUsers){
            $i=0;
            foreach($listUsers as $row){
                $users[$i]['id'] = $row->user;
                $users[$i]['name'] = $row->name;
                $users[$i]['code'] = $row->code;
                $users[$i]['birthday'] = $row->birthday;
                $users[$i]['accept'] = $row->accept;
                $users[$i]['time_end'] = $row->time_end;
                $users[$i]['facebook'] = $row->facebook;
                if($row->facebook && $row->avatar){
                    $users[$i]['avatar'] = $row->avatar;
                }else{
                    $photo = $this->user->getPhoto($row->user);
                    if($photo){
                        $users[$i]['avatar'] = $photo[0]->image;
                    }else{
                        $users[$i]['avatar'] = $photo;
                    }
                }
                $i++;
            }
        }else{
            $users = "";
        }
        $data['list'] = $users;
        $this->load->view('ajax/listuserjoin', $data);
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */