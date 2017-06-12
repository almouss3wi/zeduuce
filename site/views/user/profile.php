<section class="min-profile">
    <div class="container">
        <div class="row">
            <div class="col-md-4 main-left">
                <!--<p class="f12">Profilenr. <?php /*echo $item->id; */?></p>-->
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
                <?php if($item->slogan){?>
                <p class="f12 profile_number2"><?php echo $item->slogan; ?></p>
                <?php }?>
            </div>
            <div class="col-md-8">
                <div class="main_right">
                    <div class="invitationer_box">
                        <div class="row">
                            <div class="col-xs-6">
                                <h3 class="text-uppercase"><?php echo $item->name; ?></h3>
                            </div>
                            <div class="col-xs-6">
                                <a class="pull-right" href="<?php echo site_url('user/browsing') ?>">Tilbage til
                                    søgeresultatet</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9">
                                <!--<h4><i>Jeg søger: Kvinde</i></h4>-->
                                <div><?php echo $item->description; ?></div>
                            </div>
                        </div>
                        <div class="row mt30">
                            <div class="col-md-9 box_info_highline col-xs-offset-right-2">
                                <div class="col-md-6 col-sm-6">
                                    <?php if ($item->birthday) {
                                        $yearold = date('Y', time()) - explode('/', $item->birthday)[2];
                                    } else {
                                        $yearold = "";
                                    } ?>
                                    <p><strong>Alder</strong>: <?php echo $yearold; ?> år</p>
                                    <p><strong>Forhold</strong>: <?php echo $item->relationship; ?></p>
                                    <p><strong>Etnisk oprindelse</strong>: <?php echo $item->ethnic_origin; ?></p>
                                    <p><strong>Uddannelse</strong>: <?php echo $item->training; ?></p>
                                    <p><strong>Postnr</strong>: <?php echo $item->code; ?></p>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <p><strong>Køn</strong>: <?php if ($item->gender == 1) {
                                            echo "Kvinde";
                                        } else if ($item->gender == 2) {
                                            echo "Mand";
                                        } else {
                                            echo "";
                                        } ?></p>
                                    <p><strong>Børn</strong>: <?php echo $item->children; ?></p>
                                    <p><strong>Religion</strong>: <?php echo $item->religion; ?></p>
                                    <p><strong>Kropsbygning</strong>: <?php echo $item->body; ?></p>
                                    <p><strong>Ryger</strong>: <?php echo $item->smoking; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt30">
                            <ol class="list-inline text-center step-indicator">
                                <li>
                                    <div class="step"><a
                                                href="<?php echo site_url('user/messages/' . $item->id . '/' . seoUrl($item->name)); ?>"><i
                                                    class="i_step1"></i></a></div>
                                    <div class="caption hidden-xs hidden-sm">Send besked</div>
                                </li>
                                <li>
                                    <div class="step"><i class="i_step2"></i></div>
                                    <div class="caption hidden-xs hidden-sm">ikke online til chat</div>
                                </li>
                                <li>
                                    <div class="step">
                                        <a href="javascript:void(0)" <?php if ($status->isKissed) { ?> onclick="removeKiss('<?php echo $item->id; ?>');" <?php } else { ?> onclick="sendKiss('<?php echo $item->id; ?>');"  <?php } ?>>
                                            <i class="<?php if ($status->isKissed) {
                                                echo 'i_step3 active';
                                            } else {
                                                echo 'i_step3';
                                            } ?>"></i>
                                        </a>
                                    </div>
                                    <div class="caption hidden-xs hidden-sm"><?php if ($status->isKissed) {
                                            echo 'Sendt kys';
                                        } else {
                                            echo 'Send kys';
                                        } ?></div>
                                </li>
                                <li>
                                    <div class="step">
                                        <a href="javascript:void(0)" <?php if ($status->isFavorite) { ?> onclick="removeFavorite('<?php echo $item->id; ?>');" <?php } else { ?> onclick="addFavorite('<?php echo $item->id; ?>');"  <?php } ?>>
                                            <i class="<?php if ($status->isFavorite) {
                                                echo 'i_step4 active';
                                            } else {
                                                echo 'i_step4';
                                            } ?>"></i>
                                        </a>
                                    </div>
                                    <div class="caption hidden-xs hidden-sm"><?php if ($status->isFavorite) {
                                            echo 'Fjern fra favoritter';
                                        } else {
                                            echo 'Tilføj til favoritter';
                                        } ?></div>
                                </li>
                            </ol>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-uppercase">ZeDuuce box</h3>
                            </div>
                            <div class="col-md-6">
                                <p><i class="fa fa-heart red" aria-hidden="true"></i> Ønskeliste</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="zeduuce_box clearfix">
                                <!--Box wishlist-->
                                <?php echo modules::run('wishlist/wishlist/index', $item->id); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="text-uppercase">Mine liv billeder</h3>
                            </div>
                            <div class="col-sm-6">
                                <!--a href="<?php echo site_url('user/myphoto') ?>" class="btn-link pull-right">Tilføj nyt billede</a-->
                            </div>
                            <!--Box My photo-->
                            <?php echo modules::run('myphoto/myphoto/index', $item->id); ?>
                        </div>

                        <!--<div class="row mt30">
                            <div class="col-lg-12">
                                <h3 class="text-uppercase">Instagram billeder</h3>
                            </div>
                            <div class="col-lg-12">
                                <div id="instagram_photo" class="owl-carousel mypicture">
                                    <div class="item">
                                        <a class="fancybox" rel="gallery2"
                                           href="<?php /*echo base_url(); */?>templates/img/6_.jpg"><img
                                                    src="<?php /*echo base_url(); */?>templates/img/6.jpg" alt=""
                                                    class="img-responsive"></a>
                                    </div>
                                    <div class="item">
                                        <a class="fancybox" rel="gallery2"
                                           href="<?php /*echo base_url(); */?>templates/img/6_.jpg"><img
                                                    src="<?php /*echo base_url(); */?>templates/img/6.jpg" alt=""
                                                    class="img-responsive"></a>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>