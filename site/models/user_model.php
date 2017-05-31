<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model{
	function __construct(){
        parent::__construct();
	}

    /**
     * @param $meta
     * @param array $data
     * @param string $custom_title
     */
    public function addMeta($meta, &$data = array(), $custom_title = ''){
        if($custom_title != ''){
            $data['title'] = $custom_title;
        } else {
            $data['title'] = ($meta)?$meta->name:"";
        }
        $data['meta_title'] = ($meta)?$meta->meta_title:"";
        $data['meta_keywords'] = ($meta)?$meta->meta_keywords:"";
        $data['meta_description'] = ($meta)?$meta->meta_description:"";
    }

    /** USER*/
    function getBrowsing($num=NULL,$offset=NULL,$search=NULL,$ignore=NULL){
        $this->db->select('u.*');
        $this->db->from('user as u');
        $this->db->where("u.bl_active",1);
        //Search
        if($search['year_from']){
            $this->db->where('u.year >=', $search['year_from']);
        }
        if($search['year_to']){
            $this->db->where('u.year <=', $search['year_to']);
        }
        if($search['height_from']){
            $this->db->where('u.height >=', $search['height_from']);
        }
        if($search['height_to']){
            $this->db->where('u.height <=', $search['height_to']);
        }
        if(isset($search['gender'])&&$search['gender']!=0){
            $this->db->where('u.gender', $search['gender']);
        }
        if(isset($search['relationship'])&&$search['relationship'][0]!=""){
            //$inUser = array(12, 13);
            $this->db->where_in('u.relationship', $search['relationship']);
        }
        if(isset($search['children'])&&$search['children'][0]!=""){
            $this->db->where_in('u.children', $search['children']);
        }
        if(isset($search['ethnic_origin'])&&$search['ethnic_origin'][0]!=""){
            $this->db->where_in('u.ethnic_origin', $search['ethnic_origin']);
        }
        if(isset($search['religion'])&&$search['religion'][0]!=""){
            $this->db->where_in('u.religion', $search['religion']);
        }
        if(isset($search['training'])&&$search['training'][0]!=""){
            $this->db->where_in('u.training', $search['training']);
        }
        if(isset($search['body'])&&$search['body'][0]!=""){
            $this->db->where_in('u.body', $search['body']);
        }
        if($ignore){
            //$ignore = array(12, 13);
            $this->db->where_not_in('u.id', $ignore);
        }
		$this->db->order_by('u.id','DESC');
        if($num || $offset){
            $this->db->limit($num,$offset);
        }
    	$query = $this->db->get()->result();
	    return $query;
    }
    function getNum($search=NULL,$ignore=NULL){
        $this->db->select('u.*');
        $this->db->from('user as u');
        $this->db->where("u.bl_active",1);
        //Search
        if($search['year_from']){
            $this->db->where('u.year >=', $search['year_from']);
        }
        if($search['year_to']){
            $this->db->where('u.year <=', $search['year_to']);
        }
        if($search['height_from']){
            $this->db->where('u.height >=', $search['height_from']);
        }
        if($search['height_to']){
            $this->db->where('u.height <=', $search['height_to']);
        }
        if(isset($search['gender'])&&$search['gender']!=0){
            $this->db->where('u.gender', $search['gender']);
        }
        if(isset($search['relationship'])&&$search['relationship'][0]!=""){
            //$inUser = array(12, 13);
            $this->db->where_in('u.relationship', $search['relationship']);
        }
        if(isset($search['children'])&&$search['children'][0]!=""){
            $this->db->where_in('u.children', $search['children']);
        }
        if(isset($search['ethnic_origin'])&&$search['ethnic_origin'][0]!=""){
            $this->db->where_in('u.ethnic_origin', $search['ethnic_origin']);
        }
        if(isset($search['religion'])&&$search['religion'][0]!=""){
            $this->db->where_in('u.religion', $search['religion']);
        }
        if(isset($search['training'])&&$search['training'][0]!=""){
            $this->db->where_in('u.training', $search['training']);
        }
        if(isset($search['body'])&&$search['body'][0]!=""){
            $this->db->where_in('u.body', $search['body']);
        }
        if($ignore){
            //$ignore = array(12, 13);
            $this->db->where_not_in('u.id', $ignore);
        }
    	$query = $this->db->get()->num_rows();
	    return $query;
    }
    
    function getList($num=NULL,$offset=NULL,$search=NULL,$ignore=NULL,$inUser=NULL){
        $this->db->select('u.*');
        $this->db->from('user as u');
        $this->db->where("u.bl_active",1);
        if($search['name']){
            $this->db->where('u.id LIKE "%'.$search['name'].'%" OR u.name LIKE "%'.$search['name'].'%"');
        }
        if($ignore){
            //$ignore = array(12, 13);
            $this->db->where_not_in('u.id', $ignore);
        }
        if($inUser){
            //$inUser = array(12, 13);
            $this->db->where_in('u.id', $inUser);
        }
		$this->db->order_by('u.id','DESC');
        if($num || $offset){
            $this->db->limit($num,$offset);
        }
    	$query = $this->db->get()->result();
	    return $query;
    }
    function getUser($id=NULL,$email=NULL,$password=NULL,$facebook=NULL,$google=NULL,$permission=NULL){
        $this->db->select('*')->from('user');
        if($id){
            $this->db->where("id",$id);
        }
        if($email){
            $this->db->where("email",$email);
        }
        if($password){
            $this->db->where("password",$password);
        }
        if($facebook){
            $this->db->where("facebook",$facebook);
        }
        if($google){
            $this->db->where("google",$google);
        }
        if($permission){
            $this->db->where("permission",$permission); //1: register - 2: facebook - 3: google
        }
        $query = $this->db->get()->row();
	    return $query;
    }
    function getB2b($id=NULL,$email=NULL,$password=NULL){
        $this->db->select('*')->from('user_b2b');
        if($id){
            $this->db->where("id",$id);
        }
		if($email){
            $this->db->where("email",$email);
		}
        if($password){
            $this->db->where("password",$password);
        }
        $query = $this->db->get()->row();
        return $query;
	}
    function updateLogin($id=NULL, $b2b=NULL){
        if($b2b){
            $this->db->set('login', date('Y-m-d H:i:s'));
            $this->db->where('id', $id);
            $query = $this->db->update('user_b2b');
            if($query){
                return $id;
            }else{
                return false;
            }
        }else{
            $this->db->set('login', date('Y-m-d H:i:s'));
            $this->db->where('id', $id);
            $query = $this->db->update('user');
            if($query){
                return $id;
            }else{
                return false;
            }
        }
	}
    function saveUser($DB=NULL,$id=NULL){
        if($id){
            $this->db->where('id',$id);
            $this->db->update('user',$DB);
            return $id;
        }else{
            if($this->db->insert('user',$DB)){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }
    /** MESSAGE*/
    function saveMessage($DB=NULL){
        if($this->db->insert('user_messages',$DB)){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    function getMessages($user=NULL,$userID=NULL,$num=NULL,$offset=NULL){
		$this->db->select('m.*, u.name');
		$this->db->from('user_messages m');
        $this->db->join('user u', 'm.user_from = u.id','left');
        $this->db->where('(m.user_from='.$user.' AND m.user_to='.$userID.') OR (m.user_from='.$userID.' AND m.user_to='.$user.')');
        $this->db->order_by('m.id DESC');
        if($num || $offset){
            $this->db->limit($num, $offset);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function getListMessage($user=NULL){
        $this->db->select('DISTINCT(user_from)');
        $this->db->from('user_messages');
        $this->db->where('user_to', $user);
        $this->db->order_by('id DESC');
        $query = $this->db->get();
        return $query->result();
    }
    function getNotSeen($user=NULL,$userID=NULL){
        $this->db->select('COUNT(*) num');
        $this->db->from('user_messages');
        $this->db->where('user_from', $userID);
        $this->db->where('user_to', $user);
        $this->db->where('seen', 1);
        $query = $this->db->get();
        return $query->row()->num;
    }
    
    function getLatestMessage($user=NULL,$userID=NULL){
        $this->db->select('message, dt_create');
        $this->db->from('user_messages');
        $this->db->where('user_from', $userID);
        $this->db->where('user_to', $user);
        $this->db->order_by('id DESC');
        $this->db->limit(1, 0);
        $query = $this->db->get();
        return $query->row();
    }
    function clearNotSeen($user=NULL,$userID=NULL){
        $this->db->set('seen',0)->where('user_from', $userID)->where('user_to', $user)->update('user_messages');
        return true;
    }
    function deleteMessage_FT($user=NULL,$userID=NULL){
        $this->db->where('user_from', $user)->where('user_to', $userID)->delete('user_messages');
        return true;
    }
    function deleteMessage_TF($user=NULL,$userID=NULL){
        $this->db->where('user_to', $user)->where('user_from', $userID)->delete('user_messages');
        return true;
    }
    /** FAVORITE*/
    function getFavorite($num=NULL,$offset=NULL,$user=NULL,$search=NULL){
        $this->db->select('u.*');
        $this->db->from('user_favorite as uf');
        $this->db->join('user as u', 'u.id = uf.user_to', 'left');
        if($search['name']){
            $this->db->where('u.id LIKE "%'.$search['name'].'%" OR u.name LIKE "%'.$search['name'].'%"');
        }
        $this->db->where("uf.user_from",$user);
        $this->db->where("u.bl_active",1);
		$this->db->order_by('uf.id','DESC');
        if($num || $offset){
            $this->db->limit($num,$offset);
        }
    	$query = $this->db->get()->result();
	    return $query;
    }
    function getNumFavorite($user=NULL){
        $this->db->select('uf.*');
        $this->db->from('user_favorite as uf');
        $this->db->where("uf.user_from",$user);
        $this->db->where("uf.bl_active",1);
    	$query = $this->db->get()->num_rows();
	    return $query;
    }
    function addFavorite($DB=NULL,$id=NULL){
        if($id){
            $this->db->where('id',$id);
            $this->db->update('user_favorite',$DB);
            return $id;
        }else{
            if($this->db->insert('user_favorite',$DB)){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }
    function removeFavorite($user=NULL,$userID=NULL){
        $this->db->where('user_from',$user);
        $this->db->where('user_to',$userID);
        if($this->db->delete('user_favorite')){
            return true;
        }else{
            return false;
        }
    }
    function checkFavorite($user=NULL,$userID=NULL){
        $query = $this->db->where('user_from', $user)->where('user_to', $userID)->get('user_favorite')->row();
		return $query;
    }

    /**
     * @author T.Trung
     * @param null $user_id_1
     * @param null $user_id_2
     * @return mixed
     */
    function checkStatus($user_id_1 = NULL,$user_id_2 = NULL){
        $status = new stdClass();
        $query = $this->db->where('user_from', $user_id_1)->where('user_to', $user_id_2)->get('user_favorite')->num_rows();
        $status->isFavorite = $query?true:false;

        $query = $this->db->where('user_id', $user_id_1)->where('invited_user_id', $user_id_2)->get('user_dated')->num_rows();
        $status->isDated = $query?true:false;

        $query = $this->db->where('from_user_id', $user_id_1)->where('to_user_id', $user_id_2)->get('user_kisses')->num_rows();
        $status->isKissed = $query?true:false;

        return $status;
    }

    /**
     * @param null $DB
     * @return bool
     */
    function sendKiss($DB=NULL){
        if($this->db->insert('user_kisses',$DB)){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    /**
     * @param null $user
     * @param null $userID
     * @return bool
     */
    function removeKiss($user=NULL,$userID=NULL){
        $this->db->where('from_user_id',$user);
        $this->db->where('to_user_id',$userID);
        if($this->db->delete('user_kisses')){
            return true;
        }else{
            return false;
        }
    }
    
    /** POSITIV*/
    function getPositiv($num=NULL,$offset=NULL,$user=NULL,$search=NULL){
        $this->db->select('u.*');
        $this->db->from('user_action as ua');
        $this->db->join('user as u', 'u.id = ua.user_to', 'left');
        $this->db->where("ua.user_from",$user);
        $this->db->where("ua.bl_active",1);
        $this->db->where("u.bl_active",1);
		$this->db->order_by('ua.id','DESC');
        if($num || $offset){
            $this->db->limit($num,$offset);
        }
    	$query = $this->db->get()->result();
	    return $query;
    }
    function getNumPositiv($user=NULL){
        $this->db->select('ua.*');
        $this->db->from('user_action as ua');
        $this->db->where("ua.user_from",$user);
        $this->db->where("ua.bl_active",1);
    	$query = $this->db->get()->num_rows();
	    return $query;
    }
    
    /** TILBUD*/
    function getMyTilbud($user){
        $query = $this->db->select('po.*, pp.name, pp.image, pp.description, b2b.name as company')
                ->from('product_order_item as po')
                ->join('product_product as pp', 'pp.id = po.product_id', 'left')
                ->join('user_b2b as b2b', 'b2b.id = pp.company_id', 'left')
                ->join('product_order as p', 'p.id = po.order_id', 'left')
                ->where("p.userID",$user)
                ->where("p.bl_active",1)
                ->order_by('po.id','DESC')
                ->get()->result();
	    return $query;
    }
    
    /** IMAGES*/
    function getPhoto($user=NULL){
        $this->db->select('*')->from('user_image');
        if($user){
            $this->db->where("userID",$user);
        }
        $query = $this->db->get()->result();
        return $query;
    }
    function getNumPhoto($user=NULL){
        $this->db->select('*')->from('user_image');
        if($user){
            $this->db->where("userID",$user);
        }
        $query = $this->db->get()->num_rows();
	    return $query;
    }
    function savePhoto($DB=NULL){
        if($this->db->insert('user_image',$DB)){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    
    /** INVITATION*/
    function getDating($user=NULL){
        $query = $this->db->select('dt.*')
                ->from('dating as dt')
                ->where('bl_active',1)
                ->where('userID',$user)
                ->order_by('dt.id','DESC')
                ->get()->result();
        return $query;
    }
    function getUserDating($datingID=NULL,$search=NULL){
        $query = $this->db->select('du.*, u.name, u.birthday, u.code, u.avatar, u.facebook')
                ->from('dating_user as du')
                ->join('user as u','u.id = du.user','left')
                ->where('du.datingID',$datingID)
                ->get()->result();
        return $query;
    }
    function getImageDating($datingID=NULL){
        $query = $this->db->select('di.*')
                ->from('dating_image as di')
                ->where('di.datingID',$datingID)
                ->get()->result();
        return $query;
    }
    function getDatingOrderItem($itemID=NULL){
        $query = $this->db->select('po.*, pp.name, pp.description, pp.image, pc.name as company')
                ->from('product_order_item as po')
                ->join('product_product as pp','pp.id = po.product_id','left')
                ->join('product_category as pc','pc.category_id = po.category_id','left')
                ->where('po.id',$itemID)
                ->get()->row();
        return $query;
    }
    //Delete dating
    function deleteUser($datingID=NULL){
        $this->db->where('datingID',$datingID);
        if($this->db->delete('dating_user')){
            return true;
        }else{
            return false;
        }
    }
    function deleteImage($datingID=NULL){
        $this->db->where('datingID',$datingID);
        if($this->db->delete('dating_image')){
            return true;
        }else{
            return false;
        }
    }
    function deleteDating($datingID=NULL){
        $this->db->where('id',$datingID);
        if($this->db->delete('dating')){
            return true;
        }else{
            return false;
        }
    }
    //myinvitationerjoin
    function getDatingByUser($userID=NULL){
        $query = $this->db->select('dt.*, du.id as datinguserID, du.time_start, du.time_end, du.accept, u.name as nameUser, u.avatar, u.facebook')
                ->from('dating_user as du')
                ->join('dating as dt','dt.id = du.datingID','left')
                ->join('user as u','u.id = dt.userID','left')
                ->where('du.user',$userID)
                ->where('du.time_end >=',time())
                ->order_by('dt.id','DESC')
                ->get()->result();
        return $query;
    }
    function deleteDatingUser($id=NULL){
        $this->db->where('id',$id);
        if($this->db->delete('dating_user')){
            return true;
        }else{
            return false;
        }
    }
    function acceptDating($DB=NULL,$id=NULL){
        if($id){
            $this->db->where('id',$id);
            $this->db->update('dating_user',$DB);
            return $id;
        }else{
            return false;
        }
    }
    //myinvitationerapproved
    function getDatingApproved($user=NULL){
        $query = $this->db->select('dt.*, du.id as datinguserID, du.time_start, du.time_end, du.accept')
                ->from('dating_user as du')
                ->join('dating as dt','dt.id = du.datingID','left')
                ->where('dt.userID',$user)
                ->where('du.accept',1)
                ->order_by('dt.id','DESC')
                ->group_by('dt.id')
                ->get()->result();
        return $query;
    }
    function getUserApproved($datingID=NULL){
        $query = $this->db->select('du.*, u.name as nameUser, u.avatar, u.facebook')
                ->from('dating_user as du')
                ->join('user as u','u.id = du.user','left')
                ->where('du.datingID',$datingID)
                ->where('du.accept',1)
                ->get()->result();
        return $query;
    }
    
    //T.Trung

    /**
     * @param int $dating_user_id
     * @return boolean
     */
    public function checkOrCreateDatedUser($dating_user_id){
        $row = $this->db->select('d.userID, du.user')
            ->from('dating as d')
            ->join('dating_user as du', 'd.id = du.datingID')
            ->where('du.id', $dating_user_id)
            ->get()->row();
        $user_id = $row->userID;
        $invited_user_id = $row->user;

        //check 2 person is dated
        $isDated = isDated($user_id, $invited_user_id);
        if($isDated === false){
            $data = array('user_id'=>$user_id, 'invited_user_id'=>$invited_user_id);
            $isDated = $this->db->insert('user_dated', $data);
        }
        return $isDated;
    }

    /**
     * @param integer $num
     * @param integer $offset
     * @param integer $user
     * @param string $search
     * @return query result
     */
    function getContactPersons($num=NULL,$offset=NULL,$user=NULL,$search=NULL){
        $this->db->select('u.*');
        $this->db->from('user_dated as ud');
        $this->db->join('user as u', 'u.id = ud.invited_user_id', 'left');
        if($search['name']){
            $this->db->where('u.id LIKE "%'.$search['name'].'%" OR u.name LIKE "%'.$search['name'].'%"');
        }
        $this->db->where("ud.user_id",$user);
        $this->db->order_by('ud.id','DESC');
        if($num || $offset){
            $this->db->limit($num,$offset);
        }
        $query = $this->db->get()->result();
        return $query;
    }

    /**
     * @param null $user_id
     * @return integer
     */
    function getNumContactPersons($user_id = NULL){
        $this->db->select('ud.id');
        $this->db->from('user_dated as ud');
        $this->db->where("ud.user_id",$user_id);
        $query = $this->db->get()->num_rows();
        return $query;
    }

    /**
     * @param null $user_id
     * @return mixed
     */
    function getNumSentKiss($user_id = NULL){
        $this->db->select('id');
        $this->db->from('user_kisses');
        $this->db->where("from_user_id",$user_id);
        $query = $this->db->get()->num_rows();
        return $query;
    }

    /**
     * @param null $num
     * @param null $offset
     * @param null $user_id
     * @param null $search
     * @return mixed
     */
    function getSentKiss($num = NULL, $offset = NULL, $user_id = NULL, $search = NULL){
        $this->db->select('u.*, uk.send_at');
        $this->db->from('user_kisses as uk');
        $this->db->join('user as u', 'u.id = uk.to_user_id', 'left');
        $this->db->where("uk.from_user_id",$user_id);
        $this->db->order_by('uk.send_at','DESC');
        if($num || $offset){
            $this->db->limit($num,$offset);
        }
        $query = $this->db->get()->result();
        return $query;
    }
    /** The End*/
}