<div class="container">
    <div class="card">
        <div class="card-header">
            <strong>Form Pendaftaran User</strong>
        </div>

        <?= $this->session->flashdata('message'); ?>

        <div class="card-body card-block">
            <div class="bootstrap-iso">
                <form class="user" method="post" action="<?= base_url('admin/registration'); ?> ">

                    <div class=" form-group">
                        <input type="text" class="form-control form-control-user" id="NPP" name="NPP" placeholder="NPP" value="<?= set_value('NPP'); ?>">
                        <?= form_error('NPP', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class=" form-group">
                        <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class=" form-group">
                        <input type="text" class="form-control form-control-user" id="No_HP" name="No_HP" placeholder="Nomor HP (Whatsapp)" value="<?= set_value('No_HP'); ?>">
                        <?= form_error('No_HP', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Masukan ulang password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Daftarkan User
                    </button>

                </form>
            </div>
        </div>
    </div>