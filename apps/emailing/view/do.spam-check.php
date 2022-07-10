<?php
require_once '../../template/index.php';

require_once 'DoEmailCors.php';
$page_name         = "checkSPam.php";
$getToken          = DoEmailCors::checkSPam($page_name);

$_SESSION['spamTestTkn']  = $getToken;

$merchant_ID = $_SESSION['merchant_ID'];
?>

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="account-settings-container layout-top-spacing">

            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                    <div class="row">

                        <div class="col-xl-8 col-lg-8 col-md-8 layout-spacing">
                            <form id="spam_test_frm" class="section work-experience" action="" method="post" autocomplete="off">
                                <div class="info">
                                    <h5 class="">Spam Test Check</h5>
                                    <div class="row">
                                        <div class="col-md-12 mx-auto">

                                            <div class="work-section">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="degree2">Enter Your Email</label>
                                                            <input type="text" class="form-control mb-4" id="email" name="email" placeholder="Enter your email" required>
                                                            <input type="hidden" class="form-control mb-4" id="tkn" readonly name="tkn" value="<?php echo $getToken; ?>" required>
                                                            <input type="hidden" class="form-control mb-4" id="merchant_ID" readonly name="merchant_ID" value="<?php echo $merchant_ID; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 text-right mb-5">
                                                    <button type="submit" class="btn btn-secondary" id="saveBtn">Check</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p id="responseHere" style="padding:15px;"></p>
                            </form>

                            <div class="col-12">
                                <div class="loader multi-loader mx-auto" style="display: none;" id="loader"></div>
                            </div>

                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 layout-spacing">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                                <div class="widget widget-content-area br-4">
                                    <div class="widget-one" style="padding: 10px;">

                                        <h6>Why perform a Spam Test Check</h6>

                                        <p class="mb-0 mt-3">
                                            <span style="font-weight:bolder;">
                                                A spam test checks your email to see whether certain spam filters will flag it and move it out of a subscriber's inbox.
                                            </span>
                                        </p>

                                        <p class="mb-0 mt-3">
                                            A spam test improve email potential deliverability and ensures
                                            that your newsletter is not flagged as spam but instead makes it into your subscribers’ inboxes?.
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
</div>

<?php
require_once '../../template/footer.php';
?>


<script src="template/statics/assets/plugins/notification/snackbar/snackbar.min.js"></script>
<script src="template/statics/assets/js/components/notification/custom-snackbar.js"></script>

<script src="emailing/js/extra.js"></script>

</body>

</html>