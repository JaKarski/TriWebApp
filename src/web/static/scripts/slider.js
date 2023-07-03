		var numer = Math.floor(Math.random() * 3) + 1;

		function schowaj() {
			$("#slider").fadeOut(500);
		}

		function zmienslajd() {
			numer++; if (numer > 3) numer = 1;

			var plik = "<img src=\"static/slajdy/slajd" + numer + ".jpg\" width=100% height=100% />";
			document.getElementById("slider").innerHTML = plik;
			$("#slider").fadeIn(500);

			setTimeout("zmienslajd()", 5000);
			setTimeout("schowaj()", 4500);
		}