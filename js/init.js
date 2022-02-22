// AJAX INIT
function $$$(id) {
	return document.getElementById(id);
}
function khoitao_ajax()
{
	var x;
	try
	{
		x	=	new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
    	try
		{
			x	=	new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(f) { x	=	null; }
  	}
	if	((!x)&&(typeof XMLHttpRequest!="undefined"))
	{
		x=new XMLHttpRequest();
  	}
	return  x;
}
function	Forward(url)
{
	window.location.href = url;
}
function	_postback()
{
	return void(1);
}
function send_nhantin(form_nhantin)
{
	name	= form_nhantin.name.value
	phone	= form_nhantin.phone.value
	message	= form_nhantin.message.value
	var	query	=	"act=send_nhantin&phone="+phone+"&name="+name+"&message="+message;
	var http 	=	khoitao_ajax();
	try
	{
		http.open("POST", "/action.php");
		http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		http.setRequestHeader("Cache-control", "no-cache");
		http.onreadystatechange = function()
		{
			if (http.readyState == 4)
			{
				if (http.status == 200)
				{
					x = http.responseText;

					alert(x);
					window.location.href = "/";
				}
				else
				{
						return false;
				}
			}
		}
		http.send(query);
	}
	catch (e)
	{
	}
	return false;
}
function check_mxn()
{
	ma = document.getElementById('ma_xac_nhan').value;
	$.ajax({
		url:'/action.php',
        type: 'POST',
        data: 'act=check_ma_xac_nhan&ma='+ma,
        dataType: "html",
        success: function(data){
			$("#load_ma_xac_nhan").html(data);
        }
    });
}
function number_format (number, decimals, dec_point, thousands_sep) {
  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function (n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}
function add_to_cart(a) {
    $.ajax({
        url: "/action.php",
        type: "POST",
        data: "act=add_to_cart&sp=" + a,
        dataType: "html",
        success: function(a) {
            $("#gio_hang").html(a);
            alert("Đã thêm vào giỏ hàng của bạn\nAdded to your cart");
        }
    })
}

function del_cart(a) {
    $.ajax({
        url: "/action.php",
        type: "POST",
        data: "act=del_cart&sp=" + a,
        dataType: "html",
        success: function(a) {
            location.reload()
        }
    })
}
function up_cart(a) {
  so_luong=document.getElementById("so_luong_"+a).value,gia=document.getElementById("don_gia_"+a).innerHTML,dem=document.getElementById("dem").value,ship=document.getElementById("ship").value,ty_gia=document.getElementById("ty_gia").value,thanh_tien=parseFloat(gia.replace(/\,/g,""))*so_luong,document.getElementById("thanh_tien_"+a).innerHTML=number_format(thanh_tien);
  var tong_sp = 0;
  for(var b=0,c=1;c<=dem;c++){
  	b=parseFloat(b)+parseFloat(document.getElementById("thanh_tien_"+c).innerHTML.replace(/\,/g,""));
  	tong_sp = parseInt(tong_sp)+parseInt(document.getElementById("so_luong_"+c).value);
  }
  document.getElementById("tong_tien").innerHTML=number_format(b);
  document.getElementById("tong_tien_hidden").value=b;
  var phi_ship = parseInt(tong_sp)*ship*ty_gia;
  document.getElementById("phi_ship").innerHTML=number_format(phi_ship);
  document.getElementById("km_ship").innerHTML=number_format(phi_ship/2);
  document.getElementById("tong_ship_hidden").value=phi_ship/2;
  document.getElementById("tong_thanh_toan").innerHTML=number_format(b+parseFloat(phi_ship));
  document.getElementById("tong_tra").innerHTML=number_format(b+parseFloat(phi_ship/2));
  document.getElementById("tong_tra_hidden").value=(b+parseFloat(phi_ship/2));
}
function send_book(a) {
    return name = a.name.value, phone = a.phone.value, email = a.email.value, add = a.add.value, ma_xac_nhan = a.ma_xac_nhan.value, check_ma_xac_nhan = a.check_ma_xac_nhan.value, "" == name ? (alert("Chưa nhập họ và tên!"), a.name.focus(), !1) : "" == email ? (alert("Chưa nhập email"), a.email.value = "", a.email.focus(), !1) : email.match(/^([-\d\w][-.\d\w]*)?[-\d\w]@([-\w\d]+\.)+[a-zA-Z]{2,6}$/) ? "" == phone ? (alert("Chưa nhập số điện thoại"), a.phone.focus(), !1) : isNaN(phone) ? (alert("Số điện thoại chỉ được nhập số"), a.phone.value = "", a.phone.focus(), !1) : phone.length > 14 ? (alert("Số điện thoại không quá 13 số"), a.phone.value = "", a.phone.focus(), !1) : "" == add ? (alert("Chưa nhập địa chỉ!"), a.add.focus(), !1) : "" == ma_xac_nhan ? (alert("Chưa nhập mã bảo vệ!"), a.ma_xac_nhan.focus(), !1) : "no" != check_ma_xac_nhan || (alert("Sai mã bảo vệ!"), a.ma_xac_nhan.value = "", a.ma_xac_nhan.focus(), !1) : (alert("Địa chỉ mail không hợp lệ."), a.email.value = "", a.email.focus(), !1)
}
