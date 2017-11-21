var matchs=[];
// 身份证
matchs["identity"]  = new RegExp(/^[1-9]{1}[0-9]{16}([0-9]|[xX])$/);
// 手机号 登陆帐号
matchs["mobile"]  = new RegExp(/^1[0-9]{10}$/);
// 邮箱
matchs["email"]   = new RegExp(/^([a-zA-Z0-9_\.\-]+)(@{1})([a-zA-Z0-9_\.\-]+)(\.[a-zA-Z0-9]{1,3})$/);
// 登录密码
//matchs["loginPw"]  = new RegExp(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d]{6,20}$/);
matchs["loginPw"]  = new RegExp(/(?=.*?[a-zA-Z])(?=.*?[0-9])[a-zA-Z0-9]{6,}$/ );
// 短信验证码
matchs["smsCode"]  = new RegExp(/^\d{6}$/);
// 图形验证码
matchs["captcha"]  = new RegExp(/^[0-9a-zA-Z]{4}$/);
// 银行卡号
matchs["bankCard"]  = new RegExp(/^[0-9]{10,32}$/);

function validateValue($input,skipRequire){
    var inputVal = $input.val();
    var $form = $input.closest('form');
    var thisName = $input.attr('name');

    //不包括任何条件则跳过
    if( $input.attr("required")===undefined &&
        $input.attr("match")===undefined &&
        $input.attr("equal")===undefined &&
        $input.attr("diff")===undefined
    ) return "skip";

    //确认必填项
    if($input.attr("required")!==undefined &&
        (inputVal ==="" || ($input.attr('type')==="checkbox" && $input.attr('checked')!=="checked")
        || ($input[0].tagName==="SELECT" && inputVal === "plasechoose"))
    ){
        if(skipRequire){
            return "skip";
        }
        return "required";
    }

    var match = $input.attr("match");

    if(match!==undefined){
        if (inputVal==="") return "skip";

        if (!inputVal.match(matchs[match])) {
            return "match";
        }
    }

    //必须相同
    if($input.attr("equal")!==undefined){
        //需要与其相同的input
        var $equal = $form.find("input[name="+$input.attr("equal")+"]");

        if($equal.val() !=='' && $equal.val() !== inputVal){
            return "equal";
        }
    }
    if(thisName!==''){
        var $equal = $form.find('input[equal='+thisName+']');
        if($equal.val() !==''){
            checkSingleInput($equal);
        }
    }
}
function checkAllInput($form){
    var count = 0;
    $form.find("input, textarea, select").each(function () {
        if(!checkSingleInput($(this))){
            count++;
        }
    })
    return count === 0 ? true : false;
}
function checkSingleInput($input){
    var errType = validateValue($input);

    $input.closest(".form-group").find(".form-tips-content p").hide();
    if(errType!==undefined && errType!=='skip'){
        $input.closest(".form-group").find("."+errType+" p").show();
        //showToast($input.data('errtip-'+errType));
        return false;
    }
    return true;
}