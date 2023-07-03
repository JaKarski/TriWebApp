		var my_div = null;
		var newDiv = null;

		function addElement() {

			newDiv = document.createElement("div");
			newDiv.id = 'button';
			newDiv.innerHTML = "<h2>Stare tło wróciło</h2>";
			document.body.appendChild(newDiv);

			my_div = document.getElementById("button");
			document.body.insertBefore(newDiv, my_div);
		}