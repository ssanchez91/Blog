<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 27/07/2020
 * Time: 15:04
 */
?>
<?php $controller->sharedView('admin', 'Shared'); ?>
<div class="content">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card shadow mb-4" id="release">
                <div class="card-header text-white bg-dark header-elements-inline">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title"><i class="fa fa-comment" aria-hidden="true"></i> List Comment</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="text-center">
                            <tr>
                                <th>Description</th>
                                <th>Author</th>
                                <th>Last Update</th>
                                <th>Published</th>
                                <th class="text-center">Show Post</th>
                                <?php if ($user->hasRole("admin")) { ?>
                                    <th class="text-center">Publish or block</th>
                                    <th class="text-center">Delete</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($listComment as $comment) {
                                ?>
                                <tr>
                                    <td><?= $comment->getDescription() ?></td>
                                    <td><?= $comment->author ?></td>
                                    <td><?= $comment->last_update ?></td>
                                    <?php if ($comment->getPublish()) {
                                        ?>
                                        <td class="text-success">Yes</td>
                                    <?php } else {
                                        ?>
                                        <td class="text-danger">No</td>
                                    <?php } ?>
                                    <td class="text-center"><a data-container="body" data-toggle="popover"
                                                               data-placement="top"
                                                               data-content="This link allows to show comment' details."
                                                               href="<?php echo '' . $config->basePath . '/showPost/' . $comment->post_id . '/1'; ?>"
                                                               aria-label="Show"><i class="fa fa-eye"
                                                                                    aria-hidden="true"></i></a></td>
                                    <?php if ($comment->getPublish()) {
                                        ?>
                                        <td class="text-center"><a data-container="body" data-toggle="popover"
                                                                   data-placement="top"
                                                                   data-content="This link allows to ban the comment."
                                                                   href="<?php echo '' . $config->basePath . '/publishComment/' . $comment->getId() . '/ban'; ?>"
                                                                   aria-label="Ban"><i class="fa fa-ban text-danger"
                                                                                       aria-hidden="true"></i></a></td>
                                    <?php } else { ?>
                                        <td class="text-center"><a data-container="body" data-toggle="popover"
                                                                   data-placement="top"
                                                                   data-content="This link allows to publish the comment."
                                                                   href="<?php echo '' . $config->basePath . '/publishComment/' . $comment->getId() . '/publish'; ?>"
                                                                   aria-label="Publish"><i
                                                    class="fa fa-upload text-success" aria-hidden="true"></i></a></td>

                                    <?php } ?>
                                    <td class="text-center"><a class="text-danger"
                                                               data-href="<?php echo '' . $config->basePath . '/deleteComment/' . $comment->getId(); ?>"
                                                               data-toggle="modal" data-target=".confirm"
                                                               target="_blank"><i class="fa fa-trash"
                                                                                  aria-hidden="true"></i></a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php $controller->sharedView('paginate', 'Shared'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
