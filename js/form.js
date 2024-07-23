// to consolidate all error messages
var totalAlert="";

// form submit counter
var submitCounter=0;

// regular expressions used by checking functions
var reNonBlank=/[\S]/;
var reHexColor=/^#[0-9a-fA-F]{6}$/;
var reInt=/^\d+$/;
var reSignedInt=/^(\+|-)?\d+$/;
var reFloat=/^\d+(\.\d+)?$/;
var reSignedFloat=/^(\+|-)?\d+(\.\d+)?$/;
var reChar=/^[\w\-]+$/;
var reEMail=/^\w[\w\-\.]+\@\w[\w\-]+(\.\w[\w\-]+)+$/;
var reIP=/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/;
var rePostalCA=/^(\w\d){3}$/;
var reURL=/^http(s)?\:\/\/\w[\w\-]+(\.\w[\w\-]+)+([\/\%\?\&\+\#\.\w\-\=]+)*$/;

function rpChar(f) {
  var df=f;

  df=df.replace(/\\/g, '\\\\');
  df=df.replace(/\//g, '\\\/');
  df=df.replace(/\[/g, '\\\[');
  df=df.replace(/\]/g, '\\\]');
  df=df.replace(/\(/g, '\\\(');
  df=df.replace(/\)/g, '\\\)');
  df=df.replace(/\{/g, '\\\{');
  df=df.replace(/\}/g, '\\\}');
  df=df.replace(/\</g, '\\\<');
  df=df.replace(/\>/g, '\\\>');
  df=df.replace(/\|/g, '\\\|');
  df=df.replace(/\*/g, '\\\*');
  df=df.replace(/\?/g, '\\\?');
  df=df.replace(/\+/g, '\\\+');
  df=df.replace(/\^/g, '\\\^');
  df=df.replace(/\$/g, '\\\$');

  return df;
}

function rePhone(f) {
  var df=rpChar(f);

  df=df.replace(/d/gi, '\\d');
  df=df.replace(/w/gi, '(\\w|\\d)');

  return new RegExp('^'+df+'$');
}

function reDate(f) {
  var df=rpChar(f);

  df=df.replace(/dd/gi, '\\d\\d');
  df=df.replace(/mm/gi, '\\d\\d');
  df=df.replace(/yyyy/gi, '\\d\\d\\d\\d');

  return new RegExp('^'+df+'$');
}

function reCharNM(n,m) {
  return new RegExp("\^[\\w\\-]{"+n+","+m+"}\$");
}

function reNumberN(n,mode) {
  return new RegExp("\^"+(mode!=0?"(\\+\|-)?":"")+"\\d{1,"+n+"}\$");
}

function reNumberN2(n,mode) {
  return new RegExp("\^"+(mode!=0?"(\\+\|-)?":"")+"\\d{"+n+"}\$");
}

function reNumberNM(n,m,mode) {
  return new RegExp("\^"+(mode!=0?"(\\+\|-)?":"")+"\\d{1,"+n+"}(\\.\\d{1,"+m+"})?\$");
}

function reNumberNM2(n,m,mode) {
  return new RegExp("\^"+(mode!=0?"(\\+\|-)?":"")+"\\d{"+n+"}\\.\\d{"+m+"}\$");
}

// wrapper functions
function _checkValue(re, value, msg, mode) {
  if (!re.test(value)) {
    _alertIt(msg, mode);

    return (mode && mode==1)?true:false;
  }

  return true;
}

function _alertIt(msg, mode) {
  if (mode) {
    totalAlert+=msg+"\n";
  }
  else {
    totalAlert="";
    alert(msg);
  }
}

function _checkIt(re, field, msg, mode) {
  if (!re.test(field.value)) {
    _alertIt(msg, mode);

    if (field.select) {
      field.select();
    }
    if (field.focus) {
      field.focus();
    }

    return (mode && mode==1)?true:false;
  }

  return true;
}

function noErrors() {
  if (totalAlert=="") {
    return true;
  }
  else {
    alert(totalAlert);
    totalAlert="";
    return false;
  }
}

// the checking functions
function goodPasswords(field1, field2, msg1, msg2, mode) {
  if (nonBlank(field1, msg1, mode?2:0) && nonBlank(field2, msg1, mode?2:0)) {
    if (field1.value == field2.value) {
      return true;
    }
    else {
      _alertIt(msg2, mode);
    }
  }

  return (mode && mode==1)?true:false;
}

function goodPasswordsLen(field1, field2, n, m, msg1, msg2, msg3, mode) {
  if (nonBlank(field1, msg1, mode?2:0) && nonBlank(field2, msg1, mode?2:0)) {
    if (field1.value == field2.value) {
      if (goodCharLen(n, m, field1, msg3, mode?2:0)) {
        return true;
      }
    }
    else {
      _alertIt(msg2, mode);
    }
  }

  return (mode && mode==1)?true:false;
}

function goodEMails(field1, field2, msg1, msg2, mode) {
  if (goodEMail(field1, msg1, mode?2:0) && goodEMail(field2, msg1, mode?2:0)) {
    if (field1.value == field2.value) {
      return true;
    }
    else {
      _alertIt(msg2, mode);
    }
  }

  return (mode && mode==1)?true:false;
}

function goodEMail2(value, msg, mode) {
  return _checkValue(reEMail, value, msg, mode);
}

function goodMultiEMails(field, msg, mode) {
  var values = field.value.split(/\s*[,;]\s*/), allGood = reNonBlank.test(field.value);

  if (!allGood) {
    _alertIt(msg, mode);
  }

  for (var i = 0; i < values.length && allGood; i++) {
    if (reNonBlank.test(values[i])) {
      allGood = goodEMail2(values[i], msg, mode?2:0);
    }
  }

  return allGood?true:(mode && mode==1)?true:false;
}

function goodPhone(pf, field, msg, mode) {
  return _checkIt(rePhone(pf), field, msg, mode);
}

function goodPostalCA(field, msg, mode) {
  return _checkIt(rePostalCA, field, msg, mode);
}

function goodDate(df, field, msg, mode) {
  if (_checkIt(reDate(df), field, msg, mode?2:0)) {
    var di=field.value;
    var y4=df.search(/yyyy/i), y=di.substring(y4, y4+4)-0;
    var m2=df.search(/mm/i), m=di.substring(m2, m2+2)-1;
    var d2=df.search(/dd/i), d=di.substring(d2, d2+2)-0;

    var dd=new Date(y, m, d);
    if (y==dd.getFullYear() && m==dd.getMonth() && d==dd.getDate()) {
      return true;
    }
    else {
      _alertIt(msg, mode);

      field.select();
      field.focus();
    }
  }

  return (mode && mode==1)?true:false;
}

function goodIP(field, msg, mode) {
  return _checkIt(reIP, field, msg, mode);
}

function goodChar(field, msg, mode) {
  return _checkIt(reChar, field, msg, mode);
}

function goodEMail(field, msg, mode) {
  return _checkIt(reEMail, field, msg, mode);
}

function goodInt(field, msg, mode) {
  return _checkIt(reInt, field, msg, mode);
}

function goodSignedInt(field, msg, mode) {
  return _checkIt(reSignedInt, field, msg, mode);
}

function goodFloat(field, msg, mode) {
  return _checkIt(reFloat, field, msg, mode);
}

function goodSignedFloat(field, msg, mode) {
  return _checkIt(reSignedFloat, field, msg, mode);
}

function goodIntLen(n, field, msg, mode) {
  return _checkIt(reNumberN(n,0), field, msg, mode);
}

function goodSignedIntLen(n, field, msg, mode) {
  return _checkIt(reNumberN(n,1), field, msg, mode);
}

function goodIntLen2(n, field, msg, mode) {
  return _checkIt(reNumberN2(n,0), field, msg, mode);
}

function goodSignedIntLen2(n, field, msg, mode) {
  return _checkIt(reNumberN2(n,1), field, msg, mode);
}

function goodCharLen(n, m, field, msg, mode) {
  return _checkIt(reCharNM(n,m), field, msg, mode);
}

function goodFloatLen(n, m, field, msg, mode) {
  return _checkIt(reNumberNM(n,m,0), field, msg, mode);
}

function goodSignedFloatLen(n, m, field, msg, mode) {
  return _checkIt(reNumberNM(n,m,1), field, msg, mode);
}

function goodFloatLen2(n, m, field, msg, mode) {
  return _checkIt(reNumberNM2(n,m,0), field, msg, mode);
}

function goodSignedFloatLen2(n, m, field, msg, mode) {
  return _checkIt(reNumberNM2(n,m,1), field, msg, mode);
}

function _rangeIt(field, r1, r2, msg, mode) {
  if (field.value>=r1 && field.value<=r2) {
    return true;
  }
  else {
    _alertIt(msg, mode);

    field.select();
    field.focus();

    return (mode && mode==1)?true:false;
  }
}

function rangeInt(field, r1, r2, msg, mode) {
  if (goodInt(field, msg, mode?2:0)) {
    return _rangeIt(field, r1, r2, msg, mode);
  }

  return (mode && mode==1)?true:false;
}

function rangeSignedInt(field, r1, r2, msg, mode) {
  if (goodSignedInt(field, msg, mode?2:0)) {
    return _rangeIt(field, r1, r2, msg, mode);
  }

  return (mode && mode==1)?true:false;
}

function rangeFloat(field, r1, r2, msg, mode) {
  if (goodFloat(field, msg, mode?2:0)) {
    return _rangeIt(field, r1, r2, msg, mode);
  }

  return (mode && mode==1)?true:false;
}

function rangeSignedFloat(field, r1, r2, msg, mode) {
  if (goodSignedFloat(field, msg, mode?2:0)) {
    return _rangeIt(field, r1, r2, msg, mode);
  }

  return (mode && mode==1)?true:false;
}

function rangeIntLen(n, field, r1, r2, msg, mode) {
  if (goodIntLen(n, field, msg, mode?2:0)) {
    return _rangeIt(field, r1, r2, msg, mode);
  }

  return (mode && mode==1)?true:false;
}

function rangeSignedIntLen(n, field, r1, r2, msg, mode) {
  if (goodSignedIntLen(n, field, msg, mode?2:0)) {
    return _rangeIt(field, r1, r2, msg, mode);
  }

  return (mode && mode==1)?true:false;
}

function rangeIntLen2(n, field, r1, r2, msg, mode) {
  if (goodIntLen2(n, field, msg, mode?2:0)) {
    return _rangeIt(field, r1, r2, msg, mode);
  }

  return (mode && mode==1)?true:false;
}

function rangeSignedIntLen2(n, field, r1, r2, msg, mode) {
  if (goodSignedIntLen2(n, field, msg, mode?2:0)) {
    return _rangeIt(field, r1, r2, msg, mode);
  }

  return (mode && mode==1)?true:false;
}

function rangeFloatLen(n, m, field, r1, r2, msg, mode) {
  if (goodFloatLen(n, m, field, msg, mode?2:0)) {
    return _rangeIt(field, r1, r2, msg, mode);
  }

  return (mode && mode==1)?true:false;
}

function rangeSignedFloatLen(n, m, field, r1, r2, msg, mode) {
  if (goodSignedFloatLen(n, m, field, msg, mode?2:0)) {
    return _rangeIt(field, r1, r2, msg, mode);
  }

  return (mode && mode==1)?true:false;
}

function rangeFloatLen2(n, m, field, r1, r2, msg, mode) {
  if (goodFloatLen2(n, m, field, msg, mode?2:0)) {
    return _rangeIt(field, r1, r2, msg, mode);
  }

  return (mode && mode==1)?true:false;
}

function rangeSignedFloatLen2(n, m, field, r1, r2, msg, mode) {
  if (goodSignedFloatLen2(n, m, field, msg, mode?2:0)) {
    return _rangeIt(field, r1, r2, msg, mode);
  }

  return (mode && mode==1)?true:false;
}

function _dd(n) {
  return (n<10)?"0"+n:""+n;
}

function _getOffset(n) {
  var d=new Date();
  if (n!=0) {
    d.setTime(d.getTime()+n*86400000);
  }
  return d.getFullYear()+""+_dd(d.getMonth()+1)+""+_dd(d.getDate())+"";
}

function _stringIt(df, d) {
  var y4=df.search(/yyyy/i), m2=df.search(/mm/i), d2=df.search(/dd/i);
  return d.substring(y4, y4+4)+d.substring(m2, m2+2)+d.substring(d2, d2+2);
}

function rangeDate(df, field, r1, r2, msg, mode) {
  if (goodDate(df, field, msg, mode?2:0)) {
    var d=_stringIt(df, field.value);

    var r1x="", r2x="";
    if (r1.search(/^\d+$/)!=-1) {
      r1x=_getOffset(r1-0);
    }
    else {
      r1x=_stringIt(df, r1);
    }
    if (r2.search(/^\d+$/)!=-1) {
      r2x=_getOffset(r2-0);
    }
    else {
      r2x=_stringIt(df, r2);
    }

    if (d<r1x || d>r2x) {
      _alertIt(msg, mode);

      field.select();
      field.focus();
    }
    else {
      return true;
    }
  }

  return (mode && mode==1)?true:false;
}

function goodDateRange(df, field1, field2, msg, mode) {
  if (goodDate(df, field1, msg, mode?2:0) && goodDate(df, field2, msg, mode?2:0)) {
    if (_stringIt(df, field1.value)>_stringIt(df, field2.value)) {
      _alertIt(msg, mode);
      field1.focus();
    }
    else {
      return true;
    }
  }

  return (mode && mode==1)?true:false;
}

function goodDateRange2(df, field1, field2, msg, mode) {
  if (goodDate(df, field1, msg, mode?2:0) && goodDate(df, field2, msg, mode?2:0)) {
    if (_stringIt(df, field1.value)>=_stringIt(df, field2.value)) {
      _alertIt(msg, mode);
      field1.focus();
    }
    else {
      return true;
    }
  }

  return (mode && mode==1)?true:false;
}

function goodHexColor(field, msg, mode) {
  return _checkIt(reHexColor, field, msg, mode);
}

function nonBlank(field, msg, mode) {
  if (field.type) {
    if (/file|select|text|password/.test(field.type)) {
      return _checkIt(reNonBlank, field, msg, mode);
    }
    else if (/radio|checkbox/.test(field.type)) {
      if (field.checked) {
        return true;
      }
      else {
        _alertIt(msg, mode);
        field.focus();
        return (mode && mode==1)?true:false;
      }
    }
    else {
      _alertIt("Invalid field for nonBlank() checking", mode);
      return (mode && mode==1)?true:false;
    }
  }
  else if (field.length && field[0].type && /radio|checkbox/.test(field[0].type)) {
    for (var i=0; i<field.length; i++) {
      if (field[i].checked) { return true; }
    }

    _alertIt(msg, mode);
    field[0].focus();
    return (mode && mode==1)?true:false;
  }
  else {
    _alertIt("Invalid field for nonBlank() checking", mode);
    return (mode && mode==1)?true:false;
  }
}

function goodRadioedFields(form, fn, re, msgs, msg, mode) {
  for (var i=0; i<form[fn].length; i++) {
    if (form[fn][i].checked) {
      return _checkIt(re, form[form[fn][i].value], msgs[i], mode);
    }
  }

  _alertIt(msg, mode);
  return (mode && mode==1)?true:false;
}

function goodRadioedFields2(form, fn, re, msgs, msg, mode) {
  for (var i=0; i<form[fn].length; i++) {
    if (form[fn][i].checked) {
      return _checkIt(re[i], form[form[fn][i].value], msgs[i], mode);
    }
  }

  _alertIt(msg, mode);
  return (mode && mode==1)?true:false;
}

function noBadWords(field, strict, words, msg, mode) {
  var lw=[], nwb=strict?'':'\\b';
  for (var i=0; i<words.length; i++) {
    lw[i]=nwb+words[i].toLowerCase()+nwb;
  }

  var re=new RegExp(lw.join("|"), "i");
  if (re.test(field.value)) {
    _alertIt(msg, mode);
    return (mode && mode==1)?true:false;
  }
  else {
    return true;
  }
}

// credit card checking codes taken from Netscape LivePayment samples codes and modified to fit Form Guard
function goodCreditCard(field, msg, mode) {
  var sum=0, mul=1, l=field.value.length;
  var digit, tproduct;

  if (_checkIt(reInt, field, msg, mode?2:0)) {
    for (var i=0; i<l; i++) {
      digit=field.value.substring(l-i-1,l-i);
      tproduct=parseInt(digit ,10)*mul;
      if (tproduct>=10) {
        sum+=(tproduct%10)+1;
      }
      else {
        sum+=tproduct;
      }

      if (mul==1) {
        mul++;
      }
      else {
        mul--;
      }
    }

    if ((sum%10)==0) {
      return true;
    }
    else {
      _alertIt(msg, mode);
      return (mode && mode==1)?true:false;
    }
  }
}

function goodVisa(field, msg, mode) {
  if ((field.value.length==16 || field.value.length==13) && field.value.substring(0,1)==4) {
    return goodCreditCard(field, msg, mode);
  }
  else {
    _alertIt(msg, mode);
    return (mode && mode==1)?true:false;
  }
}

function goodMasterCard(field, msg, mode) {
  var firstdig=field.value.substring(0,1), seconddig=field.value.substring(1,2);
  if (field.value.length==16 && firstdig==5 && (seconddig>=1 && seconddig<=5)) {
    return goodCreditCard(field, msg, mode);
  }
  else {
    _alertIt(msg, mode);
    return (mode && mode==1)?true:false;;
  }
}

function goodAmericanExpress(field, msg, mode) {
  var firstdig=field.value.substring(0,1), seconddig=field.value.substring(1,2);
  if (field.value.length==15 && firstdig==3 && (seconddig==4 || seconddig==7)) {
    return goodCreditCard(field, msg, mode);
  }
  else {
    _alertIt(msg, mode);
    return (mode && mode==1)?true:false;;
  }
}

function goodDinersClub(field, msg, mode) {
  var firstdig=field.value.substring(0,1), seconddig=field.value.substring(1,2);
  if (field.value.length==14 && firstdig==3 && (seconddig==0 || seconddig==6 || seconddig==8)) {
    return goodCreditCard(field, msg, mode);
  }
  else {
    _alertIt(msg, mode);
    return (mode && mode==1)?true:false;;
  }
}

function goodCarteBlanche(field, msg, mode) {
  return goodDinersClub(field, msg, mode);
}

function goodDiscover(field, msg, mode) {
  var first4digs=field.value.substring(0,4);
  if (field.value.length==16 && first4digs=="6011") {
    return goodCreditCard(field, msg, mode);
  }
  else {
    _alertIt(msg, mode);
    return (mode && mode==1)?true:false;;
  }
}

function goodEnRoute(field, msg, mode) {
  var first4digs=field.value.substring(0,4);
  if (field.value.length==15 && (first4digs=="2014" || first4digs=="2149")) {
    return goodCreditCard(field, msg, mode);
  }
  else {
    _alertIt(msg, mode);
    return (mode && mode==1)?true:false;;
  }
}

function goodJCB(field, msg, mode) {
  var first4digs=field.value.substring(0,4);
  if (field.value.length==16 && (first4digs=="3088" || first4digs=="3096" || first4digs=="3112" || first4digs=="3158" || first4digs=="3337" || first4digs=="3528")) {
    return goodCreditCard(field, msg, mode);
  }
  else {
    _alertIt(msg, mode);
    return (mode && mode==1)?true:false;;
  }
}

function notSubmitted(msg) {
  if (submitCounter==0) {
    submitCounter=1;
    return true;
  }
  else {
    alert(msg);
    return false;
  }
}

function goodURL(field, msg, mode) {
  return _checkIt(reURL, field, msg, mode);
}