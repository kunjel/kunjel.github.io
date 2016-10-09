function checkField(fname)
{
    var elem = $("#" + fname);
    if (elem.val() == "")
    {
        $("#" + fname).addClass("rb");
        $("#" + fname).focus();
        return false;
    }
    else
    {
        $("#" + fname).removeClass("rb");
        return true;
    }
}

function checkCompareField(fname, fname2)
{
    var elem = $("#" + fname);
    var elem2 = $("#" + fname2);
    if (elem.val() == "" || elem2.val() == "" || elem.val() != elem2.val())
    {
        $("#" + fname).addClass("rb");
        $("#" + fname2).addClass("rb");
        $("#" + fname).focus();
        return false;
    }
    else
    {
        $("#" + fname).removeClass("rb");
        $("#" + fname2).removeClass("rb");
        return true;
    }
}

function checkSpecial(fname)
{
    var iChars = "!@#$%^&*()+=-[]\\\';,./{}|\":<>?";
    var flag   = true;
    var fvalue = $("#" + fname).val();
    
    for (var i = 0; i < fvalue.length; i++) {
        if (iChars.indexOf(fvalue.charAt(i)) != -1) {
            flag = false;
        }
    }
    
    if(!flag)
    {
        $("#" + fname).addClass("rb");
        $("#" + fname).focus();
        alert ("Your username has special characters. \nThese are not allowed.\n Please remove them and try again.");
        return false;
    }
    else
    {
        $("#" + fname).removeClass("rb");
        return true;
    }
}