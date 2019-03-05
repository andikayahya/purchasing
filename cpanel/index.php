<?php
	include "../include/koneksi.php";
	include "../include/fungsi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "title_and_css.php"?>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form action="login.php" method="post" class="login100-form validate-form">
					<span class="login100-form-title p-b-34">
						Admin Login
					</span>
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
						<input id="first-name" class="input100" type="text" name="id" placeholder="User name">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Sign in
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-239">
						<span class="txt1">
							Forgot
						</span>

						<a href="#" class="txt2">
							User name / password?
						</a>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>
			</div>
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<script language="javascript" type="text/javascript">
			var expDays = 1;
			//url of the page you want to popup
			var windowprops = "width=1050, height=950, location=yes, toolbar=no, menubar=no, scrollbars=yes, resizable=yes";
			function GetCookie (name) {
				var arg = name + "=";
				var alen = arg.length;
				var clen = document.cookie.length;
				var i = 0;
				while (i < clen) {
				var j = i + alen;
				if (document.cookie.substring(i, j) == arg)
				return getCookieVal (j);
				i = document.cookie.indexOf(" ", i) + 1;
				if (i == 0) break;
				}
				return null;
			}
			function SetCookie (name, value) {
				var argv = SetCookie.arguments;
				var argc = SetCookie.arguments.length;
				var expires = (argc > 2) ? argv[2] : null;
				var path = (argc > 3) ? argv[3] : null;
				var domain = (argc > 4) ? argv[4] : null;
				var secure = (argc > 5) ? argv[5] : false;
				document.cookie = name + "=" + escape (value) +
				((expires == null) ? "" : ("; expires=" + expires.toGMTString())) +
				((path == null) ? "" : ("; path=" + path)) +
				((domain == null) ? "" : ("; domain=" + domain)) +
				((secure == true) ? "; secure" : "");
			}
			function DeleteCookie (name) {
				var exp = new Date();
				exp.setTime (exp.getTime() - 1);
				var cval = GetCookie (name);
				document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();
			}
			var exp = new Date();
			exp.setTime(exp.getTime() + (expDays*24*60*60*1000));
			function amt(){
				var count = GetCookie('count')
				if(count == null) {
				SetCookie('count','1')
				return 1
				} else {
				var newcount = parseInt(count) + 1;
				DeleteCookie('count')
				SetCookie('count',newcount,exp)
				return count
				}
			}
			function getCookieVal(offset) {
			var endstr = document.cookie.indexOf (";", offset);
			if (endstr == -1)
			endstr = document.cookie.length;
			return unescape(document.cookie.substring(offset, endstr));
			}
			function checkCount() {
			var count = GetCookie('count');
			if (count == null) {
			count=1;
			SetCookie('count', count, exp);
			window.open(page, "", windowprops);
			} else {
			count++;
			SetCookie('count', count, exp);
			}
			}
			window.onload=checkCount
		</script>

		<script language="JavaScript" type="text/javascript">
		    	var http_request = false;
		        function makeRequest(url) {
		            http_request = false ;
		            if (window.XMLHttpRequest) { // Mozilla, Safari ,...
		                http_request = new XMLHttpRequest();
		                if (http_request.overrideMimeType) {
		                    http_request.overrideMimeType('text/xml');
		                    // See note below about this line
		                }
		            } else if (window.ActiveXObject) { // IE
		                var aVersions = [ "MSXML2.XMLHttp.6.0", "MSXML2.XMLHttp.5.0", "MSXML2.XMLHttp.4.0", "MSXML2.XMLHttp.3.0", "Microsoft.XMLHTTP" ];
		                for (var i = 0; i < aVersions.length; i++) {
		                    try { http_request = new ActiveXObject(aVersions[i]);
		                        break;
		                    }
		                    catch (e)
		                    {
		                    // Do nothing
		                    }
		                }
		            }
		            if (!http_request) {
		                alert ('Giving up :( Cannot create an XMLHTTP instance');
		                return false;
		            }
		            http_request.onreadystatechange = alertContents;
		            http_request.open('GET', url, true);
		            http_request.send(null);
		        }
		        function alertContents() {
		            if (http_request.readyState == 4) {
		                if (http_request.status == 200) {
		                    alert(http_request.responseText);
		                } else {
		                    alert('There was a problem with the request.');
		                }
		            }
		        }

		    function validasi()
		    {
		        if ((document.form.username.value == "") || (document.form.username.value == " "))
		        {
		            alert ("Please, enter username ... ");
		            document.form.username.focus();
		            return false;
		        }
		        else if ((document.form.password.value == "") || (document.form.password.value ==" "))
		        {
		            alert ("Please, enter your password ... ");
		            document.form.password.focus();
		            return false;
		        }
		    }
		    function validasi2()
		    {
		        if ((document.fmpasswd.user.value == "") || (document.fmpasswd.user.value == " "))
		        {
		            alert ("Please, enter username ... ");
		            document.fmpasswd.user.focus();
		            return false;
		        }
		        else if ((document.fmpasswd.oldpasswd.value == "") || (document.fmpasswd.oldpasswd.value ==" "))
		        {
		            alert ("Please, enter your old password ... ");
		            document.fmpasswd.oldpasswd.focus();
		            return false;
		        }
		        else if ((document.fmpasswd.newpasswd.value == "") || (document.fmpasswd.newpasswd.value ==" "))
		        {
		            alert ("Please, enter your new password ... ");
		            document.fmpasswd.newpasswd.focus();
		            return false;
		        }
		    }
    </script>
</body>
</html>