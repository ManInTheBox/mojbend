<div id="slides-container" class="slides-container">
    <div id="slides">
        <?php foreach($this->slidesData as $slide) { ?>
        <div>
            <div class="slide-image"><img src="<?php echo $slide->profilePicture->getShortPath('_front'); ?>" /></div>
            <div class="slide-text">
                <h2><?php echo l($slide instanceof Group ? e($slide->name) : e($slide->user->person->fullName) , $slide->url); ?></h2>
                <p><?php echo e($slide->description); ?></p>
                <p class="frontpage-button">
                    <a href="<?php echo $slide->url ?>"><?php echo ('Pogledaj detaljno'); ?></a>
                </p>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="controls"><span class="jFlowNext"><span><?php echo t('Sledeća'); ?></span></span><span class="jFlowPrev"><span><?php echo t('Prethodna'); ?></span></span></div>
    <div id="myController" class="hidden">
    <?php foreach($this->slidesData as $slide) { ?>
        <span class="jFlowControl"><?php echo $slide instanceof Group ? e($slide->name) : e($slide->user->person->fullName); ?></span>
    <?php } ?>
    </div>
</div>
