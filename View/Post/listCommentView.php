<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 27/07/2020
 * Time: 15:04
 */
?>
<div class="card border-0 shadow mb-4" id="cardListComment shadow">
    <div class="card-header text-white bg-primary header-elements-inline">
        <div class="row">
            <div class="col-md-6">
                <h5 class="card-title"><i class="fa fa-comments" aria-hidden="true"></i> List Comment</h5>
            </div>
        </div>
    </div>
    <div class="card-body">

        <?php
        foreach ($listComment as $comment) {
            ?>

            <div class="alert alert-primary" role="alert">
                <h4 class="alert-heading"><?= htmlspecialchars($comment->author) ?></h4>

                <p><?= $comment->getDescription() ?></p>
                <hr>
                <p class="mb-0">Le <?= htmlspecialchars($comment->last_update) ?>.</p>
            </div>
            <div>
                <p></p>
            </div>
        <?php } ?>

        <nav aria-label="Page navigation example" class="float-right">
            <ul class="pagination">
                <?php if ($pageSelected == 1)
                { ?>
            <li class="page-item disabled">
            <?php }
            else
            { ?>
                <li class="page-item">
                    <?php } ?>
                    <a class="page-link"
                       href="<?php echo '' . htmlspecialchars($config->basePath) . '/showPost/' . $post->getId() . '/' . ($pageSelected - 1); ?>"
                       aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <?php
                for ($page = 1; $page <= $nbPage; $page++) {
                    if ($page == $pageSelected) {
                        echo '<li class="page-item active "><a class="page-link bg-primary" href="' . htmlspecialchars($config->basePath) . '/showPost/' . $post->getId() . '/' . $page . '">' . $page . '</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="' . htmlspecialchars($config->basePath) . '/showPost/' . $post->getId() . '/' . $page . '">' . $page . '</a></li>';
                    }
                }
                ?>
                <?php if ($pageSelected == $nbPage)
                { ?>
                <li class="page-item disabled">
                    <?php }
                    else
                    { ?>
                <li class="page-item">
                    <?php } ?>
                    <a class="page-link"
                       href="<?php echo '' . htmlspecialchars($config->basePath) . '/showPost/' . $post->getId() . '/' . ($pageSelected + 1); ?>"
                       aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

