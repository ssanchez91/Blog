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
        <div class="card shadow mb-4" id="release">
            <div class="card-header text-white bg-dark header-elements-inline">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title"><i class="fa fa-tag" aria-hidden="true"></i> Edit Post</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="float-right">
                            <a id="btnPreviousPage" class="btn btn-light" href="#"><i class="fa fa-previous"
                                                                                      aria-hidden="true"></i> Previous
                                Page</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="../editPost">
                    <input type="text" name="id" value="<?= htmlspecialchars($post->getId()) ?>" class="d-none"/>

                    <div class="form-row">
                        <div class="form-group col-md-1">
                            <label for="title"><strong>Title : </strong></label>
                        </div>
                        <div class="form-group col-md-11">
                            <input id="title" name="title" class="form-control" type="text"
                                   value="<?= htmlspecialchars($post->getTitle()) ?>"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-1">
                            <label for="hat"><strong>Hat : </strong></label>
                        </div>
                        <div class="form-group col-md-11">
                            <textarea id="hat" name="hat" class="form-control"><?= htmlspecialchars($post->getHat()) ?></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group  col-md-12">
                            <label for="content"><strong>Content : </strong></label> <textarea id="content"
                                                                                               name="content"
                                                                                               class="form-control"><?= htmlspecialchars($post->getContent()) ?></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group  col-md-3">
                            <input id='submit' type="submit" value="Save" class="btn btn-dark form-control"/>
                        </div>
                        <div class="form-group col-md-3 offset-md-6">
                            <p class="text-right">
                                <small class="text-muted text-sm-right">By</small>
                                <?php if ($user->hasRole('admin') == false) {
                                    echo htmlspecialchars($user->getFirstname()) . ' ' . $user->getLastname();
                                } ?>
                                <?php if ($user->hasRole('admin')) {
                                    ?>
                                    <select id="listAuthor" name="author">
                                        <?php foreach ($listAuthor as $author) {
                                            ?>
                                            <option <?php if ($author->getId() == $post->user_id) { ?> selected="selected" <?php } ?>
                                                value="<?= htmlspecialchars($author->getId()) ?>"><?= htmlspecialchars($author->getFirstname()) . ' ' . htmlspecialchars($author->getLastname()) ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>