<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 27/07/2020
 * Time: 15:04
 */
?>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card border-0 shadow mb-4" id="release">
                <div class="card-header text-white bg-dark header-elements-inline">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title"><i class="fa fa-tag"
                                                      aria-hidden="true"></i> <?= htmlspecialchars($post->getTitle()); ?></h5>
                        </div>

                        <div class="col-md-6">
                            <div class="float-right">
                                <?php if(!empty($user)){
                                    ?>
                                    <?php if($user->hasRole('admin') || ($user->hasRole('author') && $user->getId() == $post->getUserId())){?>
                                        <a class="btn btn-success" href="<?= $config->basePath; ?>/editPost/<?= htmlspecialchars($post->getId()); ?>"><i class="fa fa-edit" aria-hidden="true"></i> Edit post</a>
                                        <a class="btn btn-danger" data-href="<?php echo ''.$config->basePath.'/deletePost/'.htmlspecialchars($post->getId());?>" data-toggle="modal" data-target=".confirm" target="_blank" ><i class="fa fa-trash" aria-hidden="true"></i> Delete post</a></td>
                                    <?php } ?>
                                <?php } ?>
                                <a id="btnPreviousPage" class="btn btn-light" href="#"><i class="fa fa-previous"
                                                                                          aria-hidden="true"></i>
                                    Previous Page</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="card border-0 mb-4">
                        <div class="card-body">
                            <h5 class="m-0"><?= htmlspecialchars($post->getHat()); ?></h5>
                            <hr>
                            <?= htmlspecialchars($post->getContent()); ?>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <label><strong>Author : </strong></label>
                                    <em><?= $post->getAuthor()->getFirstname() . ' ' . $post->getAuthor()->getLastname() . '.' ?></em>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-info float-right" data-toggle="collapse" href="#collapseExample"
                                       role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fa fa-plus"></i> Add comment
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php if (!empty($user)) {
    ?>
    <div class="collapse" id="collapseExample">
        <div class="row">
            <div class="content col-md-10 offset-md-1">
                <?php $controller->partialView('addComment'); ?>
            </div>
        </div>
    </div>
<?php } else {
    ?>
    <div class="collapse" id="collapseExample">
        <div class="row">
            <div class="content col-md-10 offset-md-1">
                <label class="alert alert-info col-md-12">To comment a post you must become member ! <a
                        href="<?= $config->basePath; ?>/registerUser">click here</a> to register.</label>
            </div>
        </div>
    </div>
<?php } ?>

<?php if (intval($nbComments) > 0) {
    ?>
    <div class="row">
        <div class="content col-md-10 offset-md-1">
            <?php $controller->partialView('listComment'); ?>
        </div>
    </div>
<?php } ?>