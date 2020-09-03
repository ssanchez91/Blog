<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 27/07/2020
 * Time: 15:04
 */
?>

<div class="card border-0 shadow mb-4" id="cardAddComment">
    <div class="card-header text-white bg-info header-elements-inline">
        <div class="row">
            <div class="col-md-12">
                <h5 class="card-title"><i class="fa fa-comments" aria-hidden="true"></i> Add Comment</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="../../addComment">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <textarea id="description" name="description" class="form-control"
                              placeholder="Taper votre commentaire ici ..."></textarea>
                    <input type="hidden" name="userId" value="<?= htmlspecialchars($user->getId()) ?>"/>
                    <input type="hidden" name="postId" value="<?= htmlspecialchars($post->getId()) ?>"/>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group  col-md-3">
                    <input id='submit' type="submit" value="Save" class="btn btn-info form-control"/>
                </div>
                <div class="form-group col-md-3 offset-md-6">
                    <p class="text-right">
                        <small
                            class="text-muted text-sm-right"><?php echo 'By ' . htmlspecialchars($user->getFirstname()) . ' ' . htmlspecialchars($user->getLastname()) . '.'; ?></small>
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>
