<div class="col-md-3">
    <div class="img_product">
        <!--<p class="f12">Profilenr. <?php /*echo $item->id;*/?></p>-->
        <div class="row">
            <div class="col-lg-12">
                <div id="sync1" class="owl-carousel">
                    <?php if($photo){ foreach($photo as $row){?>
                    <div class="item">
                        <a href="javascript:void(0)">
                            <img src="<?php echo base_url();?>thumb/timthumb.php?src=<?php echo base_url();?>uploads/photo/<?php echo $row->image;?>&w=263&h=263&q=100" alt="" class="img-responsive"/>
                        </a>
                    </div>
                    <?php }}else{?>
                    <div class="item">
                        <a href="javascript:void(0)">
                            <img src="<?php echo base_url();?>templates/img/no-avatar.jpg" alt="" class="img-responsive"/>
                        </a>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="sync2" class="owl-carousel">
                    <?php if($photo){ foreach($photo as $row){?>
                    <div class="item">
                        <a href="javascript:void(0)">
                            <img src="<?php echo base_url();?>thumb/timthumb.php?src=<?php echo base_url();?>uploads/photo/<?php echo $row->image;?>&w=63&h=63&q=100" alt="" class="img-responsive"/>
                        </a>
                    </div>
                    <?php }}else{?>
                    <div class="item">
                        <a href="javascript:void(0)">
                            <img src="<?php echo base_url();?>templates/img/no-avatar.jpg" alt="" width="63" height="63" class="img-responsive"/>
                        </a>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

    <ul class="list_info_profile">
        <li><a href="<?php echo site_url('user/profile/'.$item->id.'/'.seoUrl($item->name))?>">Se min Profil</a></li>
        <li><a href="<?php echo site_url('user/myphoto')?>">Mine Billeder (<span class="red" id="num-myphoto"><?php if($numphoto){echo $numphoto;}else{echo '0';}?></span>)</a></li>
        <li><a href="<?php echo site_url('user/mydeal')?>">Mine tilbud</a></li>
        <li><a href="<?php echo site_url('user/mymessages')?>">Mine beskeder</a></li>
        <li><a href="<?php echo site_url('user/myinvitationer')?>">Mine invitationer</a></li>
        <li><a href="<?php echo site_url('user/myinvitationerjoin')?>">Du skal forkæles! (<span class="red"><?php echo $numinvitajoin;?></span>)</a></li>
        <li><a href="<?php echo site_url('user/myinvitationerapproved')?>">Det er mig der forkæler! (<span class="red"><?php echo $numinvitaapproved;?></span>)</a></li>
        <li><a href="<?php echo site_url('user/mycontactperson')?>">Mine Kontaktpersoner</a></li>
    </ul>
</div>