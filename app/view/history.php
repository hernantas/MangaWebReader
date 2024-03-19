<div class="panel <?php echo (isset($single)?'single':''); ?>">
    <div class="warp">
        <b>Last Chapters Read</b>
    </div>
    <div class="<?php echo (isset($single)?'':'warp'); ?>">
    <?php while ($row = $history->row()): ?>
        <div <?php echo (isset($single)?'class="list"':''); ?>>
            <a href="<?php echo baseUrl().
                "manga/$row->fmanga/chapter/$row->fchapter" ?>"
                <?php echo (isset($single)?'class="clearfix"':''); ?>>
            <?php if (isset($single)): ?>
                <div class="left hwarp">
                    <?php echo "<b>$row->manga</b> - " . page()->mangalib->nameFix($row->chapter, $row->manga); ?>
                </div>
                <div class="right desc">
                    <?php echo "<i><sub>" . page()->date->relative($row->update_at) . "</sub></i>"; ?>
                </div>
            <?php else: ?>
                <?php echo page()->mangalib->nameFix($row->chapter, $row->manga); ?>
            <?php endif; ?>
            </a>
        </div>
    <?php endwhile; ?>
    </div>
</div>
