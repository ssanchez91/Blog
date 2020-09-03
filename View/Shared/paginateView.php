<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 02/09/2020
 * Time: 09:33
 */
?>

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
               href="<?php echo '' . $url . ($pageSelected - 1); ?>"
               aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <?php
        for ($page = 1; $page <= $nbPage; $page++) {
            if ($page == $pageSelected) {
                echo '<li class="page-item active "><a class="page-link bg-dark" href="' . $url . $page . '">' . $page . '</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="' . $url . $page . '">' . $page . '</a></li>';
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
               href="<?php echo '' . $url . ($pageSelected + 1); ?>"
               aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>