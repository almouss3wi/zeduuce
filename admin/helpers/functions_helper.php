<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
	function icon_view($link){
        return '<a href="'.site_url($link).'" class="btn btn-icon btn-xs btn-info waves-effect waves-light" rel="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
        <i class="icon glyphicon glyphicon-search" aria-hidden="true"></i></a>';
    }
    function icon_view_popup($link,$id){
        return '<input type="hidden" id="linkDetail-'.$id.'" name="linkDetail-'.$id.'" value="'.site_url($link).'"/>
            <a href="javascript:void(0);" onclick="viewDetail('.$id.')" class="btn btn-icon btn-xs btn-info waves-effect waves-light" rel="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="View">
            <i class="icon glyphicon glyphicon-search" aria-hidden="true"></i></a>';
    }
    function icon_add($link){
        return '<a href="'.site_url($link).'" class="btn btn-icon btn-xs btn-primary waves-effect waves-light" rel="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
        <i class="icon glyphicon glyphicon-plus" aria-hidden="true"></i></a>';
    }
    function icon_edit($link){
        return '<a href="'.site_url($link).'" class="btn btn-icon btn-xs btn-warning waves-effect waves-light" rel="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
        <i class="icon glyphicon glyphicon-pencil" aria-hidden="true"></i></a>';
    }
	function icon_active($table,$field,$id,$status){
		if($status==1){
			$rep = 'ok';
            $title = 'Lock';
		}else{
			$rep ='remove';
            $title = 'Unlock';
		}
        return '<a href="javascript:void(0);" onclick="publish('.$table.','.$field.','.$id.','.$status.');" class="btn btn-icon btn-xs btn-success waves-effect waves-light" rel="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$title.'">
        <i class="icon glyphicon glyphicon-'.$rep.'" aria-hidden="true"></i></a>';
    }
    function icon_active_popup($table,$field,$id,$status){
		if($status==1){
			$rep ='ok';
            $title = 'Lock';
		}else{
			$rep ='remove';
            $title = 'Unlock';
		}
        return '<a href="javascript:void(0);" onclick="publishPopup('.$table.','.$field.','.$id.','.$status.');" class="btn btn-icon btn-xs btn-success waves-effect waves-light" rel="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$title.'">
        <i class="icon glyphicon glyphicon-'.$rep.'" aria-hidden="true"></i></a>';
    }
    function icon_delete($id){
        return '<a onclick="deleteItem('.$id.');" href="javascript:void(0);" class="btn btn-icon btn-xs btn-danger waves-effect waves-light" rel="tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
        <i class="icon glyphicon glyphicon-trash" aria-hidden="true"></i></a>';
    }
    function icon_sort($id,$ordering){
        return '<input type="text" class="form-control text-center" style="width:70px" name="ordering['.$id.']" value="'.$ordering.'" />';
    }
    if (!function_exists('base_url_site')){
        function base_url_site(){
            $CI =& get_instance();
            return $CI->config->slash_item('site');
        }
    }
?>