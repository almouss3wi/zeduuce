<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <p>Har <?php echo count($list);?> personer deltage</p>
        </div>
        <div class="modal-body">
            <?php if($list){foreach($list as $row){?>
            <div class="row attending_row">
                <div class="col-md-4">
                    <div class="info_people_attending">
                        <?php if($row['avatar']){if($row['facebook']){?>
                        <img src="https://graph.facebook.com/<?php echo $row['facebook'];?>/picture?type=large" alt="" width="48" height="48" class="img-responsive"/>
                        <?php }else{ ?>
                        <img src="<?php echo base_url();?>thumb/timthumb.php?src=<?php echo base_url();?>uploads/photo/<?php echo $row['avatar'];?>&w=48&h=48&q=100" alt="" class="img-responsive"/>
                        <?php }}else{?>
                        <img src="<?php echo base_url();?>templates/img/no-avatar.jpg" alt="" width="48" height="48" class="img-responsive"/>
                        <?php }?>
                        <h4><?php echo $row['name'];?></h4>
                        <?php if($row['birthday']){$yearold = date('Y',time()) - explode('/',$row['birthday'])[2];}else{$yearold = "";}?>
                        <p><?php echo $yearold;?> år - <?php echo $row['code'];?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="time2">
                        <p>
                            <?php if($row['time_end'] > time()){?>
                            <span><?php echo getTimeLeft($row['time_end'] - time());?></span>
                            <?php }else{?>
                            <span>Udløbet</span>
                            <?php }?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php if($row['accept'] == 1){?>
                    <a class="btn_Approve" href="javascript:void(0)">Godkende</a>
                    <?php }else if($row['accept'] == 2){?>
                    <a class="btn_Reject" href="javascript:void(0)">Afvis</a>
                    <?php }else{?>
                        <?php if($row['time_end'] > time()){?>
                            <a class="btn_waiting" href="javascript:void(0)">Afvent</a>
                        <?php }else{?>
                            <a class="btn_Reject" href="javascript:void(0)">Udløbet</a>
                        <?php }?>
                    <?php }?>
                </div>
            </div>
            <?php }}?>
        </div>
    </div>
</div>