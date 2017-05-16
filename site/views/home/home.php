<?php $user = $this->session->userdata['user'];?>
<section class="banner2">
    <div class="container">
        <div class="row">
            <a class="text-center" href="javascript:void(0)">
                <img src="<?php echo base_url();?>templates/img/banner.jpg" alt="" class="img-responsive" style="width: 100%;"/>
            </a>
        </div>
    </div>
</section>
<section class="dating-location">
    <div class="container">
        <h2 class="title2">Nyeste profiler</h2>
        <div class="row newest-profiles">
            <div class="col-md-12">
                <div id="owl-chat" class="owl-carousel">
                    <?php 
                    if($listUser){foreach($listUser as $row){
                        if($row['birthday']){
                            $yearold = date('Y',time()) - explode('/',$row['birthday'])[2];
                        }else{
                            $yearold = "";
                        }
                    ?>
                    <div class="item">
                        <div class="item-img">
                            <a href="<?php echo site_url('user/profile/'.$row['id'].'/'.seoUrl($row['name']));?>">
                                <?php if($row['avatar']){if($row['facebook']){?>
                                <img src="https://graph.facebook.com/<?php echo $row['facebook'];?>/picture?type=large" alt="" class="img-responsive"/>
                                <?php }else{ ?>
                                <img src="<?php echo base_url();?>thumb/timthumb.php?src=<?php echo base_url();?>uploads/photo/<?php echo $row['avatar'];?>&w=150&h=150&q=100" alt="" class="img-responsive"/>
                                <?php }}else{?>
                                <img src="<?php echo base_url();?>templates/img/no-avatar.jpg" alt="" class="img-responsive"/>
                                <?php }?>
                            </a>
                        </div>
                        <div class="info">
                            <h3><?php echo $row['name'];?></h3>
                            <p>Age: <?php echo $yearold;?></p>
                            <p>Viborg</p>
                        </div>
                    </div>
                    <?php }}?>
                </div>
                <a class="btn prev"><i class="fa fa-chevron-left"></i></a>
                <a class="btn next"><i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="border-customer"></div>
            </div>
        </div>
        <div class="row latest-offers">
            <div class="col-lg-12">
                <h2 class="title2">Nyeste tilbud</h2>
                <div id="owl-chat2" class="owl-carousel">
                    <?php if($listPro){foreach($listPro as $row){?>
                    <div class="item">
                        <div class="item-img">
                            <img src="<?php echo base_url();?>thumb/timthumb.php?src=<?php echo base_url();?>uploads/product/<?php echo $row->image;?>&w=570&h=250&q=100" alt="" class="img-responsive"/>
                            <span class="cate"><?php echo $row->company;?></span>
                            <div class="item-content">
                                <h3><?php echo $row->name;?></h3>
                                <div><?php echo $row->description;?></div>
                            </div>
                        </div>
                        <div class="info-bottom clearfix">
                            <p class="price">Pris: <?php echo priceFormat($row->price);?></p>
                            <a href="<?php echo site_url('tilbud/detail/'.$row->id.'/'.seoUrl($row->name));?>" class="btn btnOderNow">Bestil nu</a>
                        </div>
                    </div>
                    <?php }}?>
                </div>
                <a class="btn prev2"><i class="fa fa-chevron-left"></i></a>
                <a class="btn next2"><i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="border-customer"></div>
            </div>
        </div>
        <div class="row public-invitations">
            <div class="col-md-6">
                <h2>Offentlige invitationer</h2>
                <div id="owl-demo3" class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="item-img">
                            <span class="cate">Restaurant</span>
                            <img src="<?php echo base_url();?>templates/img/img05-larg.jpg" alt="" class="img-responsive">
                            <div class="item-content">
                                <h3>Restaurant Sletten</h3>
                                <p>Succesen er tilbage!!! Inviter på den ultimative spiseoplevelse når formel B byder på
                                    <br>aperitif, 4 sublime retter, vinmenu, kaffe, the & petit four.</p>
                            </div>
                        </div>
                        <div class="info-bottom clearfix">
                            <ul class="list-peo clearfix">
                                <li>
                                    <a href="#">
                                        <img src="<?php echo base_url();?>templates/img/peo12-small.jpg" alt="">
                                        <div class="box-tooltip">
                                            <div class="popover2 arrow-left clearfix">
                                                <img src="<?php echo base_url();?>templates/img/peo12-small-2.jpg" alt="">
                                                <h3>Heidi H.</h3>
                                                <p>Alder: 29 år
                                                    <br> Postnr. 2000</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="<?php echo base_url();?>templates/img/peo13-small.jpg" alt="">
                                        <div class="box-tooltip">
                                            <div class="popover2 arrow-left clearfix">
                                                <img src="<?php echo base_url();?>templates/img/peo13-small.jpg" alt="">
                                                <h3>Heidi H.</h3>
                                                <p>Alder: 29 år
                                                    <br> Postnr. 2000</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo14-small.jpg" alt="">
                                        <div class="box-tooltip">
                                            <div class="popover2 arrow-left clearfix">
                                                <img src="<?php echo base_url();?>templates/img/peo14-small.jpg" alt="">
                                                <h3>Heidi H.</h3>
                                                <p>Alder: 29 år
                                                    <br> Postnr. 2000</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="<?php echo base_url();?>templates/img/peo15-small.jpg" alt="">
                                        <div class="box-tooltip">
                                            <div class="popover2 arrow-left clearfix">
                                                <img src="<?php echo base_url();?>templates/img/peo15-small.jpg" alt="">
                                                <h3>Heidi H.</h3>
                                                <p>Alder: 29 år
                                                    <br> Postnr. 2000</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo12-small.jpg" alt="">
                                        <div class="box-tooltip">
                                            <div class="popover2 arrow-left clearfix">
                                                <img src="<?php echo base_url();?>templates/img/peo12-small-2.jpg" alt="">
                                                <h3>Heidi H.</h3>
                                                <p>Alder: 29 år
                                                    <br> Postnr. 2000</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo13-small.jpg" alt="">
                                        <div class="box-tooltip">
                                            <div class="popover2 arrow-left clearfix">
                                                <img src="<?php echo base_url();?>templates/img/peo13-small.jpg" alt="">
                                                <h3>Heidi H.</h3>
                                                <p>Alder: 29 år
                                                    <br> Postnr. 2000</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo14-small.jpg" alt="">
                                        <div class="box-tooltip">
                                            <div class="popover2 arrow-left clearfix">
                                                <img src="<?php echo base_url();?>templates/img/peo14-small.jpg" alt="">
                                                <h3>Heidi H.</h3>
                                                <p>Alder: 29 år
                                                    <br> Postnr. 2000</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo15-small.jpg" alt="">
                                        <div class="box-tooltip">
                                            <div class="popover2 arrow-left clearfix">
                                                <img src="<?php echo base_url();?>templates/img/peo12-small-2.jpg" alt="">
                                                <h3>Heidi H.</h3>
                                                <p>Alder: 29 år
                                                    <br> Postnr. 2000</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-img">
                            <span class="cate">Ophold</span>
                            <img src="<?php echo base_url();?>templates/img/img05-larg.jpg" alt="" class="img-responsive">
                            <div class="item-content">
                                <h3>Restaurant Sletten</h3>
                                <p>Succesen er tilbage!!! Inviter på den ultimative spiseoplevelse når formel B byder på
                                    <br>aperitif, 4 sublime retter, vinmenu, kaffe, the & petit four.</p>
                            </div>
                        </div>
                        <div class="info-bottom clearfix">
                            <ul class="list-peo clearfix">
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo12-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo13-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo14-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo15-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo12-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo13-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo14-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo15-small.jpg" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-img">
                            <span class="cate">Restaurant</span>
                            <img src="<?php echo base_url();?>templates/img/img05-larg.jpg" alt="" class="img-responsive">
                            <div class="item-content">
                                <h3>Restaurant Sletten</h3>
                                <p>Succesen er tilbage!!! Inviter på den ultimative spiseoplevelse når formel B byder på
                                    <br>aperitif, 4 sublime retter, vinmenu, kaffe, the & petit four.</p>
                            </div>
                        </div>
                        <div class="info-bottom clearfix">
                            <ul class="list-peo clearfix">
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo12-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo13-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo14-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo15-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo12-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo13-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo14-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo15-small.jpg" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-img">
                            <span class="cate">Ophold</span>
                            <img src="<?php echo base_url();?>templates/img/img05-larg.jpg" alt="" class="img-responsive">
                            <div class="item-content">
                                <h3>Restaurant Sletten</h3>
                                <p>Succesen er tilbage!!! Inviter på den ultimative spiseoplevelse når formel B byder på
                                    <br>aperitif, 4 sublime retter, vinmenu, kaffe, the & petit four.</p>
                            </div>
                        </div>
                        <div class="info-bottom clearfix">
                            <ul class="list-peo clearfix">
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo12-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo13-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo14-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo15-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo12-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo13-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo14-small.jpg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"><img src="<?php echo base_url();?>templates/img/peo15-small.jpg" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <h2>Shoutouts</h2>
                <div id="owl-demo4" class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="row border2">
                            <div class="box-info clearfix">
                                <div class="col-md-3 col-xs-3">
                                    <div class="box-info-img">
                                        <img src="<?php echo base_url();?>templates/img/peo12-mid.jpg" alt="" class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-9 col-xs-9">
                                    <div class="box-info-detail">
                                        <h4>Heidi H.</h4>
                                        <p>“ Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. ”</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="box-info clearfix">
                                <div class="col-md-3 col-xs-3">
                                    <div class="box-info-img">
                                        <img src="<?php echo base_url();?>templates/img/peo14-mid.jpg" alt="" class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-9 col-xs-9">
                                    <div class="box-info-detail">
                                        <h4>Joyfuldoe</h4>
                                        <p>“ Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. ”</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row border2">
                            <div class="box-info clearfix">
                                <div class="col-md-3 col-xs-3">
                                    <div class="box-info-img">
                                        <img src="<?php echo base_url();?>templates/img/peo12-mid.jpg" alt="" class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-9 col-xs-9">
                                    <div class="box-info-detail">
                                        <h4>Heidi H.</h4>
                                        <p>“ Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. ”</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="box-info clearfix">
                                <div class="col-md-3 col-xs-3">
                                    <div class="box-info-img">
                                        <img src="<?php echo base_url();?>templates/img/peo14-mid.jpg" alt="" class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-9 col-xs-9">
                                    <div class="box-info-detail">
                                        <h4>Joyfuldoe</h4>
                                        <p>“ Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. ”</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row border2">
                            <div class="box-info clearfix">
                                <div class="col-md-3 col-xs-3">
                                    <div class="box-info-img">
                                        <img src="<?php echo base_url();?>templates/img/peo12-mid.jpg" alt="" class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-9 col-xs-9">
                                    <div class="box-info-detail">
                                        <h4>Heidi H.</h4>
                                        <p>“ Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. ”</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="box-info clearfix">
                                <div class="col-md-3 col-xs-3">
                                    <div class="box-info-img">
                                        <img src="<?php echo base_url();?>templates/img/peo14-mid.jpg" alt="" class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-9 col-xs-9">
                                    <div class="box-info-detail">
                                        <h4>Joyfuldoe</h4>
                                        <p>“ Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. ”</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row border2">
                            <div class="box-info clearfix">
                                <div class="col-md-3 col-xs-3">
                                    <div class="box-info-img">
                                        <img src="<?php echo base_url();?>templates/img/peo12-mid.jpg" alt="" class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-9 col-xs-9">
                                    <div class="box-info-detail">
                                        <h4>Heidi H.</h4>
                                        <p>“ Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. ”</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="box-info clearfix">
                                <div class="col-md-3 col-xs-3">
                                    <div class="box-info-img">
                                        <img src="<?php echo base_url();?>templates/img/peo14-mid.jpg" alt="" class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-9 col-xs-9">
                                    <div class="box-info-detail">
                                        <h4>Joyfuldoe</h4>
                                        <p>“ Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. ”</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>