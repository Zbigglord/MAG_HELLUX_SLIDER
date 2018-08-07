<?php ?>
<!-- NEEDS FRONTEND SKIN :
   1. jquery
   2. bootstrap
Needs Frontend code: -->
<?php $slider = Hellux_Slider_Model_Slider::getSliderData(1); //1 is slider id so we may have as meny we want ?>
    <div id="slider">
        <div id="helluxSlider" class="carousel slide" data-ride="carousel">
		<!-- maybe we want indicators (if not just comment it out)-->
		<ol class="carousel-indicators">
		  <?php $i = 0;?>
          <?php foreach($slider as $item): ?>
		    <li class="<?php if($i == 0):?>active<?php endif;?>" data-slide-to="<?=$i?>" data-target="#helluxSlider"><?php echo $i+1; ?></li><!-- comments remove spaces between inline-block elements -->
		   <?php $i++;?>
           <?php endforeach; ?>
		</ol>		
		
		<!-- END maybe we want indicators -->
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php $i = 0;?>
                <?php foreach($slider as $item): ?>
                <div class="item <?php if($i == 0):?>active<?php endif;?>">
                <img class="img-reponsive carousel-image" src="<?php echo $item['item_address'].''.$item['item_file_name'] ?>" />
				<div class="slider-caption-container">
				 <div class="carousel-caption">
				 <?php if($item['has_header'] == 1): ?>
				 <?php if($item['has_link'] == 1): ?>
				 <?php if($item['has_button'] != 1):?>
				 <a class="slider-button-link" href="<?=$item['item_link'] ?>"><h3 class="slider-header"><?= $item['item_header_text'];?></h3></a>				 
				 <?php else: ?><!-- IF HAS BUTTON -->
				 <h3 class="slider-header"><?= $item['item_header_text'];?></h3>
				 <p class="slider-button-p">
                    <a class="btn btn-lg btn-primary slider-button" role="button" href="http://<?php echo $item['item_link'] ?>" target="_blank"><?=$item['button_text'] ?></a>
                 </p>
				 <?php endif; ?><!-- END IF HAS BUTTON -->
				 
				 <?php else: ?><!-- IF HAS NO LINK BUT HAS HEADER -->
				 <h3 class="slider-header"><?= $item['item_header_text'];?></h3>
				 <?php endif; ?>
				 <?php endif; ?>
				 </div>
				</div>
                </div>
                    <?php $i++;?>
               <?php endforeach; ?>
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#helluxSlider" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#helluxSlider" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
   </div>