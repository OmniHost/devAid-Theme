<div class="modal fade modal-v2" id="downloadModal" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="progress progress-striped active margin-bottom-0">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" data-rel="50" style="width:50%">
                        <span class="sr-only">50% Complete</span>
                    </div>
                    <span class="progress-bar-text">50% Complete</span>
                </div>
                <p class="small text-muted text-center">(enter your email address below and click the "Download Now" button)</p>
                <h3 class="color-red text-center" id="initial-header">
                    <strong> Yes, I want the Secrets Agents don’t want you to know e-book.</strong> 
                </h3>
                <form method="POST" class="form-horizontal" id="modal-trigger-phone" style="display:none">
                    <div class="success"><h3>Your Download has been Emailed to you</h3><p>Would you like one of our experts to conduct a free, no obligation house blindness assessment of your home? Gain some clarity long before you put your house on the market. If so please place your phone number below:</p></div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="input-group">

                                <input type="text" name="telephone" class="form-control" id="download_phone" placeholder="Your Phone"/>
                                <span class="input-group-addon bg-white" id="basic-addon2"><i class="fa fa-phone"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <button type="button" class="btn btn-cta-secondary btn-block" id="modal-trigger-Phone">Yes Please Call Me</button>
                        </div>
                    </div>
                </form>
                <form method="POST" class="form-horizontal" id="modal-trigger-form">
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="input-group">

                                <input type="text" name="name" class="form-control" id="download_name" placeholder="Your Name"/>
                                <span class="input-group-addon bg-white" id="basic-addon2"><i class="fa fa-user"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="input-group">
                                <input type="hidden" name="campaign_id" value="<?php echo $campaign_id; ?>" id="download_campaign_id" />
                                <input type="email" name="email" class="form-control" id="download_email" placeholder="Email Address"/>
                                <span class="input-group-addon bg-white" id="basic-addon2"><i class="fa fa-envelope-o"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                            <button type="button" class="btn btn-cta-secondary btn-block" id="modal-trigger-download">Email it to me now</button>
                        </div>
                    </div>
                    <p class="small text-muted text-center"><i class="fa fa-lock"></i> We value your privacy and would never spam you</p>
                </form>
            </div>


        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<!-- ******FOOTER****** --> 
<footer class="footer">
    <div class="container text-center">
        <!--/* This template is released under the Creative Commons Attribution 3.0 License. Please keep the attribution link below when using for your own project. Thank you for your support. :) If you'd like to use the template without the attribution, you can check out other license options via our website: themes.3rdwavemedia.com */-->
        <small class="copyright">&copy; 2016<a href="http://hawkermedia.me" target="_blank">Hawker Media LTD</a></small>
    </div><!--//container-->
</footer><!--//footer-->




<!-- Javascript -->          
<script type="text/javascript" src="assets/plugins/jquery-1.11.3.min.js"></script>   
<script type="text/javascript" src="assets/plugins/jquery.easing.1.3.js"></script>   

<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>     
<script type="text/javascript" src="assets/plugins/jquery-scrollTo/jquery.scrollTo.min.js"></script> 
<script type="text/javascript" src="assets/plugins/prism/prism.js"></script>    
<script type="text/javascript" src="assets/js/main.js"></script>       

<!-- CAMPAINs BUTTON SUBSCRITON -->
<script>
    function validateEmail(email) {
        var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        return re.test(email);
    }

    $('#modal-trigger-Phone').on("click", function () {

        var d = new Date();

        var names = $('#download_name').val();
        var email = $('#download_email').val();

        var $pdata = {
            email: email,
            campaign_id: $('#download_campaign_id').val(),
            telephone: $('#download_phone').val(),
            "Real Estate Lead": d.toDateString()
        }
        var fullname = names.split(' ');
        if (fullname.length == 1) {
            $pdata.firstname = names;
        } else {
            $pdata.lastname = fullname.pop();
            $pdata.firstname = fullname.join(' ');
        }
        $.post('<?php echo $crmurl; ?>/newsletter/subscribeToCampaign', $pdata, function (res) {
            if (res.code == '201') {
                $('#modal-trigger-form').slideUp();
                $('#modal-trigger-phone').slideUp();
                $('#modal-trigger-phone').after('<div class="alert alert-success"><h3>Success</h3>Your number has been forwarded on to one of our experts!</div>')
            } else {
                alert(res.error);
            }
        }, 'json');
    });

    $('#modal-trigger-download').on("click", function () {
        console.log("triggered");
        $('.has-error').removeClass('has-error');
        $('input-errors').remove();
        var hasError = false;
        var names = $('#download_name').val();
        if (names == '') {
            $('#download_name').closest('.input-group').after('<span class="help-block input-errors">Please Supply your Name</span>');
            $('#download_name').closest('.form-group').addClass('has-error');
            hasError = true;
        }
        var email = $('#download_email').val();
        if (email == '' || !validateEmail(email)) {
            $('#download_email').closest('.input-group').after('<span class="help-block input-errors">Please Supply your Name</span>');
            $('#download_email').closest('.form-group').addClass('has-error');
            hasError = true;
        }
        if (!hasError) {

            var $pdata = {
                email: email,
                campaign_id: $('#download_campaign_id').val()
            }
            var fullname = names.split(' ');
            if (fullname.length == 1) {
                $pdata.firstname = names;
            } else {
                $pdata.lastname = fullname.pop();
                $pdata.firstname = fullname.join(' ');
            }
            $.post('<?php echo $crmurl; ?>/newsletter/subscribeToCampaign', $pdata, function (res) {
                if (res.code == '201') {
                    $('#modal-trigger-form').slideUp();
                    $('#modal-trigger-phone').slideDown();
                    $('#initial-header').slideUp();
                } else {
                    alert(res.error);
                }
            }, 'json');
        }
    });


</script>


</body>
</html> 