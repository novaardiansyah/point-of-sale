<?php $this->load->view('auth/auth/components/header'); ?>
  <main class="main-content mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header text-start pb-0">
                  <h4 class="font-weight-bolder">Welcome Back!</h4>
                  <p class="mb-0">Enter your email and password to login</p>
                </div>
                <div class="card-body pb-3 pt-2">
                  <form role="form" novalidate>
                    <div class="mb-3">
                      <input type="text" class="form-control form-control-lg" id="username_or_email" name="username_or_email" placeholder="Username or Email" value="<?= $_ENV['APP_DEMO_MODE'] ? 'admin@novaardiansyah.site' : ''; ?>" required />
                      <div class="invalid-feedback username_or_email"></div>
                    </div>
                    <!-- /.mb-3 -->

                    <div class="mb-3">
                      <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password" value="<?= $_ENV['APP_DEMO_MODE'] ? '123456' : ''; ?>" required />
                      <div class="invalid-feedback password"></div>
                    </div>
                    <!-- /.mb-3 -->

                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" value="1" id="check_remember_me" name="check_remember_me" checked />
                      <label class="form-check-label" for="check_remember_me">Remember me</label>
                    </div>
                    <!-- /.form-check -->

                    <div class="text-center">
                      <button type="button" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0" onclick="return login(event)">Login</button>
                    </div>
                  </form>

                  <div class="row px-xl-5 px-sm-4 px-3 mt-3">
                    <div class="mt-2 position-relative text-center">
                      <p class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                        or
                      </p>
                    </div>

                    <div class="mt-3">
                      <?php $this->load->view('auth/auth/components/signup/google-btn'); ?>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="<?= base_url('auth/signup') ?>" class="text-primary text-gradient font-weight-bold">Sign up</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('<?= assets_url('img/background-login.webp') ?>');
          background-size: cover;">
                <span class="mask bg-gradient-secondary opacity-7"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Embrace the Journey, <br />Chase the Dream"</h4>
                <p class="text-white position-relative">Behind every polished creation lies a trail of dedication, refining the rough into the refined with unwavering commitment.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
<?php $this->load->view('auth/auth/components/footer'); ?>