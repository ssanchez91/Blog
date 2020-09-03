<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 27/07/2020
 * Time: 15:04
 */
?>

<div class="content">
    <?php foreach ($listPost as $post) {
        ?>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card border-0 shadow mb-4" id="release">
                    <div class="card-header text-white bg-info header-elements-inline">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title"><i class="fa fa-tag"
                                                          aria-hidden="true"></i> <?= $post->getTitle(); ?></h5>
                            </div>

                            <div class="col-md-6">
                                <div class="float-right">
                                    <a class="btn btn-info"
                                       href="<?= $config->basePath; ?>/showPost/<?= $post->getId(); ?>/1"><i
                                            class="fa fa-eye" aria-hidden="true"></i> Show Post' details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <h5 class="m-0"><?= $post->getHat(); ?></h5>
                                <hr>
                                <?php echo '' . substr($post->getContent(), 0, 30) . '...'; ?>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label><strong>Last update : </strong></label>
                                        <em>le <?= $post->last_update . '.' ?></em>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <?php $controller->sharedView('paginate', 'Shared'); ?>
        </div>
    </div>
</div>
