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
                            <h5 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> List User</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Lastname</th>
                                <th>Firstname</th>
                                <th>Email</th>
                                <th>Role(s)</th>
                                <th>State</th>
                                <th class="text-center">Edit User</th>
                                <th class="text-center">Delete User</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($listUser as $user) {
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($user->getId()) ?></td>
                                    <td><?= htmlspecialchars($user->getLastname()) ?></td>
                                    <td><?= htmlspecialchars($user->getFirstname()) ?></td>
                                    <td><?= htmlspecialchars($user->getMail()) ?></td>
                                    <td><?php foreach ($user->getListRoles() as $role) {
                                            echo htmlspecialchars($role->getDescription()) . ', ';
                                        } ?></td>
                                    <td><p><?php if (htmlspecialchars($user->getEnabled()) == true) { ?><i class="fa fa-user text-success"
                                                                                         aria-hidden="true"></i> Enable <?php } else { ?>
                                                <i class="fa fa-user text-danger"
                                                   aria-hidden="true"></i> Disable <?php } ?> </p></td>
                                    <td class="text-center"><a data-container="body" data-toggle="popover"
                                                               data-placement="top"
                                                               data-content="This link allows to edit this user."
                                                               href="<?php echo '' . htmlspecialchars($config->basePath) . '/editUser/' . htmlspecialchars($user->getId())  ?>"
                                                               aria-label="Edit"><i class="fa fa-edit text-success"
                                                                                    aria-hidden="true"></i></a></td>
                                    <td class="text-center"><a class="text-danger"
                                                               data-href="<?php echo '' . htmlspecialchars($config->basePath) . '/deleteUser/' . htmlspecialchars($user->getId())  ?>"
                                                               data-toggle="modal" data-target=".confirm"
                                                               target="_blank"><i class="fa fa-trash text-danger"
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