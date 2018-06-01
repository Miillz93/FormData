<?php require_once './views/inc/inc.header.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-7 mx-auto mt-5">
                <div class="text-center alert-link <?=(!empty($data['error'])? 'alert alert-danger': '') ;?>"><span ><?= $data['error']; ?></span></div>
                <div class="card mb-3">
                    <img class="img-fluid img-thumbnail" style="" src="./images/healthy.jpg" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title text-center">FREE TIPS & TRICKS TO IMPROVE THE WAY OF LIFE </h5>
                      <p class="card-text text-center">Take charge of your life by subscribing to our newsletters.</p>
                      <form action="" method="post">
                            <div class="form-group">
                                <input type="text" name="name" id="" class="form-control" value="<?= $data['name'] ?>" placeholder="Your Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="" class="form-control" value="<?= $data['email'] ?>" placeholder="Your Email Address">
                                <small id="emailHelp" class="form-text text-muted"><?= $data['email_err'] ; ?></small>
                            </div>
                            <div class="form-group">
                                Birthday:<input type="date" name="birthday" class="form-control" value="" required>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="gender" type="radio" id="inlineCheckbox1" value="Man" checked>
                                <label class="form-check-label" for="inlineCheckbox1">Men</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="gender" type="radio" id="inlineCheckbox2" value="Woman">
                                <label class="form-check-label" for="inlineCheckbox2">Woman</label>
                            </div>
                            <div class="row">
                                 <button type="submit" name="subscribe" class="btn btn-primary btn-block">SUBSCRIBE</button>
                            </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once './views/inc/inc.footer.php'; ?>