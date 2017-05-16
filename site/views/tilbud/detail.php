<section class="breadcrumb-custom">
    <div class="container">
      <div class="row">
        <ul class="breadcrumb">
          <li><a href="<?php echo site_url('home')?>">Forside</a></li>
          <li><a href="<?php echo site_url('tilbud/index')?>">Tilbud</a></li>
          <li class="active"><?php echo $item->name;?></li>
        </ul>
      </div>
    </div>
</section>
<section class="tilbud">
    <div class="container">
      <div class="row mt30 mb30">
        <div class="col-md-12">
            <div id="ninja-slider" class="col-md-9 col-xs-12 col-sm-10">
            <div class="slider-inner">
                <ul>
                    <li>
                      <a class="ns-img" href="<?php echo base_url();?>/uploads/product/<?php echo $item->image;?>"></a>
                      <span class="cate"><?php echo $item->company;?></span>
                      <div class="info-bottom2 clearfix">
                        <p class="deal-name"><?php echo $item->name;?></p>
                        <a href="javascript:void(0)" onclick="addCart('<?php echo $item->id;?>')" class="btn btnOderNow">Bestil nu</a>
                        <p class="price2">Pris: <?php echo priceFormat($item->price);?></p>
                      </div>
                    </li>
                    <?php if($image){foreach($image as $row){?>
                    <li>
                      <a class="ns-img" href="<?php echo base_url();?>/uploads/product/<?php echo $row->image;?>"></a>
                      <span class="cate"><?php echo $item->company;?></span>
                      <div class="info-bottom2 clearfix">
                        <p class="deal-name"><?php echo $item->name;?></p>
                        <a href="javascript:void(0)" onclick="addCart('<?php echo $item->id;?>')" class="btn btnOderNow">Bestil nu</a>
                        <p class="price2">Pris: <?php echo priceFormat($item->price);?></p>
                      </div>
                    </li>
                    <?php }}?>
                    <input type="hidden" name="id_<?php echo $item->id;?>" id="id_<?php echo $item->id;?>" value="<?php echo $item->id;?>" />
                    <input type="hidden" name="qty_<?php echo $item->id;?>" id="qty_<?php echo $item->id;?>" value="1" />
                    <input type="hidden" name="price_<?php echo $item->id;?>" id="price_<?php echo $item->id;?>" value="<?php echo $item->price;?>" />
                </ul>
                <div class="fs-icon" title="Expand/Close"></div>
            </div>
        </div>
        <div id="thumbnail-slider" class="col-md-3 col-xl-12 col-sm-2">
            <div class="inner">
                <ul>
                    <li>
                        <a class="thumb" href="<?php echo base_url();?>thumb/timthumb.php?src=<?php echo base_url();?>uploads/product/<?php echo $item->image;?>&w=255&h=100&q=100"></a>
                    </li>
                    <?php if($image){foreach($image as $row){?>
                    <li>
                        <a class="thumb" href="<?php echo base_url();?>thumb/timthumb.php?src=<?php echo base_url();?>uploads/product/<?php echo $row->image;?>&w=255&h=100&q=100"></a>
                    </li>
                    <?php }}?>
                </ul>
            </div>
        </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <?php echo $item->content;?>
        </div>
      </div>

      <div class="row mb30">
        <div class="col-lg-12">
          <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4467.355701648302!2d12.52256086382243!3d55.9549552939058!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x465237b08f840799%3A0x5ef6bf7d25b666bf!2zR2wgU3RyYW5kdmVqIDEzNywgMzA1MCBIdW1sZWLDpmssIMSQYW4gTeG6oWNo!5e0!3m2!1svi!2s!4v1447728610753" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
      </div>

      <div class="row mb30">
        <div class="col-lg-12">
          <a class="btnBack" href="<?php echo site_url('tilbud/index');?>">Tilbage</a>
        </div>
      </div>

      <div class="row">
        <div class="related-deals">
          <div class="col-lg-12">
            <h2>Related deals</h2>
          </div>
          <div class="result">
            <?php if($list){$i=1; foreach($list as $row){?>
            <div class="col-md-6 <?php if($i%2){echo "pl0-r10";}else{echo "pl0-r0";}?>">
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
            </div>
            <?php $i++;}}?>
          </div>
        </div>
      </div>

    </div>
</section>
<script>
$(document).ready(function(){
    $('#menu_tilbud').addClass('active');
});
</script>