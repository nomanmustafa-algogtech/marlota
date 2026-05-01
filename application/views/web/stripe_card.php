<style>
    .login-popup #sign-up-error p{
        margin-bottom: 0px !important;
    }
    .login-popup #sign-up-success p{
        margin-bottom: 0px !important;
    }
    .login-popup #sign-in-error p{
        margin-bottom: 0px !important;
    }
    .login-popup #sign-in-success p{
        margin-bottom: 0px !important;
    }
    
</style>
<div class="login-popup">
    <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
        <ul class="nav nav-tabs text-uppercase" role="tablist">
            <li class="nav-item">
                <a href="#strip_payment" class="nav-link active">Pay with Card</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="card-pay">
                <div class="alert alert-error alert-bg alert-inline show-code-action" id="card-pay-error" style="display:none"></div>
                <div class="alert alert-success alert-bg alert-inline show-code-action" id="card-pay-success" style="display:none"></div>
                <form id="card-pay-form" onsubmit="return false;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Card Number <span style="color:red">*</span></label>
                                <input id="cardnumber" type="text" pattern="[0-9]*" inputmode="numeric" class="form-control" name="cardnumber" placeholder="0000 0000 0000 0000">
                                 
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label>Exipiry Date <span style="color:red">*</span></label>
                                <input id="expirationdate" type="text" pattern="[0-9]*" inputmode="numeric" class="form-control" placeholder="MM/YY" name="expirationdate">
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label>CVV Code <span style="color:red">*</span></label>
                                <input id="securitycode" type="text" pattern="[0-9]*" inputmode="numeric" class="form-control" placeholder="000" name="securitycode">
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" onclick="process_card();" name="paynow" class="btn btn-primary">Pay now</button>
                </form>
            </div>

        </div>
        
    </div>
    
<script>

var cardnumber = document.getElementById('cardnumber');
var expirationdate = document.getElementById('expirationdate');
var securitycode = document.getElementById('securitycode');
var ccicon = document.getElementById('ccicon');
var cctype = null;

//Mask the Credit Card Number Input
var cardnumber_mask = new IMask(cardnumber, {
    mask: [
        {
            mask: '0000 000000 00000',
            regex: '^3[47]\\d{0,13}',
            cardtype: 'american express'
        },
        {
            mask: '0000 0000 0000 0000',
            regex: '^(?:6011|65\\d{0,2}|64[4-9]\\d?)\\d{0,12}',
            cardtype: 'discover'
        },
        {
            mask: '0000 000000 0000',
            regex: '^3(?:0([0-5]|9)|[689]\\d?)\\d{0,11}',
            cardtype: 'diners'
        },
        {
            mask: '0000 0000 0000 0000',
            regex: '^(5[1-5]\\d{0,2}|22[2-9]\\d{0,1}|2[3-7]\\d{0,2})\\d{0,12}',
            cardtype: 'mastercard'
        },
        // {
        //     mask: '0000-0000-0000-0000',
        //     regex: '^(5019|4175|4571)\\d{0,12}',
        //     cardtype: 'dankort'
        // },
        // {
        //     mask: '0000-0000-0000-0000',
        //     regex: '^63[7-9]\\d{0,13}',
        //     cardtype: 'instapayment'
        // },
        {
            mask: '0000 000000 00000',
            regex: '^(?:2131|1800)\\d{0,11}',
            cardtype: 'jcb15'
        },
        {
            mask: '0000 0000 0000 0000',
            regex: '^(?:35\\d{0,2})\\d{0,12}',
            cardtype: 'jcb'
        },
        {
            mask: '0000 0000 0000 0000',
            regex: '^(?:5[0678]\\d{0,2}|6304|67\\d{0,2})\\d{0,12}',
            cardtype: 'maestro'
        },
        // {
        //     mask: '0000-0000-0000-0000',
        //     regex: '^220[0-4]\\d{0,12}',
        //     cardtype: 'mir'
        // },
        {
            mask: '0000 0000 0000 0000',
            regex: '^4\\d{0,15}',
            cardtype: 'visa'
        },
        {
            mask: '0000 0000 0000 0000',
            regex: '^62\\d{0,14}',
            cardtype: 'unionpay'
        },
        {
            mask: '0000 0000 0000 0000',
            cardtype: 'Unknown'
        }
    ],
    dispatch: function (appended, dynamicMasked) {
        var number = (dynamicMasked.value + appended).replace(/\D/g, '');

        for (var i = 0; i < dynamicMasked.compiledMasks.length; i++) {
            let re = new RegExp(dynamicMasked.compiledMasks[i].regex);
            if (number.match(re) != null) {
                return dynamicMasked.compiledMasks[i];
            }
        }
    }
});
//Mask the Expiration Date
var expirationdate_mask = new IMask(expirationdate, {
    mask: 'MM{/}YY',
    blocks: {
        YY: {
         mask: IMask.MaskedRange,
          from: 0,
          to: 99,
        },
    
        MM: {
          mask: IMask.MaskedRange,
          from: 1,
          to: 12
        },
      }
});

//Mask the security code
var securitycode_mask = new IMask(securitycode, {
    mask: '0000',
});


</script>
</div>