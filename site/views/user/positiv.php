<section class="min-profile">
    <div class="container">
        <div class="row">
            <?php echo modules::run('left/left/index', $user->id); ?>

            <div class="col-md-9">
                <div class="main_right">
                    <?php
                    if (!empty($userList)) {
                        foreach ($userList as $item) {
                            ?>
                            <div class="row positive_item">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="avatar_positive">
                                        <a href="<?php echo site_url('user/profile/' . $item->id . '/' . seoUrl($item->name)) ?>">
                                            <?php echo modules::run('left/left/avatar', (object)$item, 163, 163); ?>
                                        </a>
                                    </div>
                                    <p class="name">
                                        <a href="<?php echo site_url('user/profile/' . $item->id . '/' . seoUrl($item->name)) ?>">
                                            <?php echo $item->name; ?>
                                        </a>
                                    </p>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <?php if ($item->sentKissStatus === false) { ?>
                                                <a class="btn btnPositive2"><span class="btnPositive_content">Har sendt dig et kys</span></a>
                                            <?php } else { ?>
                                                <a class="btn btnPositive2 active">
                                                    <span class="btnPositive_content">Har sendt dig et kys <span
                                                                class="timer"><?php echo date("d.m.Y", $item->sentKissTime) ?>
                                                            Kl.<?php echo date("H:i", $item->sentKissTime) ?></span></span>
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <?php if ($item->isDatedStatus === false) { ?>
                                                <a class="btn btnPositive2"><span class="btnPositive_content">Har sagt ja</span></a>
                                            <?php } else { ?>
                                                <a class="btn btnPositive2 active">
                                                    <span class="btnPositive_content">Har sagt ja <i
                                                                class="icon_lips"></i><span class="timer"><?php echo date("d.m.Y", $item->datedTime) ?> Kl.<?php echo date("H:i", $item->datedTime) ?></span></span>
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <?php if ($item->addedToFavoriteStatus === false) { ?>
                                                <a class="btn btnPositive2"><span class="btnPositive_content">Har som favorit</span></a>
                                            <?php } else { ?>
                                                <a class="btn btnPositive2 active">
                                                    <span class="btnPositive_content">Har som favorit <span class="timer"><?php echo date("d.m.Y", $item->addedToFavoriteTime) ?> Kl.<?php echo date("H:i", $item->addedToFavoriteTime) ?></span></span>
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <?php if ($item->sentInvitationStatus === false) { ?>
                                                <a class="btn btnPositive2"><span class="btnPositive_content">Har sendt invitation</span></a>
                                            <?php } else { ?>
                                                <a class="btn btnPositive2 active">
                                                    <span class="btnPositive_content">Har sendt invitation</span>
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <a href="<?php echo site_url('user/redirectToProfile/' . $item->id . '/' . seoUrl($item->name)) ?>" class="btn btnPositive2 <?php if ($item->seeMore3TimesStatus != false) echo 'active';?>"><span class="btnPositive_content">Har set din profil 3+ gange <?php if($item->lastSeeTime){?><span class="timer">Sidste set tid: <?php echo date("d.m.Y", $item->lastSeeTime) ?> Kl.<?php echo date("H:i", $item->lastSeeTime) ?></span><?php }?></span></a>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <a href="<?php echo site_url('user/messages/' . $item->id . '/' . seoUrl($item->name)); ?>" class="btn btnPositive2 <?php if ($item->sentUnreadMessageStatus !== false) echo "active";?>">
                                                    <span class="btnPositive_content">Har sendt en besked <?php if($item->lastMessageTime){?><span class="timer"><?php echo date("d.m.Y", $item->lastMessageTime) ?> Kl.<?php echo date("H:i", $item->lastMessageTime) ?></span><?php }?></span>
                                                </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    &nbsp;
                                </div>
                                <div class="col-md-6">
                                    <ul class="pagination pagination-sm pull-right">
                                        <?php echo $pagination; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <p>Der er ingen data!</p>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $('#menu_positiv').addClass('active');
    });
</script>