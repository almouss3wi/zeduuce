<section class="min-profile">
  <div class="container">
    <div class="row">
      <?php echo modules::run('left/left/index',$user->id);?>
      
      <div class="col-md-7">
        <div class="main_right">
          <div class="invitationer_box">
            <ul class="breadcrumb">
              <li class="active">Invitationer</li>
            </ul>
            <div class="row">
              <div class="col-xs-6">
                <a href="<?php echo site_url('invitationer/invitervip');?>" class="btn btnGray"><i class="i_star"></i><span>INVITÈR VIP</span></a>
              </div>
              <div class="col-xs-6">
                <a href="<?php echo site_url('invitationer/opretetevent');?>" class="btn btnGray"><i class="i_location"></i> <span>OPRET ET EVENT</span></a>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <a href="<?php echo site_url('invitationer/offentliginvitation');?>" class="btn btnGray"><i class="i_people_plus"></i> <span>OFFENTLIG INVITATION</span></a>
              </div>
              <div class="col-xs-6">
                <a href="<?php echo site_url('invitationer/offentligevent');?>" class="btn btnGray"><i class="i_calendar"></i> <span>OPRET OFFENTLIG EVENT</span></a>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <a href="<?php echo site_url('invitationer/slet');?>" class="btn btnGray"><i class="i_close"></i> <span>SLET RESERVATION</span></a>
              </div>
              <div class="col-xs-6">
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>  
</section>
<script>
$(document).ready(function(){
    $('#menu_invitationer').addClass('active');
});
</script>