<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 27/07/2020
 * Time: 10:55
 */
?>
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card" id="release">
            <div class="card-header text-white bg-dark header-elements-inline">
                <h5 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> To Authenticate</h5>

                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div
                ="form-control">
                <form action="login" method="post">
                    <div class="form-group"><label>Login</label>
                        <input class="form-control" type="text" name="login"/></div>
                    <div class="form-group"><label>Password</label>
                        <input class="form-control" type="password" name="password"/></div>
                    <div class="form-group"><input class="btn btn-dark" type="submit" value="Login"/></div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


