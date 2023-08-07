<?php $this->load->view('auth/auth/components/signup/header'); ?>
  <div class="container">
    <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
      <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
        <div class="card z-index-0">
          <div class="card-header text-center pt-4">
            <h5>Register with</h5>
          </div>
          <div class="row px-xl-5 px-sm-4 px-3">
            <?php $this->load->view('auth/auth/components/signup/google-btn'); ?>

            <div class="mt-2 position-relative text-center">
              <p class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                or
              </p>
            </div>
          </div>
          <div class="card-body">
            <form role="form" novalidate>
              <div class="mb-3">
                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Fullname" value="<?= $_ENV['APP_DEMO_MODE'] ? 'Nova Ardiansyah' : ''; ?>" required />
                <div class="invalid-feedback fullname"></div>
              </div>
              <!-- /.mb-3 -->

              <div class="mb-3">
                <input type="email" class="form-control" id="email" name="email" value="<?= $_ENV['APP_DEMO_MODE'] ? 'admin@novaardiansyah.site' : ''; ?>" placeholder="Email" />
                <div class="invalid-feedback email"></div>
              </div>

              <div class="mb-3">
                <input type="password" class="form-control" id="password" name="password" value="<?= $_ENV['APP_DEMO_MODE'] ? '123456' : ''; ?>" placeholder="Password" />
                <div class="invalid-feedback password"></div>
              </div>

              <div class="mb-3">
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?= $_ENV['APP_DEMO_MODE'] ? '123456' : ''; ?>" placeholder="Confirm Password" />
                <div class="invalid-feedback confirm_password"></div>
              </div>

              <div class="form-check form-check-info text-start">
                <input class="form-check-input" type="checkbox" value="1" id="check_term_conditions" name="check_term_conditions" />
                <label class="form-check-label" for="check_term_conditions">
                  I agree the <a href="javascript:void(0)" class="text-dark font-weight-bolder">Terms and Conditions</a>
                </label>
              </div>

              <div class="text-center">
                <button type="button" class="btn bg-gradient-dark w-100 my-4 mb-2" onclick="return signup(event)">Sign up</button>
              </div>
              
              <p class="text-sm mt-3 mb-0">Already have an account? <a href="<?= base_url('auth'); ?>" class="text-dark font-weight-bolder">Login</a></p>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
<?php $this->load->view('auth/auth/components/signup/footer'); ?>