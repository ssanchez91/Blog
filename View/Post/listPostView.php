<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 27/07/2020
 * Time: 15:04
 */
?>
<?php $controller->sharedView('navbarAdmin', 'Shared'); ?>
<div class="content">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card shadow mb-4" id="release">
                <div class="card-header text-white bg-dark header-elements-inline">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title"><i class="fa fa-tag" aria-hidden="true"></i> List Post</h5>
                        </div>
                        <?php if ($user->hasRole('author')) { ?>
                            <div class="col-md-6">
                                <div class="float-right">
                                    <a class="btn btn-info" href="<?= $config->basePath; ?>/addPost"><i
                                            class="fa fa-plus" aria-hidden="true"></i> Add post</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Hat</th>
                                <th>Last Update</th>
                                <th class="text-center">Show</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($listPost as $post) {
                                ?>
                                <tr>
                                    <td><?= $post->getId() ?></td>
                                    <td><?= $post->getTitle() ?></td>
                                    <td><?= $post->getHat() ?></td>
                                    <td><?= $post->last_update ?></td>
                                    <td class="text-center"><a data-container="body" data-toggle="popover"
                                                               data-placement="top"
                                                               data-content="This link allows to show Post's details."
                                                               href="<?php echo '' . $config->basePath . '/showPost/' . $post->getId() . '/1'; ?>"
                                                               aria-label="Show"><i class="fa fa-eye"
                                                                                    aria-hidden="true"></i></a></td>
                                    <td class="text-center"><a class="text-success" data-container="body"
                                                               data-toggle="popover" data-placement="top"
                                                               data-content="This link allows to update this Post."
                                                               href="<?php echo '' . $config->basePath . '/editPost/' . $post->getId(); ?>"
                                                               aria-label="Edit"><i class="fa fa-edit"
                                                                                    aria-hidden="true"></i></a></td>
                                    <td class="text-center"><a class="text-danger"
                                                               data-href="<?php echo '' . $config->basePath . '/deletePost/' . $post->getId(); ?>"
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