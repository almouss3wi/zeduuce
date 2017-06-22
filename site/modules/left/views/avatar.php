<?php if($user->facebook){?>
    <img src="https://graph.facebook.com/<?php echo $user->facebook;?>/picture?type=square" alt="" class="img-responsive"/>
<?php }else if($user->avatar){ ?>
    <img src="<?php echo base_url();?>thumb/timthumb.php?src=<?php echo base_url();?>uploads/user/<?php echo $user->avatar;?>&w=270&h=270&q=100" alt="" class="img-responsive"/>
<?php }else{?>
    <img src="<?php echo base_url();?>templates/img/no-avatar.jpg" alt="" class="img-responsive"/>
<?php }?>