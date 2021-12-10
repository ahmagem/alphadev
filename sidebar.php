<?php
$sidebar = startit_qode_get_sidebar();
?>
<div class="qodef-column-inner">
    <aside class="qodef-sidebar">
        <?php
            if (is_active_sidebar($sidebar)) {
                dynamic_sidebar($sidebar);
            }
        ?>
    </aside>
</div>
